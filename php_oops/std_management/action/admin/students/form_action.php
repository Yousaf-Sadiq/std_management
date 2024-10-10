<?php
declare(strict_types=1);
require_once dirname(__DIR__) . "/../../app/database.php";

use App\database\helper as help;
use App\database\DB as DB;

$help = new help;
$db = new DB;

if (isset($_POST["inserts"]) && !empty($_POST["inserts"])) {

    $s_f_name = $help->filter_data($_POST["s_f_name"]);
    $s_l_name = $help->filter_data($_POST["s_l_name"]);
    $s_email = $help->filter_data($_POST["s_email"]);
    $std_number = $help->filter_data($_POST["std_number"]);

    $DOB = $help->filter_data($_POST["DOB"]);
    $s_parent = $help->filter_data($_POST["s_parent"]);
    $s_address = $help->filter_data($_POST["s_address"]);

    $input = "profile";

    $file = $_FILES[$input];

    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($s_f_name) || empty($s_f_name)) {
        $status['error']++;
        array_push($status["msg"], "FIRST NAME IS REQUIRED");
    }

    if (!isset($s_l_name) || empty($s_l_name)) {
        $status['error']++;
        array_push($status["msg"], "LAST NAME IS REQUIRED");
    }

    if (!isset($s_email) || empty($s_email)) {
        $status['error']++;
        array_push($status["msg"], "EMAIL IS REQUIRED");
    } else {
        if (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
            $status['error']++;
            array_push($status["msg"], "EMAIL FORMAT INVALID");
        }
    }

    if (!isset($std_number) || empty($std_number)) {
        $status['error']++;
        array_push($status["msg"], "NUmber IS REQUIRED");
    }

    if (!isset($DOB) || empty($DOB)) {
        $status['error']++;
        array_push($status["msg"], "DOB IS REQUIRED");
    }



    if (!isset($s_parent) || empty($s_parent)) {
        $status['error']++;
        array_push($status["msg"], "Student Parent Name  IS REQUIRED");
    }


    if (!isset($s_address) || empty($s_address)) {
        $status['error']++;
        array_push($status["msg"], "ADDRESS IS REQUIRED");
    }


    $check = "SELECT * FROM `" . _std . "` WHERE `email`='{$s_email}' ";
    $exe = $db->Mysql($check, true);

    if ($exe) {

        $status['error']++;
        array_push($status["msg"], "EMAIL ALREADY EXIST");
    }

    if (!isset($file["name"]) || empty($file["name"])) {
        $status['error']++;
        array_push($status["msg"], "PROFILE IS REQUIRED");
    } else {

        $ext = ["jpg", "png", "jpeg"];
        $File = $help->FileUPload($input, $ext, "/assets/admin/upload/");
        if ($File == 5) {
            $status['error']++;

            $s = implode(" ", $ext);
            $s = strtoupper($s);

            array_push($status["msg"], "{$s}  ONLY ALLOWED");
            $File = NULL;
        } else if ($File == 9) {
            $status['error']++;
            array_push($status["msg"], "UPLOADING ERROR");
            $File = NULL;
        } else {

            $File = json_encode($File);
        }


    }



    if ($status["error"] > 0) {
        echo json_encode($status);

        return;
    } else {

        $pswd = password_hash("123456", PASSWORD_BCRYPT);
        $encrypt = base64_encode("123456");

        $data = [
            "f_name" => $s_f_name,
            "l_name" => $s_l_name,
            "email" => $s_email,
            "password" => $pswd,
            "ptoken" => $encrypt,
            "contact" => $std_number,
            "DOB" => $DOB,
            "address" => $s_address,
            "profile" => $File
        ];

        $db->insert(_std, $data);

        $std_id = $db->GetId();

        $data2 = [
            "student_id" => $std_id,
            "parent_id" => $s_parent
        ];

        echo $db->insert(_std_parent, $data2);
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





?>