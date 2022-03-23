<?php

namespace System\Handlers;

use System\Databases\Database;
use System\Reservations\Reservation;
use System\Orders\Order;

class ReservationHandler extends BaseHandler
{

    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        if ( !isset($_SESSION['reservation']))
        {
            $code = uniqid();
            //TEMP script just to add an user.
            $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
            $reservation = new Reservation();
            $reservation->setCode(md5($code));
            Reservation::add($reservation, $db);
            $_SESSION['reservation'] = $db->lastInsertId();
            $order = new  Order();
            $order->setProductId($_GET['id']);
            $order->setReservationId($_SESSION['reservation']);
            $order->setAmount(1);
            Order::add($order,$db);

            header("Location: productList");
            exit;


        }
        else
        {
            $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
//            print_r($_SESSION);
            $order = Order::checkExist($db);
            $order->setAmount($order->getAmount()+1);
            $order->updateAmount($db);
            header("Location: productList");
            exit;
        }

    }
}