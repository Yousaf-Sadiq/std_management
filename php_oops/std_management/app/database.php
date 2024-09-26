<?php
declare(strict_types=1);
namespace App\database;


require_once dirname(__FILE__) . "/trait/insert.php";
require_once dirname(__FILE__) . "/trait/checkTable.php";
require_once dirname(__FILE__) . "/trait/Mysql.php";
require_once dirname(__FILE__) . "/trait/select.php";
require_once dirname(__FILE__) . "/trait/FetchData.php";
require_once dirname(__FILE__) . "/trait/update.php";
require_once dirname(__FILE__) . "/trait/delete.php";
require_once dirname(__DIR__) . "/include/table.php";
class DB
{

    private $HOST = "localhost";
    private $username = "root";
    private $pass = "";
    private $db = "std_managment_oops";

    private $exe;

    private $query;


    protected $conn;

    private $result = [];
    // insert function 

    use \Insert, \CheckTable, \Mysql, \Select, \FetchData, \Update, \Delete;


    public function __construct()
    {

        $this->conn = new \mysqli($this->HOST, $this->username, $this->pass, $this->db);

        if ($this->conn) {
            // echo "established";
        } else {
            echo $this->conn->error;
        }

    }







    // ==================check table function===========================================


    public function __destruct()
    {
        $this->conn->close();
    }




}


class helper extends DB
{
    public function pre(array $a)
    {
        echo "<pre>";
        print_r($a);
        echo "</pre>";
    }

    public function filter_data(string $data)
    {

        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = $this->conn->real_escape_string($data);

        return $data;
    }



}
?>