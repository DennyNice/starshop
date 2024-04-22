<?php

namespace App\Repository;

use App\Model\Starship;
use App\Model\StarshipStatusEnum;
use Psr\Log\LoggerInterface;

class StarshipRepository
{
    public function __construct(private LoggerInterface $logger)
    {
        $this->logger->info('Starship collection retrieved');
    }

    public function findAll(): array
    {
        return [new Starship(
            1,
            'Uss Leafy Cruiser',
            'garden',
            'Lean-luc',
            StarshipStatusEnum::IN_PROGRESS
        ),

            new Starship(
                2,
                'Uss Espresso',
                'Latte',
                'James t. Quick!',
                StarshipStatusEnum::COMPLETED
            ),

            new Starship(
                3,
                'Uss WanderLust',
                'Delta Tourist',
                'Denny Nice',
                StarshipStatusEnum::WAITING
            ), ];
    }

    public function find(int $id): ?Starship
    {
        foreach ($this->findAll() as $starship) {
            if ($starship->getId() === $id) {
                return $starship;
            }
        }
        return null;
    }
}
