<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: index.php");
        exit;
    } else {
        include 'config.php';
        $username   = $_SESSION['username'];
        $q          = "SELECT name FROM `Client` WHERE username='$username';";
        $res        = mysqli_query($conn, $q);
        while ($row = mysqli_fetch_row($res)) {
            $name   = $row[0];
        }
        $qq         = "SELECT name FROM `Project` WHERE c_id=(SELECT c.c_id FROM `Client` AS c WHERE username='$username');";
        $req        = mysqli_query($conn, $qq);
        while ($row = mysqli_fetch_row($req)) {
            $proj   = $row[0];
        }
    }
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome freelancer</title>
</head>
<body style="background-color: rgb(0, 0, 0); height: 100%;">
    <div class="container" style="height: 100%;">

        <div class="profile">
            <h3>Profile Information - Client</h3>

            <div class="col-25">
                <h4>Name</h4>
            </div>
            <div class="col-75">
                <h4><?php echo $name; ?></h4>
            </div>

            <div class="projects">
                <h4>Project</h4>
                <h4><?php echo $proj; ?></h4>
            </div>
        </div>

        <div class="foot">
            
            <div class="buttons" style="margin-left: 700px;">
                <div class="form1">
                    <div class="update_bt">
                        <button onclick="location.href = 'project.php';" class="update">Project</button>
                    </div>
                </div>
                <div class="form3">
                    <div class="logout_bt">
                        <button onclick="location.href = 'logout.php';" class="logout">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>