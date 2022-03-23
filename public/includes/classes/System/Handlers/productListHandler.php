<?php

namespace System\Handlers;

use System\Databases\Database;
use System\Products\Product;
use System\Products\ProductList;
use System\Reservations\Reservation;

class productListHandler extends BaseHandler
{

    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
        if (isset($_SESSION['reservation']))
        {
            $id = $_SESSION['reservation'];
            $code = Reservation::recieveCode($id,$db);
        }
        else
        {
            $code['code'] = null;
        }
        //Init the database

        //Create new instance of productList & set Products
        $productList = new ProductList();
        $productList->add(Product::getAll($db));

        //return formatted data

        $this->renderTemplate([
            'pageTitle' => 'Producten',
            'products' => Product::getAll($db),
            'totalProducts' =>  $productList->getTotal(),
            'code' => $code['code']
        ]);
    }
}