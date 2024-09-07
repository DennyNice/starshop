<?php

namespace App\Service;

use App\Entity\Activity;
use http\Exception\RuntimeException;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class BoredApiClient
{
    private const CACHE_TTL = 3600;
    private const API_URL = 'https://bored-api.appbrewery.com/random';

    public function __construct(
        private CacheItemPoolInterface $cache,
        //        private LoggerInterface $logger,
        private readonly HttpClientInterface $client)
    {
    }

    private function arrayToActivity(array $activityArray): Activity
    {
        return new Activity(
            $activityArray['activity'],
            $activityArray['availability'],
            $activityArray['type'],
            $activityArray['participants'],
            $activityArray['price'],
            $activityArray['accessibility'],
            $activityArray['duration'],
            $activityArray['kidFriendly'],
            $activityArray['link'],
            $activityArray['key'],
        );
    }

    public function getData(): Activity
    {
        $key = md5(self::API_URL);
        $item = $this->cache->getItem($key);
        if ($item->isHit()) {
            return $item->get();
        }
        try {
            $response = $this->client->request('GET', self::API_URL);
            $content = $response->getContent();
            $result = json_decode($content, true);
            $item->set($content);
            $item->expiresAfter(self::CACHE_TTL);
            $this->cache->save($item);

            return $this->arrayToActivity($result);
        } catch (\Throwable $exception) {
            throw new RuntimeException($exception->getMessage('Warning'));
        }
    }
}
//cea