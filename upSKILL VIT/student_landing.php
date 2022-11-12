<?php
$title = "Student_Landing";
require_once 'Database/config.php';
require_once 'Includes/authentication_check.php';
require_once 'Database/crud.php';
require_once 'Includes/session.php';
$response = $crud->get_student($_SESSION['username']);
?>
<?php require_once 'Includes/header.php'; ?>
<head>
    <script type="text/javascript">
        function preventBack()
        {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function(){null;};
    </script>
</head>
<body id="student-landing-body">
    <div class="container-landing">
        <br>
        <?php
            if (isset($_POST['btn-delete'])) {
            $id = $_SESSION['username'];
            $usrnm = $_SESSION['username'];
            //Call the delete function for 'id'
            $result = $crud->remove($id, $usrnm);

            //Redirect
            if (!$result) {
                echo "<div class='alert alert-danger'>Error in deleting account.</div>";
            } else {
                echo "<div class='alert alert-danger'>Deleted Successfully</div>";
            }
            } 
        ?>
        <div class="heading">
            <h1 id="welcome"><?php echo "Welcome ".$_SESSION['username'];?></h1>
        </div><br><br>
        <div class="box-row">
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/updates.gif">
                </div>
                <div class="card-body">
                    <p>
                        Employers ask for your most recent resume and other details. 
                        Make sure you update it time to time so that your most recent profile is displayed.
                    </p><br>
                    <a href="edit_record.php?" class="btn-landing">Edit Profile</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/delet.gif" style="width:150px; height: 140px;">
                </div>
                <div class="card-body">
                    <p>
                        To remove your name from the list of students who has registered for internship, click on the button below.
                        <br><br><br>
                    </p>
                    <!-- <a href="#" class="btn">Delete</a> -->
                    <form method="POST"><button type="submit" class="btn-landing" id="btn-delete" name="btn-delete">Delete Record</button></form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/settings.gif">
                </div>
                <div class="card-body">
                    <p>
                        Remember not to share your password with anyone else! You can change your password by clicking on the button below.
                        <br><br>
                    </p>
                    <a href="updatepassword.php" class="btn-landing">Update Password</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/interview.gif">
                </div>
                <div class="card-body">
                    <p>
                        Check whether you have been selected for an internship call or not by clicking on the button below.
                        (You need to enter the company ID provided by the university.)
                        <br>
                    </p>
                    <a href="check_selection.php" class="btn-landing">Check Selection</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/view.webp">
                </div>
                <div class="card-body">
                    <p>
                        You can view the list of students from the university who has applied for internships by clicking the button below.
                        <br><br><br>
                    </p>
                    <a href="record.php" class="btn-landing">View Students' List</a>
                </div>
            </div>
        </div>
    </div>
</body>
    <?php
        include_once 'Includes/footer.php';
    ?>
</html>