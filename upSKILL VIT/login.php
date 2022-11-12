<?php
ob_start();
$title = "Login";
require_once 'Database/students.php';
require_once 'Database/config.php';
require_once 'Includes/header.php';
//Another method of submit
//The first method is done using isset, see the 'success.php'
//This method is more generic as it does not depend on any value but checks if there is any POST method
if (isset($_POST['login_student'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $new_p = sha1($username . $password);

    //Check with the hashed password in the database
    $res = $stud->get_user($username, $new_p); //invoking 'stud' from the config.php
    if (!$res) {
        echo "<div class='alert alert-danger'>Credential(s) incorrect</div>";
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['uid'] = $res['login_id']; //'login_id' of the login table, as result is an object of Student class- see 'config.php' and 'student.php'
        header("Location: student_landing.php");
    }
}

if (isset($_POST['login_employer'])) {
    $usrnm = $_POST['cid'];
    $pswrd = $_POST['password1'];
    $new_p1 = sha1($usrnm.$pswrd);

    //Check with the hashed password in the database
    $con = mysqli_connect("localhost", "root", "", "upskill_employer_db");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM company_credentials WHERE cid = '$usrnm' AND password = '$new_p1'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $usrnm;
        $_SESSION['uid'] = $row['login_id'];
        header("Location: employer_landing.php");
    } else {
        echo "<div class='alert alert-danger'>Credential(s) incorrect</div>";
    }

    mysqli_close($con);
}
?>

<body id="body-login">
    <section>
        <div class="container-login">
            <div class="login-box">
                <div class="form">
                    <h2 class="header-login">Student Login</h2>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="box">
                        <table class="table table-sm">
                            <tr>
                                <td><label for="username" class="register-text">*Username: </label></td>
                                <td><input type="text" name="username" class="form-control" id="username"></td>
                            </tr>
                            <tr>
                                <td><label for="password" class="register-text">*Password: </label></td>
                                <td><input type="password" name="password" class="form-control" id="password"></td>
                            </tr>
                        </table>
                        <table>
                            <input type="submit" value="login" name="login_student"><br>
                        </table>
                    </form>
                </div>
            </div>


            <div class="login-box">
                <div class="form">
                    <h2 class="header-login">Employer Login</h2>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="box">
                        <table class="table table-sm">
                            <tr>
                                <td><label for="username" class="register-text">*Username: </label></td>
                                <td><input type="text" name="cid" class="form-control" id="cid"></td>
                            </tr>
                            <tr>
                                <td><label for="password" class="register-text">*Password: </label></td>
                                <td><input type="password" name="password1" class="form-control" id="password"></td>
                            </tr>
                        </table>
                        <table>
                            <input type="submit" value="login" name="login_employer"><br>
                        </table>
                    </form>
                </div>
            </div>

        </div>
        <?php
            include_once 'Includes/footer.php';
        ?>
    </section>
</body>

</html>