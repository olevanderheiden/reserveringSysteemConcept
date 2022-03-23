<?php

namespace System\Handlers;

use System\Form\Data;
use System\Form\Validation\ProductValidator;

/**
 * Trait ProductFillAndValidate
 * @package System\Handlers
 */

trait ProductFillAndValidate
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->product->name= $this->formData->getPostVar('name');
            $this->product->description= $this->formData->getPostVar('description');
            $this->product->price = $this->formData->getPostVar('price');

            //Actual validation
            $validator = new ProductValidator($this->product);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}