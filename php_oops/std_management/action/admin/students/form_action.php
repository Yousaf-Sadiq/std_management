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

    $s_f_name = $help->filter_data($_POST["s_f_name"]);
    $s_l_name = $help->filter_data($_POST["s_l_name"]);
    $s_email = $help->filter_data($_POST["s_email"]);
    $std_number = $help->filter_data($_POST["std_number"]);

    $DOB = $help->filter_data($_POST["DOB"]);
    $s_parent = $help->filter_data($_POST["s_parent"]);
    $s_address = $help->filter_data($_POST["s_address"]);
    $std_status = $help->filter_data($_POST["std_status"]);

    $std_id = $help->filter_data($_POST["std_id"]);

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


    $check = "SELECT * FROM `" . _std . "` WHERE `email`='{$s_email}'  AND `std_id`<> '{$std_id}'";
    $exe = $db->Mysql($check, true);

    if ($exe) {

        $status['error']++;
        array_push($status["msg"], "EMAIL ALREADY EXIST");
    }




    if (!isset($file["name"]) || empty($file["name"])) {

        $Fetch_image = $db->select(true, _std, "*", "`std_id`='{$std_id}'");

        if ($Fetch_image) {
            $IMage = $db->GetResult();

            if (isset($IMage[0]["profile"])) {
                // $oldIMage = json_decode($IMage[0]["profile"], true);
                $File = $IMage[0]["profile"];
            } else {
                $File = NULL;
            }

        }



        // $File 
//  if user upload image 
    } else {

        $Fetch_image = $db->select(true, _std, "*", "`std_id`='{$std_id}'");

        if ($Fetch_image) {
            $IMage = $db->GetResult();

            if (isset($IMage[0]["profile"]) && !empty($IMage[0]["profile"])) {
                $oldIMage = json_decode($IMage[0]["profile"], true);
                $relPath = $oldIMage["relUrl"];
                if (file_exists($relPath)) {
                    unlink($relPath);
                }
            }

        }





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
            "profile" => $File,
            "std_status" => $std_status
        ];

        echo $db->update(_std, $data, "`std_id`='{$std_id}'");

        //    echo $std_id = $db->GetId();

        $data2 = [
            "student_id" => $std_id,
            "parent_id" => $s_parent
        ];

        $db->update(_std_parent, $data2, "`student_id`='{$std_id}'");
    }
}




if (isset($_POST["deletes"]) && !empty($_POST["deletes"])) {

    $std_id = $_POST["std_id"];


    $status = [
        "error" => 0,
        "msg" => []
    ];

    if (!isset($std_id) || empty($std_id)) {
        $status['error']++;
        array_push($status["msg"], "STUDENT ID IS REQUIRED");
    }



    $check = "SELECT * FROM `" . _std . "` WHERE `std_id`='{$std_id}'";
    $exe = $db->Mysql($check, true);

    if (!$exe) {

        $status['error']++;
        array_push($status["msg"], "Invalid ID");
    }



    if ($status["error"] > 0) {
        echo json_encode($status);

        return;
    } else {

        $fetchImage = $db->select(true, _std, "*", "`std_id`='{$std_id}'");
        if ($fetchImage) {
            $f_image = $db->GetResult();


            if (isset($f_image[0]["profile"]) && !empty($f_image[0]["profile"])) {
                $oldImage = json_decode($f_image[0]["profile"], true);

                if (file_exists($oldImage["relUrl"])) {
                    unlink($oldImage["relUrl"]);
                }
            }
        }


        $db->delete(_std_parent, "`student_id`='{$std_id}'");

        echo $db->delete(_std, "`std_id`='{$std_id}'");

    }
}





?>