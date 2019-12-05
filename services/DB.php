<?php


namespace App\services;
use App\modules\Good;
use App\traits\TSingleton;
use App\modules\Model;

class DB implements IDB
{
    use TSingleton;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'db' => 'onlineshop',
        'charset' => 'UTF8',
        'username' => 'root',
        'password' => 'root',

    ];
    protected $connect;

    protected function getConnection($params = []){

        if(empty($this->connect)){
            $this->connect = new \PDO(
                $this->getPrepareDsnString(),
                $this->config['username'],
                $this->config['password']

            );

            $this->connect->setAttribute
            (
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC);
        }

        return $this->connect;
    }

    protected function getPrepareDsnString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['db'],
            $this->config['charset']
        );


    }

    protected function query($sql, $params = [] )
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function find(string $sql,$params = [])
    {

        return $this->query($sql, $params)->fetch();



    }

    public function findAll(string $sql )
    {
        return $this->query($sql )->fetchAll();
    }

    public function execute(string $sql, $params = [])
    {
        return $this->query($sql, $params);
    }







}