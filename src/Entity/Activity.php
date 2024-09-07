<?php

namespace App\Entity;

final readonly class Activity
{
    public function __construct(
        public string $activity,
        public float $availability,
        public string $type,
        public int $participants,
        public float $price,
        public string $accessibility,
        public string $duration,
        public bool $kidFriendly,
        public string $link,
        public string $key, )
    {
    }
}
