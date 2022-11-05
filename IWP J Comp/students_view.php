<?php
    $title = "Student View";
    require_once 'Includes/header.php';
    require_once 'Database/config.php';
    
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $response = $crud->get_student($id);
    }
    else
    {
        include 'Includes/error.php';
    }
?>
<body id="student-body">
<br>
<div class="card box" style="width: 18rem;">
    <div class="card-body">
        <h3 class="card-title student-head">Name: 
            <?php
                echo $response['firstname'].' '.$response['lastname'];
            ?>
        </h3>
        <p class="card-text student-text">
            <?php
                echo "Registration no. : ".$response['regno'];
            ?>
        </p>
        <p class="card-text student-text">
            <?php
                echo "Speciality : ".$response['name'];
            ?>
        </p>
        <p class="card-text student-text">
            <?php
                echo "Email ID: : ".$response['email'];
            ?>
        </p>
        <p class="card-text student-text">
            <?php
                echo "Phone Number: ".$response['phone'];
            ?>
        </p>
    </div> 
</div>
<br>
<button class="btn btn-danger"><a href="student_landing.php" class="back-a">Back</a></button>
