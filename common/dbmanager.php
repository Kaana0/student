<?php
    class DBManager {
        //  DB Access Information
        private $access_info;
        //  DB Access User
        private $user;
        //  DB Access Password
        private $password;
        //  DB
        private $db = null;
        //  Constructor
        function __construct() {
            $this->access_info = "mysql:host=localhost;dbname=school";
            $this->user = "root";
            $this->password = "root";
        }
        //  Connect to database
        private function connect() {
            $this->db = new PDO($this->access_info, $this->user, $this->password);
        }
        //  Disconnect from database
        private function disconnect() {
            $this->db = null;
        }
        //  Get Student List
        function get_allstudents() {
            try {
                $this->connect();
                $stmt = $this->db->prepare("SELECT * FROM student ORDER BY id;");
                $res = $stmt->execute();
                if ($res) {
                    $member = $stmt->fetchAll();
                    $this->disconnect();
                    return $member;
                }
            } catch(PDOException $e) {
                $this->disconnect();
                return null;
            }
            $this->disconnect();
            return null;
        }
        //  Obtain Specific Student Information
        function get_student($id) {
            try {
                $this->connect();
                $stmt = $this->db->prepare("SELECT * FROM student WHERE id = ? ;");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $res = $stmt->execute();
                if ($res) {
                    $member = $stmt->fetchAll();
                    $this->disconnect();
                    if (count($member) == 0) {
                        return null;
                    }             
                    return $member[0];
                }
            } catch(PDOException $e) {
                $this->disconnect();
                return null;
            }
            $this->disconnect();
            return null;
        }
        //  Check if the Student Information Specified by id Exists
        function if_id_exists($id) {
            if ($this->get_student($id) != null) {
                return true;
            }
            return false;
        }
        //  Insert Student Information
        function insert_student($id, $name, $grade) {
            try {
                $this->connect();
                $stmt = $this->db->prepare("INSERT INTO student VALUES(?, ?, ?);");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $grade, PDO::PARAM_INT);
                $res = $stmt->execute();
                $this->disconnect();
                return true;
            } catch(PDOException $e) {
                $this->disconnect();
                return false;
            }
            $this->disconnect();
            return false;
        }
        //  Delete Student Information
        function delete_student($id) {
            try {
                $this->connect();
                $stmt = $this->db->prepare("DELETE FROM student WHERE id = ?;");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $res = $stmt->execute();
                $this->disconnect();
                return true;
            } catch(PDOException $e) {
                $this->disconnect();
                return false;
            }
            $this->disconnect();
            return false;         
        }
        //  Update Student Information
        function update_student($id, $name, $grade, $old_id) {
            try {
                $this->connect();
                $stmt = $this->db->prepare("UPDATE student SET id = ?, name = ?, grade = ? WHERE id = ?;");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $grade, PDO::PARAM_INT);
                $stmt->bindParam(4, $old_id, PDO::PARAM_INT);
                $res = $stmt->execute();
                return true;
            } catch(PDOException $e) {
                $this->disconnect();
                return false;
            }
            $this->disconnect();
            return false;
        }
    }
?>