<?php


namespace App\modules;
use App\services\DB;


/**
 * Class Model
 *  * @property int $id
 */
abstract class Model
{
    /**
     * @var DB
     */

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

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->queryObj($sql,static::class,[':id' => $id ]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->queryObjs($sql, static::class);
    }

    protected function insert($params = [])
    {
        $dataToInsert = [];
        $params = [];

        foreach ($this as $property => $value) {
            if ($property == 'bd' || empty($value) ) {
                continue;
            }
            $dataToInsert[] = $property;
            $params[":{$property}"] = $value;
        }

        $tableName = $this->getTableName();

        $data = implode (", ", $dataToInsert);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName}( {$data}) VALUES ($values)";

       $this->bd->execute($sql, $params);
       $this->id = $this->bd->lastInsertId();
    }

    public function delete($params = [])
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id= :id ";
        return $this->bd->execute($sql, [':id' => $this->id ] );
    }

    protected function update($params = [])
    {
        $allDataToInsert = [];
        $allValues = [];

        foreach ($this as $data => $value ) {

            if ($data == 'bd' || empty($value) ) {
                continue;
            }
            if($data == 'id'){
                $allValues[":${data}"] = $value;
                continue;
            }

            $allValues[":${data}"] = $value;
            array_push($allDataToInsert, "${data} = :{$data}");

        }

        $strToSetUpdate = implode(", ",$allDataToInsert);

        $tableName = $this->getTableName();

        $sql = "UPDATE {$tableName} SET  {$strToSetUpdate} WHERE id = :id ";

        return $this->bd->execute($sql, $allValues);

    }

    public function save()

    {
        $id = $this->id ?: '';

        if (!empty($id) && $this->getOne($id)) {

            return $this->update();

        }
        return $this->insert();
    }

}