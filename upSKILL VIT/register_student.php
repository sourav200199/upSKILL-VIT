<?php
    $title = "Register_student";
    require_once 'Database/config.php'; 
    require_once 'Database/students.php';

    $response = $crud->get_speciality();
?>
<?php require_once 'Includes/header.php'; ?>
<?php
    if (isset($_POST['submit'])){
       
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $speciality = $_POST['speciality'];
        $username = $_POST['regno'];
        $password = $_POST['password'];

        //Set the target directory for uploadind PDF files
        $target = 'resume_upload/';
        $original_file = $_FILES["resume"]["tmp_name"];
        $extension = pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);
        //basename() is a predefined function
        // The super variable $_FILES is defined by two var - first is:
        // form-control (here "resume", see name of input:file), and second is attribute
        $destination_file = "$target$username.$extension";
        //It is a PHP function to move the file to the destination
        move_uploaded_file($original_file, $destination_file);

        //$stud = new Student($pdo);
        $issuccess1 = $crud->insert($fname, $lname, $dob, $speciality, $email, $phone, $username, $destination_file);
        $issuccess2 = $stud->new_user($username, $password);
        if($issuccess1 && $issuccess2){
            echo "<br><h1 class='text-center text-success'>You have been registered!<br/>Congratulations!!!</h1>";
        }
        else{
            include 'Includes/error.php';
        }
    }
?>
<body id="reg-body">
    <br>
    <h1 class="text-center register-head">Registration Form</h1>
    <br>
    <form method="post" enctype="multipart/form-data" class="form1">
        <div class="register-text" style="margin: 10px">
            <label for="firstname" class="register-text">First Name:</label>
            <input type="text" class="input" id="firstname" placeholder="Enter First Name" name="fname">
        </div>
        <br/>
        <div class="register-text" style="margin: 10px">
            <label for="lastname" class="register-text">Last Name:</label>
            <input type="text" class="input" id="lastname" placeholder="Enter Last Name" name="lname">
        </div>
        <br>
        <div class="register-text" style="margin: 10px">
            <label for="phone" class="register-text">*Registration No.: </label>
            <input type="text" class="input" id="regno" aria-describedby="phoneHelp" placeholder="Enter your registration number" name="regno">
            <br><small id="emailHelp" class="form-text text-danger">(It will be set as your username for future login.)</small>
        </div>
        <br/>
        <div class="register-text" style="margin: 10px">
            <label for="phone" class="register-text">*Set Password: </label>
            <input type="password" class="input" id="password" aria-describedby="phoneHelp" placeholder="Enter a strong password [a-zA-Z0-9$!@*]{8, *}" name="password">
        </div>
        <br/> 
        <div class="register-text" style="margin: 10px">
            <label for="lastname" class="register-text">Date of birth:</label>
            <input type="date" class="input" id="dob" placeholder="Enter Date of birth" name="dob">
        </div>
        <br/>
        <div class="register-text" style="margin: 10px">
            <label for="speciality" class="register-text">Speciality:</label>
            <select class="input" id="speciality" name="speciality">
                <?php
                  while ($r = $response->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $r['speciality_id']?>"><?php echo $r['name']; ?></option>
                <?php  } ?>  
            </select>
        </div>
        <br/>
        <div class="register-text" style="margin: 10px">
            <label for="email" class="register-text">Email address</label>
            <input type="email" class="input" id="email" aria-describedby="emailHelp" placeholder="Enter your email id" name="email">
        </div>
        <br/>
        <div class="register-text" style="margin: 10px">
            <label for="phone" class="register-text">Phone No.:</label>
            <input type="text" class="input" id="phone" aria-describedby="phoneHelp" placeholder="Enter your phone number" name="phone">
        </div>
        <br/>
        <div class="register-text" style="margin: 10px">
            <label class="custom-file-label register-text" for="resume">*Upload Resume:</label>
            <br>
            <input type="file" accept=".pdf" class="custom-file-input" id="resume" name="resume" required>
            <br>
            <small id="phoneHelp" class="form-text text-danger">(Only PDF files are accepted.)</small>
        </div>
        <br/>
        <div class="button">
            <button type="submit" class="btn btn-success" name="submit" style="margin: 2px">Submit</button>
            <button type="reset" class="btn btn-primary" name="reset" style="margin: 2px">Reset</button>
            <button class="btn btn-danger" style="margin: 2px"><a href="signup.php" class="back-a">Back</a></button>
        </div>
    </form>
<?php 
    require_once 'Includes/footer.php'; 
?>
    
