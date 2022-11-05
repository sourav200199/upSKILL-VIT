<?php
    $title = "Update Record";
    require_once 'Includes/header.php';
    require_once 'Includes/session.php';
    require_once 'Database/config.php'; 

    $response = $crud->get_speciality();
    // $id = "";
    // if(!isset($_GET['id']))
    //     echo 'Error';
    //     //include 'Includes/error.php';

    // else
    //     $id = $_GET['id'];
    
    $student = $crud->get_student($_SESSION['username']);
    if (isset($_POST['update']))
    {
        //Get values from new POST
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
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

        $result = $crud->update_student($username, $fname, $lname, $dob, $email, $phone, $speciality, $destination_file);
        if($result)
        {
            //Call the CRUD function
            //header("Location: record.php");
            echo "<div class='alert alert-danger'>Updated Successfully</div>";
        }
        else
        {
            echo "<div class='alert alert-danger'>ERROR: Cannot Update</div>";
            //include 'Includes/error1.php';
            //header("Location: record.php");
        }
    }
    // else{
    //     include 'Includes/error.php';
    //     //header("Location: record.php");
    // }
?>
<body id="edit-body">
    <br>
    <h1 class="text-center register-head">Update Record</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname" class="register-text">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="fname" value="<?php echo $student['firstname'];?>">
        </div>
        <br/>
        <div class="form-group">
            <label for="lastname" class="register-text">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lname" value="<?php echo $student['lastname'];?>"> 
        </div>
        <br/> 
        <div class="form-group">
            <label for="lastname" class="register-text" value="<?php echo $student['dob'];?>">Date of birth:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>
        <br/>
        <div class="form-group">
            <label for="speciality" class="register-text">Speciality:</label>
            <select class="form-control" id="speciality" name="speciality">
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
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?php echo $student['email'];?>">
        </div>
        <br/>
        <div class="form-group">
            <label for="phone" class="register-text">Phone No.:</label>
            <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" name="phone" value="<?php echo $student['phone'];?>">
        </div>
        <br/>
            <label class="custom-file-label register-text" for="resume">*Update Resume:</label>
            <br>
            <input type="file" accept=".pdf" class="custom-file-input" id="resume" name="resume" required>
            <br>
            <small id="phoneHelp" class="form-text text-danger register-text">Only PDF files are accepted.</small>
            <br>
        </form>
        <button type="submit" class="btn btn-success" name="update">Update Changes</button>
        <button type="reset" class="btn btn-primary" name="reset">Reset</button>
        <button class="btn btn-danger"><a href="student_landing.php" class="back-a">Back</a></button>
</body>
<?php 
    require_once 'Includes/footer.php'; 
?>
    
