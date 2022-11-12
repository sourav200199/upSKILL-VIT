<?php
    $title = "Employer_Index";
    require_once 'Includes/session.php';
    require_once 'Includes/authentication_check.php';
    require_once "Includes/header.php";
?>
<body id="reg-body1">
    <br>
    <br>
    <div class="box-row">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <img class="gif" src="Images/view.webp">
                </div>
                <p>Select students based on their profile and marks and add them to the list of shortlisted students.</p>
                <a href="emp_viewlist.php"><button class="btn btn-primary">Shortlist Students</button></a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <div class="card-header">
                <img class="gif" src="Images/shortlist_to_call.gif">
            </div>
                <p> View the students who have been enlisted for the next round of selection. <br> <br></p>
                <a href="shortlist.php"><button class="btn btn-primary">View Shortlisted students' list</button></a>
            </div>
        </div>
    </div>
</body>
<?php require_once "Includes/footer.php";?>