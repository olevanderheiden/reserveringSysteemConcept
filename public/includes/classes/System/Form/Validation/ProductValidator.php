<?php

namespace System\Form\Validation;

use System\Products\Product;

/**
 * Class AlbumValidator
 * @package System\Form\Validation
 */

class ProductValidator implements Validator
{
    private array $errors = [];
    private Product $product;

    /**
     * AlbumValidator constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->product->name == "") {
            $this->errors[] = 'Product moet een naam hebben!';
        }
        if ($this->product->description == "") {
            $this->errors[] = 'Product moet een omschrijving hebben';
        }
        if ($this->product->price == "") {
            $this->errors[] = 'Product moet een prijs hebben';
        }
    }

    /**
     * @inheritDoc
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}