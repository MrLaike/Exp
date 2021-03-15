<?php
namespace Kernel;

use Kernel\Database\DB;
use Kernel\Database\DBInterface;

/**
 * По хорошему стоило бы создать еще один слой абстакция
 * под формирования sql запросов
 */
abstract class Model
{
    /** @var DB */
    private $db;

    /** @var Util  */
    private $util;

    /** @var string */
    private $sql;

    /** @var string */
    private $select;

    /** @var string */
    protected $table;

    public function __construct()
    {

        /**
         * Не стоит так делать, лучше использовать DI,
         * создать контейнер-обертку(PSR-11 https://www.php-fig.org/psr/psr-11/)
         *
         * @var DBInterface db
         */
        $this->db = new DB();
        $this->util = new Util();

        // Получаем названия таблицы из названия вызываемого класса.
        if(empty($this->table)) {
            $className = (new \ReflectionClass(get_called_class()))->getShortName() . 's';
            $this->table = $this->util->lowercase($className);
        }

    }

    public function find($id)
    {
        $this->sql = "WHERE id=$id";

        return $this;
    }

    public function join($table, $tableColumn, $operator, $modelColumn, $select='')
    {
        if(!empty($select)) $this->select = $select;
        $this->sql = "JOIN $table ON $tableColumn $operator $modelColumn";

        return $this;
    }

    public function leftJoin($table, $tableColumn, $operator, $modelColumn, $select='')
    {
        $this->join($table, $tableColumn, $operator, $modelColumn, $select);
        $this->sql = "LEFT $this->sql";

        return $this;
    }

    public function rightJoin($table, $tableColumn, $operator, $modelColumn, $select='')
    {
        $this->join($table, $tableColumn, $operator, $modelColumn, $select);
        $this->sql = "RIGHT $this->sql";

        return $this;
    }

    public function get($select = ["*"])
    {

        if (!empty($this->select)) $select = $this->select;
        if (!is_array($select)) $select = array($select);
        $select = implode(',', $select);

        $sql = "SELECT $select FROM $this->table $this->sql;";

        /**
         * По хорошему стоит отлавливать не через общий класс Exception
         * а реализовать перехват разного рода ошибок(при необходимости создать кастомные)
         */
        try {
            $statement = $this->db->query($sql);
        } catch (\Exception $e) {
            View::render('error', $e->getMessage());
            die();
        }

        return new Collection($statement->fetchAll());
    }


    /**
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        // если передается массив id то преоброзовать в строку
        // ex. "1,4,5"
        if(is_array($id)) $id = implode(', ', $id);

        $sql = "DELETE FROM $this->model WHERE id IN ($id)";
        try {
            $statement = $this->db->query($sql);
        } catch (\Exception $e) {
            View::render('error', $e->getMessage());
            die();
        }
        return $statement->errorInfo();
    }

    public function create(array $data)
    {
        $key = implode(', ', array_keys($data));
        // оборачиваем значения в кавычки и объединяем
        // ex. [value1, value2, value3] = value1", "value2", "value3
        $value = implode('", "', array_values($data));

        $sql = "INSERT INTO $this->table ($key) VALUES (\"$value\")";
        try {
            $statement = $this->db->query($sql);
        } catch (\Exception $e) {
            View::render('error', $e->getMessage());
            die();
        }
        return $statement;
    }

    public function first()
    {
        $statement = $this->db->query($this->sql);
        return (new Collection($statement->fetchAll()))->first();
    }

}