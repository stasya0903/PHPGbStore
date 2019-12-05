<?php


namespace App\modules;
use App\services\DB;


/**
 * Class Model
 */
abstract class Model
{

    protected $bd;

    public function __construct()
    {

        $this->bd = DB::getInstance();
    }

    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    abstract public function getTableName(): string;
    abstract public function getClassName(): string;

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->find($sql,[':id' => $id ]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->findAll($sql);
    }

    public function insert($params = [])
    {
        $tableName = $this->getTableName();

        $allDataToInsert = [];
        $allValues = [];
        foreach ($params as $data => $value ) {

            if ($data == "id"){
                continue;
            }

            array_push($allDataToInsert, $data);
            $allValues[":${data}"] = $value;

        }
        $data = implode (", ", $allDataToInsert);
        $values = implode(",:", $allDataToInsert);

        $sql = "INSERT INTO {$tableName}( {$data}) VALUES (:$values)";

        return $this->bd->execute($sql, $allValues);
    }

    public function delete($params = [])
    {

        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE name_product= :name ";
        return $this->bd->execute($sql, [':name' => $params['name_product'] ] );

    }

    public function update($params = [])
    {

        $tableName = $this->getTableName();
        $allDataToInsert = [];
        $allValues = [];

        foreach ($params as $data => $value ) {

            $allValues[":${data}"] = $value;
            if ($data == "id") {
                continue;
            }
            array_push($allDataToInsert, "${data} = :{$data}");

        }

        $strToSetUpdate = implode(", ",$allDataToInsert);

        $sql = "UPDATE {$tableName} SET  {$strToSetUpdate} WHERE id = :id ";

        return $this->bd->execute($sql, $allValues);

    }

    public function save($params)
    {
        if ($this->getOne($params["id"])) {
            $this->update($params);
            return;
        }

        $this->insert();
    }

}