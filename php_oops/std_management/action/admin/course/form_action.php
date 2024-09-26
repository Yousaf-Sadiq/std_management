<?php
declare(strict_types=1);
require_once dirname(__DIR__) . "/../../app/database.php";

use App\database\helper as help;
use App\database\DB as DB;

$help = new help;
$db = new DB;
if (isset($_POST["inserts"]) && !empty($_POST["inserts"])) {

    $course_name = $help->filter_data($_POST["c_name"]);
    $course_name = strtoupper($course_name);

    $c_outline = $_POST["c_outline"];

    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($course_name) || empty($course_name)) {
        $status['error']++;
        array_push($status["msg"], "COURSE NAME IS REQUIRED");
    }

    if (!isset($c_outline) || empty($c_outline)) {
        $status['error']++;
        array_push($status["msg"], "COURSE OUTLINE IS REQUIRED");
    }

    $check = "SELECT * FROM `" . COURSE . "` WHERE `course_name`='{$course_name}' ";
    $exe = $db->Mysql($check, true);

    if ($exe) {

        $status['error']++;
        array_push($status["msg"], "COURSE NAME ALREADY EXIST");
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

        return;
    } else {

        $data = [
            "course_name" => $course_name,
            "course_outline" => $c_outline
        ];

        echo $db->insert(COURSE, $data);
    }
}


?>