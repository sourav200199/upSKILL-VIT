<?php
    $title="Shortlist";

    require_once "Includes/header.php";
    require_once "Includes/authentication_check.php";
    require_once "Database/config.php";
    require_once "Database/crud.php";
    require_once "Includes/session.php";

?>
<body id="shortlist-body">
    <br>
    <br>
    <?php
    if (isset($_POST['removefromlist'])) {
        $con = mysqli_connect("localhost", "root", "", "upskill_employer_db");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $tablename = strtolower($_SESSION['username']);
        $sid = $_POST['st_regno'];

        $sql = "DELETE FROM $tablename WHERE student_regno LIKE '%$sid%'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "<div class='alert alert-success'>Student removed from the list.</div>";
        } else {
            echo "<div class='alert alert-danger'>ERROR: Could not remove student</div>";
        }

        mysqli_close($con);
    }
?>
    <br>
    <br>
<?php
    $id = $_SESSION['username'];
    $con = mysqli_connect("localhost", "root", "", "upskill_employer_db");

    if(!$con){
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM $id";
    $result = mysqli_query($con, $sql);

    echo "<div id='wrap-table'><table class='table'><thead class='thead-dark'>";
    echo "<tr>";
    echo "<th scope='col' class='table-head'>Student Reg. No.</th>";
    echo "<th scope='col' class='table-head'>Name</th>";
    echo "<th scope='col' class='table-head'>CGPA</th>";
    echo "<th scope='col' class='table-head'>Speciality</th>";
    echo "<th scope='col' class='table-head'>Action</th>";
    echo "</tr></thead><tbody>";

    while($row1 = mysqli_fetch_assoc($result)){

        $id = $row1['student_regno'];
        
        echo "<tr>";
        echo "<td class='register-text'>" . $row1['student_regno'] . "</td>";
        echo "<td class='register-text'>" . $row1['student_name'] ."</td>";
        echo "<td class='register-text'>" . $row1['student_cgpa'] . "</td>";
        echo "<td class='register-text'>" . $row1['student_speciality'] . "</td>";
        echo "<td><form method='post'>
            <input type='hidden' name='st_regno' value='$id'>"
        ?>
            <input type='submit' name='removefromlist' value='Remove' class='btn btn-danger'>
        <?php
            echo "</form></td>";
            echo "</tr>";
    }

    echo "</tbody></table></div>";

    mysqli_close($con);
?>
<a href="employer_landing.php" style="margin-left: 10px"><button class="btn btn-danger">Back</button></a>
<?php require_once "Includes/footer.php";?>