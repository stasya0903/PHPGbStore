<?php


namespace App\services;



class DB implements IDB
{
    function connect()
    {
        static $link;
        if (empty($link)) {
            $link = mysqli_connect('localhost', 'root', 'root', 'onlineShop');
        }
        return $link;
    }

    public function find(string $sql)
    {

         return (mysqli_fetch_assoc( mysqli_query($this->connect(), $sql)));



    }

    public function findAll(string $sql)
    {
      $result = mysqli_query($this->connect(), $sql);
        $allResults = [];
        while ($each  = mysqli_fetch_assoc($result)){
            array_push($allResults, $each);
        }
        return $allResults;
    }


    public function insert()
    {
        // TODO: Implement insert() method.
    }


}