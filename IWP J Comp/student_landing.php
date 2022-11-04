<?php
$title = "Landing";
require_once 'Database/config.php';
require_once 'Includes/authentication_check.php';
require_once 'Database/crud.php';
require_once 'Includes/session.php';
$response = $crud->get_record();
?>
<?php require_once 'Includes/header.php'; ?>
<body>
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
                // header("Location: record.php");
                // include 'Includes/error1.php';
                //header("Location: record.php");
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
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi neque molestiae eius explicabo mollitia tempore reiciendis, vel, sequi.
                    </p>
                    <a href="#" class="btn-landing">Edit</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/delet.gif" style="width:150px; height: 140px;">
                </div>
                <div class="card-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi neque molestiae eius explicabo mollitia tempore reiciendis, vel, sequi.
                    </p>
                    <!-- <a href="#" class="btn">Delete</a> -->
                    <form method="POST"><button type="submit" class="btn-landing" id="btn-delete" name="btn-delete">Delete</button></form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/settings.gif">
                </div>
                <div class="card-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi neque molestiae eius explicabo mollitia tempore reiciendis, vel, sequi.
                    </p>
                    <a href="#" class="btn-landing">Update</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <img class="gif" src="Images/view.webp">
                </div>
                <div class="card-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi neque molestiae eius explicabo mollitia tempore reiciendis, vel, sequi.
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