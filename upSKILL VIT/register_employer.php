<?php
    $title = "Register_employer";
?>
<?php require_once 'Includes/header.php'; ?>
<?php
    if (isset($_POST['register_emp'])){
        $username = $_POST['cname'];
        $cid = $_POST['cid'];
        $password = $_POST['password2'];
        $doh = $_POST['doh'];
        $email = $_POST['email2'];

        $e_pswd = sha1($cid.$password);

        $con = mysqli_connect("localhost", "root", "", "upskill_employer_db");
        if (!$con){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO company_credentials (c_name, cid, password, doh, c_email) VALUES ('$username', '$cid', '$e_pswd', '$doh', '$email')";
        $result = mysqli_query($con, $sql);

        $table = "CREATE TABLE $cid (
            job_id INT(6) AUTO_INCREMENT PRIMARY KEY,
            student_regno VARCHAR(9) NOT NULL,
            student_name VARCHAR(100) NOT NULL,
            student_cgpa FLOAT(4,2) NOT NULL,
            student_speciality VARCHAR(100) NOT NULL
        )";
        $result1 = mysqli_query($con, $table);

        if ($result && $result1){
            echo "<br><h1 class='text-center text-success'>Successfully registered!<br></h1>";
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($con);
    }
?>
<body id="reg-body">
    <br>
    <h1 class="text-center register-head">Registration Form</h1>
    <br>
    <form method="post" enctype="multipart/form-data" class="form1">
        <div class="form-group">
            <label for="firstname" class="register-text">*Company Name:</label>
            <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="cname" required>
        </div>
        <br/>
        <div class="form-group">
            <label for="firstname" class="register-text">*Company ID:</label>
            <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="cid" required>
            <small id="emailHelp" class="form-text text-danger register-text">It will be set as your username for future login.</small>
        </div>
        <br/>
        <div class="form-group">
            <label for="phone" class="register-text">*Set Password: </label>
            <input type="password" class="form-control" id="password" aria-describedby="phoneHelp" placeholder="Enter a strong password [a-zA-Z0-9$!@*]{8, *}" name="password2">
        </div>
        <br/> 
        <div class="form-group">
            <label for="lastname" class="register-text">Expected start date for hiring:</label>
            <input type="date" class="form-control" id="dob" placeholder="Enter Date of birth" name="doh">
        </div>
        <br/>
        <div class="form-group">
            <label for="email" class="register-text">*Company Official Email Address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email id" name="email2" required>
        </div>
        <br/>
        <div class="button">
            <button type="submit" class="btn btn-success" name="register_emp" style="margin: 2px">Submit</button>
            <button type="reset" class="btn btn-primary" name="reset" style="margin: 2px">Reset</button>
            <button class="btn btn-danger" name="back" style="margin: 2px"><a href="signup.php" class="back-a" >Back</a></button>
        </div>
    </form>
<?php 
    require_once 'Includes/footer.php'; 
?>
    
