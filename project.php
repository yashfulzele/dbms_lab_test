<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: index.php");
        exit;
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'config.php';
            $username   = $_SESSION['username'];
            $name       = $_POST['name'];
            $skills     = $_POST['skills'];
            $skills_arr = explode(" ", $skills);
            $q          = "INSERT INTO `Project` (`name`, `c_id`) VALUES ('$name', (SELECT c_id FROM `Client` WHERE username='$username'));";
            $q         .= "SELECT LAST_INSERT_ID();";
            $res        = mysqli_multi_query($conn, $q);
            do {
                if ($result_1 = mysqli_store_result($conn)) {
                    while ($row = mysqli_fetch_row($result_1)) {
                        $p_id = $row[0];
                    }
                }
            } while (mysqli_more_results($conn) && mysqli_next_result($conn));
            $qq         = "INSERT INTO `P_skills` (`p_id`, `skills`) VALUES ('$p_id', '$skills_arr[0]');";
            for ($i = 1; $i < count($skills_arr); $i++) {
                $qq    .= "INSERT INTO `P_skills` (`p_id`, `skills`) VALUES ('$p_id', '$skills_arr[$i]');";
            }
            $res2       = mysqli_multi_query($conn, $qq);
            $_COOKIE['p_id'] = $p_id;
            header("location: search_free.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body style="background-color:rgb(0, 0, 0);">
    <div class="form">
        <div class="container" style="padding: 120px 450px 170px 450px;">
            <form action="login.php" method="post">
                <div class="row">
                    <h2 style="text-align:center;">Project</h2>

                    <div class="col-25">
                        <label for="name">Project</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" name="name" placeholder="Name of project" required>
                    </div>

                    <div class="col-25">
                        <label for="skills">Skills</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="skills" name="skills" placeholder="Skills (space seperated)" required>
                    </div>

                    <div class="submit" style="text-align: center;">
                        <input type="submit" name="create" value="Search Users" id="search">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>