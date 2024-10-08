<?php
declare(strict_types=1);
require_once dirname(__DIR__) . "/../../app/database.php";

use App\database\helper as help;
use App\database\DB as DB;

$help = new help;
$db = new DB;

if (isset($_POST["inserts"]) && !empty($_POST["inserts"])) {

    $p_f_name = $help->filter_data($_POST["p_f_name"]);
    $p_l_name = $help->filter_data($_POST["p_l_name"]);
    $p_email = $help->filter_data($_POST["p_email"]);
    $p_number = $help->filter_data($_POST["p_number"]);


    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($p_f_name) || empty($p_f_name)) {
        $status['error']++;
        array_push($status["msg"], "FIRST NAME IS REQUIRED");
    }

    if (!isset($p_l_name) || empty($p_l_name)) {
        $status['error']++;
        array_push($status["msg"], "LAST NAME IS REQUIRED");
    }

    if (!isset($p_number) || empty($p_number)) {
        $status['error']++;
        array_push($status["msg"], "NUmber IS REQUIRED");
    }

    if (!isset($p_email) || empty($p_email)) {
        $status['error']++;
        array_push($status["msg"], "EMAIL IS REQUIRED");
    }



    $check = "SELECT * FROM `" . _Parent . "` WHERE `email`='{$p_email}' ";
    $exe = $db->Mysql($check, true);

    if ($exe) {

        $status['error']++;
        array_push($status["msg"], "EMAIL ALREADY EXIST");
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

        return;
    } else {

        $pswd = password_hash("123456", PASSWORD_BCRYPT);
        $encrypt = base64_encode("123456");

        $data = [
            "f_name" => $p_f_name,
            "l_name" => $p_l_name,
            "email" => $p_email,
            "password" => $pswd,
            "ptoken" => $encrypt,
            "contact" => $p_number
        ];

        echo $db->insert(_Parent, $data);
    }
}



if (isset($_POST["updates"]) && !empty($_POST["updates"])) {


    $p_f_name = $help->filter_data($_POST["p_f_name"]);
    $p_l_name = $help->filter_data($_POST["p_l_name"]);
    $p_email = $help->filter_data($_POST["p_email"]);
    $p_number = $help->filter_data($_POST["p_number"]);
    $p_id = $help->filter_data($_POST["p_id"]);
    $p_status = $help->filter_data($_POST["p_status"]);


    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($p_f_name) || empty($p_f_name)) {
        $status['error']++;
        array_push($status["msg"], "FIRST NAME IS REQUIRED");
    }

    if (!isset($p_l_name) || empty($p_l_name)) {
        $status['error']++;
        array_push($status["msg"], "LAST NAME IS REQUIRED");
    }

    if (!isset($p_number) || empty($p_number)) {
        $status['error']++;
        array_push($status["msg"], "NUmber IS REQUIRED");
    }

    if (!isset($p_email) || empty($p_email)) {
        $status['error']++;
        array_push($status["msg"], "EMAIL IS REQUIRED");
    }



    $check = "SELECT * FROM `" . _Parent . "` WHERE `email`='{$p_email}' AND `p_id`<> '{$p_id}' ";
    $exe = $db->Mysql($check, true);

    if ($exe) {

        $status['error']++;
        array_push($status["msg"], "EMAIL ALREADY EXIST");
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

        return;
    } else {


        $data = [
            "f_name" => $p_f_name,
            "l_name" => $p_l_name,
            "email" => $p_email,
            "contact" => $p_number,
            "p_status" => $p_status
        ];
        echo $db->update(_Parent, $data, "`p_id`='{$p_id}'");
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




// $a = [1, 2, 3, 4,87 , 5, 6, 7];

// for ($select = 0; $select < count($a); $select++) {
//     $greater = true;

//     for ($check = 0; $check < count($a); $check++) {

//         if ($check != $select) {
//             if ($a[$select] < $a[$check]) {
//                 $greater = false;

//                 break;
//             }
//         }
//     }

//     if ($greater) {
//         echo $a[$select];
//     }

// }

?>