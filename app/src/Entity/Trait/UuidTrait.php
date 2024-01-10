<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait UuidTrait
{
    #[ORM\Id]
    #[ORM\Column(name: 'id')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(): static
    {
        $this->id = Uuid::uuid4();

        return $this;
    }
}
