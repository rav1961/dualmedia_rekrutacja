<?php

namespace App\Entity;

use App\Entity\Trait\UuidTrait;
use App\Enum\OrderStatus;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: '`orders`')]
class Order
{
    use UuidTrait;

    #[ORM\Column(length: 255)]
    private string $customerName;

    #[ORM\OneToMany(mappedBy: 'orderId', targetEntity: OrderProduct::class)]
    private Collection $orderProducts;

    #[ORM\Column(type: Types::INTEGER)]
    private int $amount;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private string $totalVat;

    #[ORM\Column(enumType: OrderStatus::class)]
    private OrderStatus $status;

    public function __construct(
        string $customerName,
        Collection $orderProducts,
        int $amount,
        float $totalVat
    )
    {
        $this->customerName = $customerName;
        $this->orderProducts = $orderProducts;
        $this->amount = $amount;
        $this->totalVat = $totalVat;
        $this->status = OrderStatus::NEW;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): static
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->add($orderProduct);
            $orderProduct->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): static
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrderId() === $this) {
                $orderProduct->setOrderId(null);
            }
        }

        return $this;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getTotalVat(): string
    {
        return $this->totalVat;
    }
}
