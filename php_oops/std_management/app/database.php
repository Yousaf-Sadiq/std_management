<?php
declare(strict_types=1);
namespace App\database;
require_once dirname(__DIR__) . "/include/table.php";
require_once dirname(__DIR__) . "/include/web.php";


require_once dirname(__FILE__) . "/trait/insert.php";
require_once dirname(__FILE__) . "/trait/checkTable.php";
require_once dirname(__FILE__) . "/trait/Mysql.php";
require_once dirname(__FILE__) . "/trait/select.php";
require_once dirname(__FILE__) . "/trait/FetchData.php";
require_once dirname(__FILE__) . "/trait/update.php";
require_once dirname(__FILE__) . "/trait/delete.php";
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


    public function GetId()
    {
        return $this->conn->insert_id;
    }

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

    public function FileUPload(string $input, array $ext, string $to)
    {

        /**
         * relative path C://xampp/htdocs/php_oops/std_management//admin/students/add_student.php
         * absolute path  http://localhost/php_oops/std_management//admin/students/add_student.php
         */

        $file = $_FILES[$input];
        $file_name = rand(1, 99) . "_" . $file["name"];
        $tmp_name = $file["tmp_name"];

        $extention = $ext; // ["png","jpg","jpeg"]


        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); // PNG ,JPEG
        $file_ext = strtolower($file_ext);

        if (!in_array($file_ext, $extention)) {

            return 5;
        }

        $rel_url = rel_url . $to . $file_name;
        $abs_url = abs_url . $to . $file_name;

        if (move_uploaded_file($tmp_name, $rel_url)) {
            $q = [
                "relUrl" => $rel_url,
                "absUrl" => $abs_url
            ];
            return $q;
        } else {
            return 9;
        }

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