<?php
    require_once 'Includes/session.php';
    require_once 'Includes/authentication_check.php';
    require_once 'Database/config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $id = "resume_upload/" . $id . ".pdf";
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename='$id'");

        readfile($id);
    }
?>