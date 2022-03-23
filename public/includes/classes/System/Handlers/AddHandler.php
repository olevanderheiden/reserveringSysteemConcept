<?php

namespace System\Handlers;
use System\Databases\Database;
use System\Form\Data;
use System\Products\Product;

class AddHandler extends BaseHandler
{
    use ProductFillAndValidate;
    private Product $product;
    public function initialize(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: login');
            exit;
        }

        //Set default empty product & execute POST logic
        $this->product = new Product();
        $this->executePostHandler();

//        //Special check for add form only
//        if (isset($this->formData) && $_FILES['image']['error'] == 4) {
//            $this->errors[] = 'Image cannot be empty';
//        }

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {

            //Store image & retrieve name for database saving
//            $image = new Image();
//            $this->album->image = 'images/' . $image->save($_FILES['image']);

            //Init the database
            $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();

            //Save the record to the db
            if (Product::add($this->product, $db)) {
                $success = "Product is toegevoegd!";
                //Override to see a new empty form
                $this->product = new Product("", "", "", "");
            } else {
                //TODO: remove from errors, logging!
                $this->errors[] = "Database error info: " . $db->errorInfo();
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Product Toevoegen',
            'product' => $this->product ?? false,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }
}