<?php

namespace System\Reservations;
use System\Orders\Order;
use System\Users\User;

class Reservation
{
    private int $id;
    private ?string $date = '';
    private ?string $time = '';
    private ?string $eMail = '';
    private string $code = '';



    public static function add(Reservation $reservation, \PDO $db): bool
    {
        $query = "INSERT INTO reservations (code)
                  VALUES (:code)";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':code'=> $reservation->code,
        ]);
    }

    /**
     * Get a specific reservation by its Code
     *
     * @param int $id
     * @param \PDO $db
     * @return Reservation
     * @throws \Exception
     */
    public static function getByCode(string $code, \PDO $db): Reservation
    {
        $statement = $db->prepare("SELECT * FROM reservations WHERE code = :code");
        $statement->execute([':code' => $code]);


        if (($reservation = $statement->fetchObject("System\\Reservations\\Reservation")) === false) {
            throw new \Exception("Dit product bestaat niet!");
        }

        return $reservation;
    }

    public static function recieveCode(int $id,\PDO $db): array
    {
        $statement = $db->prepare("SELECT code FROM reservations WHERE id = :id");
        $statement->execute([':id' => $id]);


        if (($code = $statement->fetch()) === false) {
            throw new \Exception("Dit product bestaat niet!");
        }

        return $code;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getEMail(): string
    {
        return $this->eMail;
    }

    /**
     * @param string $eMail
     */
    public function setEMail(string $eMail): void
    {
        $this->eMail = $eMail;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

}