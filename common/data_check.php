<?php
    function check_input($id, $name, $grade, &$error) {
        $error = "";
        // Check for blank space
        if ($id === "" or $name === "") {
            $error = "入力されてない値があるよ！";
            return false;
        }
        // Check if the id is entered correctly
        if (preg_match("/^[1-3][0-9]{3}$/", $id) != true) {
            $error = "idは1~3から始まる4桁の整数を入力してね！";
            return false;
        }
        return true;
    }
?>