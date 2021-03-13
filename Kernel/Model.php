<?php
namespace Kernel;

use Kernel\Database\DB;
use Kernel\Database\DBInterface;

abstract class Model
{
    private $db;
    private $util;
    private $sql;

    public function __construct()
    {

        /**
         * Не стоит так делать, лучше использовать DI,
         * создать контейнер-обертку(PSR-11 https://www.php-fig.org/psr/psr-11/)
         * @var DBInterface db
         */
        $this->db = new DB();
        $this->util = new Util();
    }

    public function find($id)
    {

        $this->sql = "WHERE id=$id";
        return $this;

    }

    public function get($select = ["*"])
    {
        // Получаем названия таблицы из названия вызываемого класса.
        $className = (new \ReflectionClass(get_called_class()))->getShortName() . 's';
        $model = $this->util->lowercase($className);

        if (!is_array($select)) $select = array($select);

        $select = implode(',', $select);

        $sql = "SELECT $select FROM $model $this->sql;";
        $statement = $this->db->query($sql);
        return new Collection($statement->fetchAll());
    }

    public function first()
    {
        $statement = $this->db->query($this->sql);
        return (new Collection($statement->fetchAll()))->first();
    }

}