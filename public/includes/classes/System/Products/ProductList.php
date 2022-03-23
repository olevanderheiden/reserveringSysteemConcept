<?php

namespace System\Products;

/**
 * Class List
 * @package System\Products
 */

class ProductList
{
    private array $products = [];

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     */
    public function add(array $products): void
    {
        $this->products = $products;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return count($this->products);
    }

}