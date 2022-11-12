<?php
    $title = "Check_Selection";
    include_once 'Includes/header.php';
    include_once 'Includes/session.php';
    include_once 'Includes/authentication_check.php';
?>

<body id="selection-body">
    <br>
    <br>
    <a href="student_landing.php" class="btn btn-danger" style="margin: 10px">Back</a>
    <form action="" method="post" id="form3">
        <p class="register-text" style="margin: 10px">*Enter Company ID (provided by the university):</p>
        <input type="text" name="company" id="company" class="input" style="margin: 10px" required><br>
        <input type="submit" name="check_selection" value="Check"  style="margin-left: 10px" style="margin: 10px">
    </form>
    <br>
    <br>
    <?php
        if(isset($_POST['check_selection']))
        {
            $con = mysqli_connect("localhost", "root", "", "upskill_employer_db");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $company = $_POST['company'];
            $regno = $_SESSION['username'];
            $sql = "SELECT count(*) FROM $company WHERE student_regno = '$regno'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) 
            {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    if ($row['count(*)'] == 0) 
                    {
                        echo "<h3 class='text-center text-danger'>You are not selected!</h3>";
                    } 
                    else 
                        echo "<h3 class='text-center text-success'>You have been shortlisted for the next round!</h3>";
                }
            } else 
                echo "<br><h1 class='text-center text-danger'>Error: " . $sql . "<br>" . mysqli_error($con) . "</h1>";
        }
    ?>

<?php require_once 'Includes/footer.php'; ?>