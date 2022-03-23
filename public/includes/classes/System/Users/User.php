<?php

namespace System\Users;

class User
{
    private int $id;
    private string $email ='';
    private string $firstName = '';
    private string $lastName = '';
    private string $password = '';
    private int $rank;
    private bool $status;


    public static function add(User $user, \PDO $db): bool
    {
        $query = "INSERT INTO users (email,first_name, last_name,password,rank,status)
                  VALUES (:email,:first_name,:last_name,:password, :rank,:status)";
        $statement = $db->prepare($query);
        return $statement->execute([
            ':email' => $user->email,
            ':first_name'=> $user->firstName,
            ':last_name'=> $user->lastName,
            ':password' => $user->password,
            ':rank'=> $user->rank,
            ':status' => $user->status,
        ]);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int|string
     */
    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return string
     */
    public function getFirsName(): string
    {
        return $this->firsName;
    }

    /**
     * @param string $firsName
     */
    public function setFirsName(string $firsName): void
    {
        $this->firsName = $firsName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getBirthDay(): string
    {
        return $this->birthDay;
    }

    /**
     * @param string $birthDay
     */
    public function setBirthDay(string $birthDay): void
    {
        $this->birthDay = $birthDay;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public static function getByEmail(string $email, \PDO $db): User
    {
        $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute([':email' => $email]);

        if (($user = $statement->fetchObject("System\\Users\\User")) === false) {
            throw new \Exception("User email is not available in the database");
        }

        return $user;
    }

}