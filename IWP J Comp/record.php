<?php
$title = "Record";
require_once 'Database/config.php';
require_once 'Includes/authentication_check.php';
$response = $crud->get_record();
?>

<?php require_once 'Includes/header.php'; ?>

<body>
    <div class="box-table">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="table-head">Registration </th>
                    <th scope="col" class="table-head">Name</th>
                    <th scope="col" class="table-head">Speciality</th>
                    <th scope="col" class="table-head">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($s = $response->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td>
                            <p class="register-text">
                                <?php echo $s['regno']; ?>
                            </p>
                        </td>
                        <td>
                            <p class="register-text">
                                <?php echo $s['firstname'] . " " . $s['lastname']; ?>
                        </td>
                        </p>
                        <td>
                            <p class="register-text">
                                <?php echo $s['name']; ?>
                        </td>
                        </p>
                        <td>
                            <span><a href="students_view.php?id=<?php echo $s['regno']; ?>" class="btn btn-primary">View</a></span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
    require_once 'Includes/footer.php';
?>
