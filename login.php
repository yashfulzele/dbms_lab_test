<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'config.php';
        $f_or_c   = $_POST["f_or_c"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $login = false;
        if (!empty($f_or_c)) {
            if ($f_or_c == "freelancer") {
                $query = "SELECT username, password FROM `Freelancer` WHERE username = '$username' AND password = '$password';";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) == 1) {
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user']     = "freelancer";
                    $_SESSION['username'] = $username;
                    header("location: main_freelancer.php");
                }
            } else if ($f_or_c == "client") {
                $query = "SELECT username, password FROM `Client` WHERE username = '$username' AND password = '$password';";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) == 1) {
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user']     = "client";
                    $_SESSION['username'] = $username;
                    header("location: main_client.php");
                }
            }
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
                    <h2 style="text-align:center;">Login page</h2>

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
                        <input type="submit" name="create" value="Login" id="login">
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
    var login = '<?php echo $login; ?>';
    if (login != 1) {
        $(function(){
            Swal.fire({
                position: 'centre',
                icon: 'error',
                title: 'Enter valid credentials or Signup',
                showConfirmButton: false,
                timer: 1500
            })
        });
    }
</script>
</body>
</html>