<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'config.php';
        $showError      = false;
        $error          = "Some error occurred!";
        $f_or_c         = $_POST["f_or_c"];
        $name           = $_POST['name'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        if (!empty($f_or_c)) {
            if ($f_or_c == "freelancer") {
                $query  = "SELECT username FROM `Freelancer` WHERE username = '$username';";
                $res    = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) == 0) {
                    $sql1       = "INSERT INTO `Freelancer` (`name`, `username`, `password`) VALUES ('$name', '$username', '$password');";
                    $result1    = mysqli_query($conn, $sql1);
                    if (result1) {
                        header("location: index.php");
                        exit;
                    } else {
                        $showError = true;
                        $error = ("Error description: " . mysqli_error($conn));
                    }
                } else {
                    echo mysqli_error($conn)."<br>";
                    $showError = true;
                    $error = "Change your username!";
                }
            } else if ($f_or_c == "client") {
                $query  = "SELECT username FROM `Client` WHERE username = '$username';";
                $res    = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) == 0) {
                    $sql1       = "INSERT INTO `Client` (`name`, `username`, `password`) VALUES ('$name', '$username', '$password');";
                    $result1    = mysqli_query($conn, $sql1);
                    if (result1) {
                        header("location: index.php");
                        exit;
                    } else {
                        $showError = true;
                        $error = ("Error description: " . mysqli_error($conn));
                    }
                } else {
                    echo mysqli_error($conn)."<br>";
                    $showError = true;
                    $error = "Change your username!";
                }
            }
        } else {
            $showError = true;
            $error = "Choose the user type!";
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
    <title>Registration</title>
</head>
<body style="background-color:rgb(0, 0, 0);">
    <div class="form">
        <div class="container" style="padding: 10px 325px 20px 325px;">
            <form action="registration.php" method="post">
                <div class="row">
                    <h2 style="text-align:center;">Registration page</h2>

                    <div class="col-25" style="width:25%;">
                        <label for="f_or_c">Select user</label>
                    </div>
                    <div class="col-75" style="width:75%;">
                        <select name="f_or_c" id="f_or_c">
                            <option value="" disabled selected>Choose option</option>
                            <option value="freelancer">Freelancer</option>
                            <option value="client">Client</option>
                        </select>
                    </div>

                    <div class="col-25">
                        <label for="name">Full Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" name="name" placeholder="Your full name" required>
                    </div>

                    <div class="col-25">
                        <label for="username">Username</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="username" name="username" placeholder="Username" required>
                    </div>

                    <div class="col-25">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="submit" style="text-align: center;">
                        <input type="submit" name="create" value="Sign Up" id="register">
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState( null, null, window.location.href );
    }
    var showError = '<?php echo $showError; ?>';
    var error = '<?php echo json_encode($error); ?>';
    if (showError == 1) {
        $(function(){
            Swal.fire({
                position: 'centre',
                icon: 'error',
                title: 'Correct the form!',
                text: error,
                showConfirmButton: false,
                timer: 1500
            })
        });
    }
</script>
</body>
</html>