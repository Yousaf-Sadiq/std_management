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



if (isset($_POST["updates"]) && !empty($_POST["updates"])) {

    $course_name = $help->filter_data($_POST["c_name"]);
    $course_name = strtoupper($course_name);

    $c_outline = $_POST["c_outline"];
    $c_id = $_POST["c_id"];
    $c_status = $_POST["c_status"];


    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($course_name) || empty($course_name)) {
        $status['error']++;
        array_push($status["msg"], "COURSE NAME IS REQUIRED");
    }



    if (!isset($c_status)) {
        $status['error']++;
        array_push($status["msg"], "COURSE STATUS IS REQUIRED");
    }

    if (!isset($c_outline) || empty($c_outline)) {
        $status['error']++;
        array_push($status["msg"], "COURSE OUTLINE IS REQUIRED");
    }

    $check = "SELECT * FROM `" . COURSE . "` WHERE `course_name`='{$course_name}' AND `c_id`<> '{$c_id}'  ";
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
            "course_outline" => $c_outline,
            "course_status" => $c_status
        ];

        echo $db->update(COURSE, $data, "`c_id`='{$c_id}'");
    }
}




if (isset($_POST["deletes"]) && !empty($_POST["deletes"])) {

    $c_id = $_POST["c_id"];


    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($c_id) || empty($c_id)) {
        $status['error']++;
        array_push($status["msg"], "COURSE ID IS REQUIRED");
    }



    $check = "SELECT * FROM `" . COURSE . "` WHERE `c_id`='{$c_id}'";
    $exe = $db->Mysql($check, true);

    if (!$exe) {

        $status['error']++;
        array_push($status["msg"], "Invalid ID");
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

        return;
    } else {

        // $data = [
        //     "course_name" => $course_name,
        //     "course_outline" => $c_outline,
        //     "course_status" => $c_status
        // ];

        echo $db->delete(COURSE, "`c_id`='{$c_id}'");
    }
}

?>