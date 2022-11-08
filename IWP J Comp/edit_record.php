<?php
    $title = "Update Record";
    require_once 'Includes/header.php';
    require_once 'Includes/session.php';
    require_once 'Database/config.php'; 

    $response = $crud->get_speciality();
    
    $student = $crud->get_student($_SESSION['username']);
    if($student == false)
    {
        $student['firstname'] = "";
        $student['lastname'] = "";
        $student['dob'] = "";
        $student['email'] = "";
        $student['phone'] = "";
        $student['cgpa'] = 0.0;
        $student['speciality_id'] = 1;

    }
    if (isset($_POST['update']))
    {
        //Get values from new POST
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $cgpa = (float)$_POST['cgpa'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $speciality = $_POST['speciality'];
        $username = $_SESSION['username'];
        //Set the target directory for uploadind PDF files
        $target = 'resume_upload/';
        $original_file = $_FILES["resume"]["tmp_name"];
        $extension = pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);
        //basename() is a predefined function
        // The super variable $_FILES is defined by two var - first is:
        // form-control (here "resume", see name of input:file), and second is attribute
        $destination_file = "$target$username.$extension";
        //It is a PHP function to move the file to the destination
        unlink($destination_file);
        move_uploaded_file($original_file, $destination_file);

        $result = $crud->update_student($username, $fname, $lname, $dob, $cgpa, $email, $phone, $speciality, $destination_file);
        if($result)
        {
            echo "<div class='alert alert-danger'>Updated Successfully</div>";
        }
        else
        {
            echo "<div class='alert alert-danger'>ERROR: Cannot Update</div>";
        }
    }
?>
<body id="edit-body">
    <br>
    <h1 class="text-center register-head">Update Record</h1>
    <br>
    <form id="editform" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname" class="register-text">First Name:</label>
            <input type="text" class="input" id="firstname" name="fname" value="<?php echo $student['firstname'];?>">
        </div>
        <br/>
        <div class="form-group">
            <label for="lastname" class="register-text">Last Name:</label>
            <input type="text" class="input" id="lastname" name="lname" value="<?php echo $student['lastname'];?>"> 
        </div>
        <br/> 
        <div class="form-group">
            <label for="lastname" class="register-text" value="<?php echo $student['dob'];?>">Date of birth:</label>
            <input type="date" class="input" id="dob" name="dob">
        </div>
        <br/>
        <div class="form-group">
            <label for="lastname" class="register-text" value="<?php echo $student['dob'];?>">CGPA:</label>
            <input type="text" class="input" id="cgpa" name="cgpa">
        </div>
        <br/>
        <div class="form-group">
            <label for="speciality" class="register-text">Speciality:</label>
            <select id="speciality" class="input" name="speciality">
                <?php
                  while ($r = $response->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $r['speciality_id']?>">
                    <?php echo $r['name']; ?>
                </option>
                <?php  } ?>  
            </select>
        </div>
        <br/>
        <div class="form-group">
            <label for="email" class="register-text">Email address</label>
            <input type="email" class="input" id="email" aria-describedby="emailHelp" name="email" value="<?php echo $student['email'];?>">
        </div>
        <br/>
        <div class="form-group">
            <label for="phone" class="register-text">Phone No.:</label>
            <input type="text" class="input" id="phone" aria-describedby="phoneHelp" name="phone" value="<?php echo $student['phone'];?>">
        </div>
        <br/>
            <label class="custom-file-label register-text" for="resume">*Update Resume:</label>
            <br>
            <input type="file" accept=".pdf" class="custom-file-input" id="resume" name="resume" required>
            <br>
            <small id="phoneHelp" class="form-text text-danger register-text">Only PDF files are accepted.</small>
            <br>
            <div class="button-holder">
                <button type="submit" class="btn btn-success" name="update" style="margin: 3px">Update Changes</button>
                <button type="reset" class="btn btn-primary" name="reset" style="margin: 3px">Reset</button>
                <button class="btn btn-danger" style="margin: 3px"><a href="student_landing.php" class="back-a">Back</a></button>
            </div>
        </form>
<?php 
    require_once 'Includes/footer.php'; 
?>
    
