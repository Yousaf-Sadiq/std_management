<?php
declare(strict_types=1);
require_once dirname(__DIR__) . "/../../app/database.php";
use App\database\DB as DB;

$db = new DB();
if (isset($_POST["p_id"]) && !empty($_POST["p_id"])) {


    $pId = $_POST["p_id"];

    $fetch = $db->select(true, _Parent, "*");

    if ($fetch) {
        $p_row = $db->GetResult();

        $html = [];
        foreach ($p_row as $key => $value) {
            if ($_POST["p_id"] == $value["p_id"]) {

                array_push($html, "<option value='{$value["p_id"]}' selected>{$value['f_name']}  {$value['l_name']}</option>");
            
            } else {
                array_push($html, "<option value='{$value["p_id"]}' > {$value['f_name']}  {$value['l_name']}</option>");
            }

        }

        echo json_encode($html);
    }
}
?>