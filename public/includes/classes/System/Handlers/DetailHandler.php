<?php namespace System\Handlers;

use System\Databases\Database;
use System\Products\Product;

/**
 * Class DetailHandler
 * @package System\Handlers
 */
class DetailHandler extends BaseHandler
{
    public function initialize(): void
    {
        //Init the database
        $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();

        try {
            //Get the records from the db
            $product = Product::getById($_GET['id'], $db);

            //Default page title
            $pageTitle = $product->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $errors[] = $e->getMessage();
            $pageTitle = 'Dit product bestaat niet';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'product' => $product ?? false,
            'errors' => $this->errors
        ]);
    }
}