<?php
    require_once 'Database/students.php';
    require_once 'Includes/session.php';
    require_once 'Database/config.php';

    class crud{
        private $db;

        function __construct($conn){
            try{
                $this->db = $conn;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function bind_regno($regno)
        {
            try{
                $sql = "SELECT student.regno FROM `student` INNER JOIN `login` ON student.regno = login.username";
                $stmt = $this->db->prepare($sql);

                $stmt->execute();
                return true;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function insert($fname, $lname, $dob, $speciality, $email, $phone, $regno, $filepath){
            try {
                $sql = "INSERT INTO student (firstname, lastname, dob, speciality_id, email, phone, regno, filepath) VALUES  (:fname,:lname,:dob,:speciality,:email,:phone,:regno,:filepath)";
                $stmt = $this->db->prepare($sql);

                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':phone',$phone);
                $stmt->bindparam(':speciality',$speciality);
                $stmt->bindparam(':regno',$regno);
                $stmt->bindparam(':filepath',$filepath);
                $this->bind_regno($regno);

                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function get_record(){
            try{
                $sql = "SELECT * FROM `student` st inner join speciality sp on st.speciality_id = sp.speciality_id";
                $rec = $this->db->query($sql);
                return $rec;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function get_speciality(){
            try{
                $sql = "SELECT * FROM `speciality`";
                $rec = $this->db->query($sql);
                return $rec;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function get_student($id){
            try{
                $sql = "SELECT * FROM `student` st inner join speciality sp on st.speciality_id = sp.speciality_id WHERE student_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->execute();
                $response = $stmt->fetch();

                return $response;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function update_student($id, $fname, $lname, $dob, $speciality, $email, $phone, $regno, $filepath)
        {
            try
            {
                if($_SESSION['username'] == $regno||$_SESSION['username'] == "admin")
                {
                    $sql = "UPDATE `student` SET `firstname`= :fname,`lastname`= :lname,`dob`= :dob,`speciality_id`= :speciality,`email`= :email,`phone`= :phone,`regno`= :regno,`filepath`= :filepath WHERE `student_id`= :id";
                    $stmt = $this->db->prepare($sql);

                    $stmt->bindparam(':id',$id);
                    $stmt->bindparam(':fname',$fname);
                    $stmt->bindparam(':lname',$lname);
                    $stmt->bindparam(':dob',$dob);
                    $stmt->bindparam(':email',$email);
                    $stmt->bindparam(':phone',$phone);
                    $stmt->bindparam(':speciality',$speciality);
                    $stmt->bindparam(':regno',$regno);
                    $stmt->bindparam(':filepath',$filepath);

                    $stmt->execute();
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function remove($id, $usrnm)
        {
            try
            {
                if($_SESSION['username'] == $usrnm ||$_SESSION['username'] == "admin")
                 {
                    $res = $sql = "DELETE from `student` WHERE regno = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(':id',$id);
                    $stmt->execute();
                    return true;
                }
                else
                {
                    echo "<div class='alert alert-danger'>Credential(s) incorrect</div>";
                    return false;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    }
?>