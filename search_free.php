<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: index.php");
        exit;
    } else {
        include 'config.php';
        $skills     = array();
        $username   = $_SESSION['username'];
        $p_id       = $_COOKIE['p_id'];
        $q          = "SELECT skills FROM `P_skills` WHERE p_id='$p_id';";
        $res        = mysqli_query($conn, $q);
        do {
            if ($result_1 = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result_1)) {
                    array_push($skills, $row[0]);
                }
            }
        } while (mysqli_more_results($conn) && mysqli_next_result($conn));
    }
?>