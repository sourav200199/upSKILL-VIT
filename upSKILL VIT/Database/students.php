<?php

    class Student
    {
        //Creating a private database object
        private $db;
        //Constructor to initialize a private variable to the db connection
        function __construct($conn){
            try{
                $this->db = $conn;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function new_user($usrnm, $pswd) //taking the username and password as parameters
        {
            try 
            {
                //Check if there exists any user with similar username
                $count = $this->get_username($usrnm);
                if($count['num'] > 0)  
                    return false;

                else
                {
                    //$usrnm.$pswd = SALTing the password by the addition of username in it
                    //sha1() is the encryption algorithm
                    $e_pswd = sha1($usrnm.$pswd); 

                    //If everything is OK, insert new user
                    $sql = "INSERT INTO login (username,password) VALUES (:usrnm,:pswd)";
                    
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(':usrnm',$usrnm);
                    $stmt->bindparam(':pswd',$e_pswd);

                    $stmt->execute();
                    return true;
                }
            } 
            catch (PDOException $e) 
            {
                echo $e->getMessage();
                return false;
            }
        }
        public function get_user($usrnm, $pswd) //taking the username and password as parameters
        {
            try
            {
                $sql = "SELECT * FROM `login` WHERE username = :usrnm AND password = :pswd";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':usrnm',$usrnm);
                $stmt->bindparam(':pswd',$pswd);

                $stmt->execute();
                $response = $stmt->fetch();

                return $response;
            }
            catch (PDOException $e) 
            {
                echo $e->getMessage();
                return false;
            }
        }
        public function get_username($usrnm) //function to check if there is any user with similar username
        {
            try
            {
                $sql = 'SELECT count(*) as num FROM `login` WHERE username = :usrnm';
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':usrnm',$usrnm);

                $stmt->execute();
                $response = $stmt->fetch();

                return $response;
            }
            catch (PDOException $e) 
            {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>