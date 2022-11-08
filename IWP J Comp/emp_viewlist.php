<?php
$title = "Employer_Student_list";

require_once 'Includes/session.php';
require_once 'Includes/authentication_check.php';
require_once "Includes/header.php";
require_once 'Database/config.php';
$response = $crud->get_speciality();

?>
    <br>
    <br>
    <a href="employer_landing.php" style="margin-left: 10px"><button class="btn btn-primary">Back to Home</button></a>

<?php
    if (isset($_POST['addtolist'])) {
        $con1 = mysqli_connect("localhost", "root", "", "upskill_student_db");
        $con2 = mysqli_connect("localhost", "root", "", "upskill_employer_db");

        if (!$con1 || !$con2) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $tablename = strtolower($_SESSION['username']);
        $sid = $_POST['st_regno'];

        $sql0 = "SELECT count(*) FROM $tablename WHERE student_regno = '$sid'";
        $result0 = mysqli_query($con2, $sql0);

        if (mysqli_num_rows($result0) > 0) 
        {
            while ($row = mysqli_fetch_assoc($result0)) 
            {
                if ($row['count(*)'] == 0) 
                {
                    $sql1 = "SELECT * FROM student st INNER JOIN speciality sp on st.speciality_id = st.speciality_id WHERE regno LIKE '%$sid%'";
                    $result1 = mysqli_query($con1, $sql1);
                    $row2 = mysqli_fetch_assoc($result1);

                    $nm = $row2['firstname'] . "_" . $row2['lastname'];
                    $sp = $row2['name'];
                    $cgpa = $row2['cgpa'];

                    $sql2 = "INSERT INTO $tablename (student_regno, student_name, student_cgpa, student_speciality) VALUES('$sid','$nm','$cgpa','$sp')";
                    $result2 = mysqli_query($con2, $sql2);

                    if ($result2) {
                        echo "<div class='alert alert-success'>Student added to the list.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>ERROR: Could not add student</div>";
                    }
                } 
                else 
                    echo "<br><h1 class='text-center text-danger'>Student already in your list!</h1>";
            }
        } else 
            echo "<br><h1 class='text-center text-danger'>Error: " . $sql0 . "<br>" . mysqli_error($con1) . "</h1>";

        mysqli_close($con1);
        mysqli_close($con2);
    }
?>

<body id="reg-body">
    <form method="POST" id="form2">
        <p class="register-text" style="margin: 10px"> Enter CGPA criteria: </p><input type="text" name="cgpa" placeholder="Enter CGPA" class="input"  style="margin: 10px"><br><br>
        <p class="register-text" style="margin: 10px"> Enter Speciality: </p>
        <select id="speciality" name="speciality" class="input"  style="margin: 10px">
            <?php
            while ($r = $response->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $r['speciality_id'] ?>">
                    <?php echo $r['name']; ?>
                </option>
            <?php  } ?>
        </select><br>
            <input type="submit" name="search" value="Submit"  style="margin-left: 10px" style="margin: 10px">
    </form>
    <br>
    <?php
if (isset($_POST['search'])) {

    if($_POST['speciality'] == "" || $_POST['cgpa'] == "")
        echo "<div class='alert alert-success'>Please add all the fields.</div>";
    else{
        $con1 = mysqli_connect("localhost", "root", "", "upskill_student_db");

        $cgpa = (float)$_POST['cgpa'];
        $skill = $_POST['speciality'];
        $arr = array();

        if (!$con1) 
            die("Connection failed: " . mysqli_connect_error());

        $sql1 = "SELECT * FROM student st inner join speciality sp on st.speciality_id = sp.speciality_id WHERE cgpa >= '$cgpa' AND sp.speciality_id = '$skill'";
        $result1 = mysqli_query($con1, $sql1);

        echo "<div id='wrap-table'><table class='table'><thead class='thead-dark'>";
        echo "<tr>";
        echo "<th scope='col' class='table-head'>Student Reg. No.</th>";
        echo "<th scope='col' class='table-head'>Name</th>";
        echo "<th scope='col' class='table-head'>Email</th>";
        echo "<th scope='col' class='table-head'>CGPA</th>";
        echo "<th scope='col' class='table-head'>Speciality</th>";
        echo "<th scope='col' class='table-head'>Resume</th>";
        echo "<th scope='col' class='table-head'>Action</th>";
        echo "</tr></thead><tbody>";
    
        if($result1 == false)
        {
            echo "<div class='alert alert-danger'>No students found.</div>";
            echo "</tbody></table>";
            echo "<input type='submit' name='submitall' value='Add All' class='btn btn-primary s_all'>";
            echo "</div>";
        }
        else{
            while ($row1 = mysqli_fetch_assoc($result1)) {

                $id = $row1['regno'];
                $arr = array_merge($row1);

                echo "<tr>";
                echo "<td class='register-text'>" . $row1['regno'] . "</td>";
                echo "<td class='register-text'>" . $row1['firstname'] . " " . $row1['lastname'] . "</td>";
                echo "<td class='register-text'>" . $row1['email'] . "</td>";
                echo "<td class='register-text'>" . $row1['cgpa'] . "</td>";
                echo "<td class='register-text'>" . $row1['name'] . "</td>";
                echo "<td class='register-text'>";?><a href="downloads.php?id=<?php echo $row1['regno'];?>" target='_blank'>
                <img src='Images/downloads.png' height='35px'> <?php echo "</a></td>";
                echo "<td><form method='post'>
                <input type='hidden' name='st_regno' value='$id'>"
                ?>
                <input type='submit' name='addtolist' value='Add to List' class='btn btn-primary'  style="margin-left: 10px">
                <?php
                echo "</form></td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
            echo "</div><br>";
        }

        mysqli_close($con1);
    }
}
?>
<?php require_once "Includes/footer.php"; ?>