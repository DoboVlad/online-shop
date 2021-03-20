<?php
    include_once "dbcontroller.php";
    class User{
        public $db;
        public function __construct(){
            $this->db = Database::getConnection();
        }

        public function registerUser($firstName, $lastName, $email, $password, $phoneNumber, $admin){
            $pass = md5($password);
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 0){
                $stmt->close();
                $sql=$this->db->prepare("INSERT INTO users (firstName, lastName, email, password, phoneNumber, isAdmin) VALUES (?,?,?,?,?,?);");
                $sql->bind_param("sssssi", $firstName, $lastName, $email, $pass, $phoneNumber, $admin);
                $sql->execute();
                $sql->close();
				return true;
            }
            else { return false; }
        }

        public function loginUser($email, $password){
            $pass = md5($password);
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email=? AND password=?");
            $stmt->bind_param("ss", $email, $pass);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->store_result();
            if($stmt->num_rows==1){
                if($stmt->fetch()){
                    $_SESSION['login'] = true;
					$_SESSION['id'] = $id;
					$stmt->close();
					return $_SESSION['login'];
				}
				else {
					$stmt->close();
					return false;
				}
            }
        }

        public function isAdmin($id){
            $sql = "SELECT isAdmin FROM users WHERE id=?";
            $stmt= $this->db->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($result);
            while ($stmt->fetch()) {
                return $result;
            }
            
        }

        public function getSession(){
            if(isset($_SESSION['login'])){
                return true;
            }
            return false;
        }

        public function logout(){
            $_SESSION['login'] = false;
            session_destroy();
        }
    }
?> 