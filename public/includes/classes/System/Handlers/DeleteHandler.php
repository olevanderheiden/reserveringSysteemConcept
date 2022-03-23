<?php namespace System\Handlers;

use System\Databases\Database;
use System\Products\Product;
//use System\Utils\Image;

/**
 * Class DeleteHandler
 * @package System\Handlers
 */
class DeleteHandler extends BaseHandler
{
    public function initialize(): void
    {

        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: login');
            exit;
        }

        //Init the database
        $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();

        try {
            //Get the record from the db
            $product = Product::getById($_GET['id'], $db);

            //Database magic when no errors are found
            if ($product) {
//                //Init image class
//                $image = new Image();

                //Save the record to the db
                $product->delete($db);

             //Remove image
//                $image->delete($album->image);

                //Redirect to homepage after deletion & exit script
                header("Location: productList");
                exit;
            }
        } catch (\Exception $e) {
            //There is nog delete template, always redirect.
            header("Location: productList");
            exit;
        }
    }
}