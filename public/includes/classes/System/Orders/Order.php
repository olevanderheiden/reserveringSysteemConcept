<?php

namespace System\Orders;


use System\Products\Product;

class Order
{
    private int $id;
    private int $reservationId = 0;
    private int $productId = 0;
    private int $amount = 0;


    public static function add(Order $order, \PDO $db): bool
    {
        $query = "INSERT INTO orders (product_id,reservation_id,amount)
                  VALUES (:product_id,:reservation_id,:amount)";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':product_id' => $order->productId,
            ':reservation_id' => $order->reservationId,
            ':amount' => $order->amount,
        ]);
    }

    /**
     * Get a specific album by its ID
     *
     * @param int $id
     * @param \PDO $db
     * @return Product
     * @throws \Exception
     */
    public static function getById(int $id, \PDO $db): Order
    {
        $statement = $db->prepare("SELECT * FROM orders WHERE id = :id");
        $statement->execute([':id' => $id]);

        if (($order = $statement->fetchObject("System\\Orders\\Order")) === false) {
            throw new \Exception("Deze order bestaat niet!");
        }

        return $order;
    }


    /**
     * @param \PDO $db
     * @return Order
     * check if order exist if not create the new order
     */
    public static function checkExist(\PDO $db): Order
    {
        $statement = $db->prepare("SELECT * FROM orders WHERE reservation_id = :reservation_id AND product_id = :product_id");
        $statement->execute([
            ':reservation_id' => $_SESSION['reservation'],
            ':product_id' => $_GET['id'],
        ]);

        if (($order = $statement->fetchObject("System\\orders\\order")) === false) {

            $query = "INSERT INTO orders (product_id,reservation_id,amount)
                  VALUES (:product_id,:reservation_id,:amount)";
            $statement = $db->prepare($query);
            $statement->execute([
                ':product_id' => $_GET['id'],
                ':reservation_id' => $_SESSION['reservation'],
                ':amount' => 0,
            ]);
            $order_id = $db->lastInsertId();
            $statement = $db->prepare("SELECT * FROM orders WHERE id = :id");
            $statement->execute([
                ':id' => $order_id,
            ]);
            $order = $statement->fetchObject("system\\orders\\order");
        }

//
        print_r($order);
        return $order;
    }

    public static function getByReservationId(int $reservation_id, \PDO $db): array
    {
        $statement = $db->prepare("SELECT orders.amount, products.name, orders.id, products.price FROM orders
                                            INNER JOIN  products on products.id = orders.product_id
                                            WHERE reservation_id = :reservation_id");
        $statement->execute([':reservation_id' => $reservation_id]);
        $orders = $statement->fetchAll(\PDO::FETCH_CLASS, "System\\Orders\\Order");
        return $orders;
    }


    /**
     * @param \PDO $db
     * @return bool
     */
    public function updateAmount(\PDO $db): bool
    {
        $query = "UPDATE orders
                  SET amount = :amount
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':amount' => $this->amount,
            ':id' => $this->id
        ]);
    }


    public function delete(\PDO $db): bool
    {
        $query = "DELETE FROM orders
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([':id' => $this->id]);
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    /**
     * @param int $reservation_id
     */
    public function setReservationId(int $reservationId): void
    {
        $this->reservationId = $reservationId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

}