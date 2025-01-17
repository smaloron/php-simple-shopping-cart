<?php
class ShoppingCart
{
    private array $items = [];

    public function addItem(string $item, int $quantity, float $price): void
    {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Quantity must be greater than zero.");
        }
        if ($price < 0) {
            throw new InvalidArgumentException("Price cannot be negative.");
        }

        if (isset($this->items[$item])) {
            $this->items[$item]['quantity'] += $quantity;
        } else {
            $this->items[$item] = [
                'quantity' => $quantity,
                'price' => $price,
            ];
        }
    }

    public function removeItem(string $item): void
    {
        if (!isset($this->items[$item])) {
            throw new InvalidArgumentException("Item not found in the cart.");
        }
        unset($this->items[$item]);
    }

    public function calculateTotal(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return $total;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function clearCart(): void
    {
        $this->items = [];
    }
}

