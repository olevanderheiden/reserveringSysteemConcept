<?php namespace System\Handlers;

use System\Databases\Database;
use System\Orders\Order;
use System\Products\Product;
//use System\Utils\Image;

/**
 * Class DeleteHandler
 * @package System\Handlers
 */
class DeleteOrderhandler extends BaseHandler
{
    public function initialize(): void
    {


        //Init the database
        $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();

        try {
            //Get the record from the db
            $order = Order::getById($_GET['id'], $db);

            //Database magic when no errors are found
            if ($order) {
//                //Init image class
//                $image = new Image();

                //Save the record to the db
                $order->delete($db);

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