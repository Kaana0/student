<?php
    require_once("common/html_functions.php");
    require_once("common/dbmanager.php");
    require_once("common/data_check.php");
    //  Error Retrieval Function
    function get_error() {
        $error = "";
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
        }
        return $error;       
    }
    $dbm = new DBManager();
?>