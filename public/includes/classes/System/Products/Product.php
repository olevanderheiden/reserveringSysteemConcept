<?php

namespace System\Products;

use System\Reservations\Reservation;

class Product
{
    public int $id;
    public string $name = '';
    public string $description = '';
    public string $price = '';

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $price
     */

    public static function add(Product $product, \PDO $db): bool
    {
        $query = "INSERT INTO products (name,description,price)
                  VALUES (:name,:description,:price)";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':name' => $product->name,
            ':description'=> $product->description,
            ':price'=> $product->price,
        ]);
    }

    /**
     * @param \PDO $db
     * @return bool
     */
    public function update(\PDO $db): bool
    {
        $query = "UPDATE products
                  SET name = :name, description = :description, price = :price
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':price' => $this->price,
            ':id' => $this->id
        ]);
    }

    public function delete(\PDO $db): bool
    {
        $query = "DELETE FROM products
                  WHERE id = :id";
        $statement = $db->prepare($query);
        return $statement->execute([':id' => $this->id]);
    }

    /**
     * Get all products from the database
     *
     * @param \PDO $db
     * @return Product[]
     */
    public static function getAll(\PDO $db): array
    {
        return $db->query("SELECT * FROM products")->fetchAll(\PDO::FETCH_CLASS, "System\\Products\\Product");
    }

    /**
     * Get a specific album by its ID
     *
     * @param int $id
     * @param \PDO $db
     * @return Product
     * @throws \Exception
     */
    public static function getById(int $id, \PDO $db): Product
    {
        $statement = $db->prepare("SELECT * FROM products WHERE id = :id");
        $statement->execute([':id' => $id]);

        if (($product = $statement->fetchObject("System\\Products\\Product")) === false) {
            throw new \Exception("Dit product bestaat niet!");
        }

        return $product;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }



}