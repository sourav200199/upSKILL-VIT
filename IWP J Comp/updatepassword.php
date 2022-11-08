<?php
$title = "Update Password";
include 'Includes/header.php';
include 'Includes/authentication_check.php';
?>

<?php
    if (isset($_POST['update_password'])) {

        $pswd0 = $_POST['pswd0'];
        $pswd1 = $_POST['pswd1'];
        $pswd2 = $_POST['pswd2'];
        $id = $_SESSION['username'];

        $new_p = sha1($id.$pswd0);

        $conn = mysqli_connect("localhost", "root", "", "upskill_student_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql0 = "SELECT count(*) FROM login WHERE password LIKE '$new_p'";
        $result0 = mysqli_query($conn, $sql0);

        if (mysqli_num_rows($result0) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result0)) 
            {
                if ($row['count(*)'] == 1) 
                {
                    if ($pswd1 == $pswd2) {
                        $new_p = sha1($id.$pswd1);
                        $sql1 = "UPDATE login SET password = '$new_p' WHERE username = '$id'";
                        $result1 = mysqli_query($conn, $sql1);
                        if ($result1) {
                            echo "<div class='alert alert-success'>Password updated successfully.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>ERROR: Could not update password</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>ERROR: Passwords do not match</div>";
                    }
                } 
                else 
                    echo "<div class='alert alert-danger'>ERROR: Incorrect password</div>";
            }
        } else 
            echo "<div class='alert alert-danger'>ERROR: " . $sql0 . "<br>" . mysqli_error($conn) . "</div>";

        mysqli_close($conn);
    }
?>

<body id="password-body">
    <br>
    <br>
    <a href="student_landing.php" class="btn btn-danger" style="margin: 10px">Back</a>
    <div class="container-login">
        <div class="login-box">
            <div class="form">
                <h2 class="header-login">Update Password</h2>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="box">
                    <table class="table table-sm">
                        <tr>
                            <td><label for="username" class="register-text">*Enter password: </label></td>
                            <td><input type="text" name="pswd0" class="form-control" id="username"></td>
                        </tr>
                        <tr>
                            <td><label for="password" class="register-text">*Enter new Password: </label></td>
                            <td><input type="password" name="pswd1" class="form-control" id="password"></td>
                        </tr>
                        <tr>
                            <td><label for="password" class="register-text">*Confirm new Password: </label></td>
                            <td><input type="password" name="pswd2" class="form-control" id="password"></td>
                        </tr>
                    </table>
                    <table>
                        <input type="submit" value="update" name="update_password"><br>
                    </table>
                </form>
            </div>
        </div>
</body>