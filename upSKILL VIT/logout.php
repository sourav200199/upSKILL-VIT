<?php
    include_once 'Includes/session.php';
?>
<?php
    session_destroy();
    header("Location: index.php");
?>