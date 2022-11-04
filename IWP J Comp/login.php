<?php
$title = "Login";
// require_once 'Includes/header.php';
require_once 'Database/students.php';
require_once 'Database/config.php';

//Another method of submit
//The first method is done using isset, see the 'success.php'
//This method is more generic as it does not depend on any value but checks if there is any POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
?>
<!-- 
<!DOCTYPE html>
<html lang="en"> -->
<!-- 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="Includes/style_index.css">
    <link rel="stylesheet" href="CSS/about.css" />
    <link rel="stylesheet" href="CSS/services.css" />
    <title>Login</title>
</head> -->

<body>
    <section>
        <?php require_once 'Includes/header.php'; ?>

        <div class="container-login">
            <div class="login-box">
                <div class="form">
                    <h2 class="header-login">Student Login</h2>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="box">
                        <table class="table table-sm">
                            <tr>
                                <td><label for="username" class="register-text">*Username: </label></td>
                                <td><input type="text" name="username" class="form-control" id="username" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="password" class="register-text">*Password: </label></td>
                                <td><input type="password" name="password" class="form-control" id="password"></td>
                            </tr>
                        </table>
                        <table>
                            <input type="submit" value="login"><br>
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
                                <td><input type="text" name="username1" class="form-control" id="username" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username']; ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="password" class="register-text">*Password: </label></td>
                                <td><input type="password" name="password1" class="form-control" id="password"></td>
                            </tr>
                        </table>
                        <table>
                            <input type="submit" value="login"><br>
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
<!-- <h1 class="text-center register-head"><?php echo $title; ?></h1>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="box">
    <table class="table table-sm">
        <tr>
            <td><label for="username" class="register-text">*Username: </label></td>
            <td><input type="text" name="username" class="form-control" id="username" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username']; ?>"></td>
        </tr>
        <tr>
            <td><label for="password" class="register-text">*Password: </label></td>
            <td><input type="password" name="password" class="form-control" id="password"></td>
        </tr>
    </table>
    <table>
        <input type="submit" value="login" class="btn btn-primary btn-block"><br>
    </table>
</form>
<br>
<br> -->
