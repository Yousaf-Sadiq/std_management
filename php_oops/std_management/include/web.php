<?php
const SERVER = "http://localhost/";

define("SERVER2",$_SERVER["DOCUMENT_ROOT"]);
const FOLDER = "php_oops/std_management/";
// const FOLDER = "std_management/";

const abs_url = SERVER . FOLDER;
const rel_url = SERVER2 ."/". FOLDER;
// frontend url
require_once "frontendUrl.php";
// admin url
require_once "adminUrl.php";

?>