<?php

require 'Config.php';

class Db
{
    private $connection;

    public function __construct()
    {
        $config = new Config();

        $this->connection = new mysqli(
            $config->dbServername,
            $config->dbUsername,
            $config->dbPassword,
            $config->dbDbName,
            $config->dbServerport
        );

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getData($table, $where, $order = null)
    {
        $records = [];

        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $where;

        if ($order !== null) {
            $sql = $sql . " ORDER BY " . $order;
        }

        $resultSet = $this->connection->query($sql) or die('Error' . mysqli_error($this->connection) . ' sql: ' . $sql);

        while ($record = mysqli_fetch_assoc($resultSet)) {
            $records[] = $record;
        }

        return $records;
    }
}