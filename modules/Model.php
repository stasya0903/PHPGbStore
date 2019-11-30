<?php


namespace App\modules;
use App\services\IDB;


/**
 * Class Model
 */
abstract class Model
{


    protected $bd;

    public function __construct(IDB $bd)
    {
        $this->bd = $bd;
    }

    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    abstract public function getTableName(): string;

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = '{$id}'";
        return $this->bd->find($sql);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->findAll($sql);
    }

    public function insert()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->insert($sql);
    }
}