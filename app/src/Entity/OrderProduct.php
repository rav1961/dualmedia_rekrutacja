<?php

namespace App\Entity;

use App\Entity\Trait\UuidTrait;
use App\Repository\OrderProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'order_products')]
class OrderProduct
{
    use UuidTrait;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Product $products;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private Order $orderId;

    #[ORM\Column(type: Types::INTEGER, options: ["unsigned" => false])]
    private int $quantity;

    public function getProducts(): Product
    {
        return $this->products;
    }

    public function setProducts(Product $products): static
    {
        $this->products = $products;

        return $this;
    }

    public function getOrderId(): Order
    {
        return $this->orderId;
    }

    public function setOrderId(Order $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
}
