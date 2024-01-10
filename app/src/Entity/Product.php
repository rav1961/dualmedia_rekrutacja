<?php

namespace App\Entity;

use App\Entity\Trait\UuidTrait;
use App\Enum\ProductStatus;
use App\Exception\ProductException;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'products')]
class Product
{
    use UuidTrait;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descText = null;

    #[ORM\Column(type: Types::INTEGER, options: ["unsigned" => false])]
    private int $price;

    #[ORM\Column(type: Types::INTEGER, enumType: ProductStatus::class)]
    private ProductStatus $status;

    /**
     * @throws ProductException
     */
    public function __construct(string $title, int $price, ProductStatus $status, ?string $descText = null)
    {
        if ($price < 0) {
            throw new ProductException('Cena nie może być ujemna!');
        }

        $this->title = $title;
        $this->price = $price;
        $this->status = $status;
        $this->descText = $descText;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescText(): ?string
    {
        return $this->descText;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getStatus(): ProductStatus
    {
        return $this->status;
    }
}
