<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: index.php");
        exit;
    } else {
        include 'config.php';
        $username   = $_SESSION['username'];
        $q          = "SELECT name FROM `Freelancer` WHERE username='$username';";
        $res        = mysqli_query($conn, $q);
        while ($row = mysqli_fetch_row($res)) {
            $name = $row[0];
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $reward     = $_POST['reward'];
            $skills     = $_POST['skills'];
            $skills_arr = explode(" ", $skills);
            $q          = "UPDATE `Freelancer` SET reward = '$reward' WHERE username='$username';";
            $q         .= "INSERT INTO `F_skills` (`f_id`, `skills`) VALUES ((SELECT g.f_id FROM `Freelancer` AS g WHERE g.username='$username'), '$skills_arr[0]');";
            for ($i = 1; $i < count($skills_arr); $i++) {
                $q     .= "INSERT INTO `F_skills` (`f_id`, `skills`) VALUES ((SELECT g.f_id FROM `Freelancer` AS g WHERE g.username='$username'), '$skills_arr[$i]');";
            }
            $res        = mysqli_multi_query($conn, $q);
            if (!$res) {
                echo mysqli_error($conn)."<br>";
            }
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
            <h3>Profile Information - Freelancer</h3>

            <div class="col-25">
                <h4>Name</h4>
            </div>
            <div class="col-75">
                <h4><?php echo $name; ?></h4>
            </div>

            <div class="projects">
                <h4>Projects</h4>
                <ol>
                    <?php
                        include 'config.php';
                        $q      = "SELECT name FROM `Project` WHERE p_id = (SELECT p.p_id FROM `P_free` AS p WHERE p.f_id=(SELECT f.f_id FROM `Freelancer` AS f WHERE f.username='$username'));";
                        $res    = mysqli_query($conn, $q);
                        while ($row = mysqli_fetch_row($res)) {
                            ?>
                            <li> <?php echo $row[0] ?> </li>
                            <?php
                        }
                    ?>
                </ol>
            </div>
        </div>

        <div class="foot">
            <div class="dept">
                <div class="service">
                    <form action="main_freelancer.php" method="post">
                        <input type="text" name="reward" class="reward" placeholder="reward per hour">
                        <input type="text" name="skills" class="skills" placeholder="Skills (space separated)">
                        <input type="submit" name="create" value="Submit" class="serv_book">
                    </form>
                </div>
            </div>
            <div class="buttons" style="margin-left: 700px;">
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