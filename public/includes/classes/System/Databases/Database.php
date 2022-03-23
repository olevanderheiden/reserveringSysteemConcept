<?php namespace System\Databases;
/**
 * Class Database
 * @package Databases
 */

class Database
{
    private string $host;
    private string $userName;
    private string $password;
    private string $dbname;

    /**
     * @var \PDO
     */
    private \PDO $connection;

    /**
     * Database constructor
     *
     * @param $host
     * @Param $userName
     * @Param $password
     * @Param $dbname
     * @throws \Exception
     */
    public function __construct($host, $userName, $password, $dbname)
    {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }

    /**
     * Connect function
     * @throws \Exception
     */
    private function connect(): void
    {
        try {
            $this->connection = new \PDO("mysql:dbname=$this->dbname;host=$this->host",
                $this->userName, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("DB connection failed: {$e->getMessage()}");
        }
    }
    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->connection;
    }

}