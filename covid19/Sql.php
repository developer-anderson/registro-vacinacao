<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 18/12/18
 * Time: 15:07
 */

//namespace Classes;
class Sql
{
    const HOSTNAME = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DBNAME   = "cassiturismo";
    protected $conn;

    public function __construct()
    {
        $this->conn = new \PDO(
            "mysql:host=localhost;dbname=covid19;charset=utf8", "root", ""            
        );
    }
    private function setParams($statement, $parameters = array())
    {
        foreach ($parameters as $key => $value) {

            $this->bindParam($statement, $key, $value);
        }
    }
    private function bindParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }
    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
    }
    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}