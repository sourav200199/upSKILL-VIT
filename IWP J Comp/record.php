<?php
$title = "Record";
require_once 'Database/config.php';
require_once 'Includes/authentication_check.php';
$response = $crud->get_record();
?>

<?php require_once 'Includes/header.php'; ?>

<body id="record-body">
    <br>
    <br>
    <a href="student_landing.php" style="margin: 10px"><button class="btn btn-primary">Back to Home</button></a>
    <br>
    <br>
    <div class="box-table">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="table-head">Registration </th>
                    <th class="table-head">Name</th>
                    <th class="table-head">Speciality</th>
                    <th class="table-head">Options</th>
                </tr>
            </thead>
                <?php
                while ($s = $response->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td class="register-text">
                                <?php echo $s['regno']; ?>
                        </td>
                        <td class="register-text">
                                <?php echo $s['firstname'] . " " . $s['lastname']; ?>
                        </td>
                        <td class="register-text">
                            <p class="register-text">
                                <?php echo $s['name']; ?>
                        </td>
                        <td>
                            <span><a href="students_view.php?id=<?php echo $s['regno']; ?>" class="btn btn-primary">View</a></span>
                        </td>
                    </tr>
                <?php } ?>
        </table>
    </div>
<?php
    require_once 'Includes/footer.php';
?>
