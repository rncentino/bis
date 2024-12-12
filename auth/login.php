<?php

session_start();
define("APPURL", "http://localhost/brgyinfo");

?>
<?php require "../config/config.php"; ?>
<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) or empty($_POST['password'])) {
        $error = "One or more inputs are empty!";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login = $conn->prepare("SELECT * FROM barangay WHERE username ='$username'");
        $login->execute();
        $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {
            if (password_verify($password, $fetch['password'])) {
                $_SESSION['barangay'] = $fetch['barangay'];
                $_SESSION['barangay_id'] = $fetch['barangay_id'];
                $_SESSION['email'] = $fetch['email'];
                header("location: " . APPURL . "");
            } else {
                $error = "Username or password incorrect!";
            }
        } else {
            $error = "Username or password incorrect!";
        }
    }
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code." />
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard" />
    <meta name="author" content="ThemeSelect" />
    <title>
        Barangay Information System
    </title>
    <link rel="apple-touch-icon" href="../assets/logofiles/svg/blck-no-bg.svg" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/logofiles/svg/blck-no-bg.svg" />
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet" />
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors.css" />
    <link rel="stylesheet" type="text/css" href="../assets/vendors/css/charts/chartist.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/app-lite.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/core/menu/menu-types/vertical-menu.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/core/colors/palette-gradient.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/pages/dashboard-ecommerce.css" />
</head>

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-chartbg text-center">
                        <img src="../assets/logofiles/svg/colored-no-bg.svg" width="100">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">WELCOME TO LOGIN</h3>
                        <form role="form" method="post" action="login.php">
                            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                            <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                            <div class="mb-1">
                                <input name="username" type="text" class="form-control" placeholder="Enter username" id="username" />
                            </div>
                            <div class="mb-1">
                                <div class="input-group">
                                    <input name="password" type="password" class="form-control" placeholder="Enter password" id="password" />
                                    <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">Show</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="">
                                    <input type="checkbox" checked> Remember me
                                </p>
                                <p>
                                    <a class="text-primary" data-toggle="modal" data-target="#forgetPass" data-whatever="@getbootstrap">Forgot Password?</a>
                                </p>
                            </div>
                            <div class="text-center">
                                <button name="submit" type="submit" class="btn btn-primary" style="width: 100%">Sign In</button>
                                <hr>
                                <p>Don't have an account?
                                    <a class="text-primary text-decoration-none" href="brgy-reg.php">Register</a>
                                </p>
                            </div>
                        </form>

                        <div class="modal fade" id="forgetPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="card-header text-center mt-1">
                                        <h4 class="card-title" id="exampleModalLabel">FORGOT PASSWORD</h4>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-1">
                                                <input type="email" class="form-control" placeholder="Enter your registered email" required id="email" aria-describedby="emailHelp">
                                            </div>
                                            <div class="text-center mb-1">
                                                <button type="submit" class="btn btn-primary" style="width: 100%;">Recover password</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("showPasswordBtn").addEventListener("click", function() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.textContent = "Hide";
            } else {
                passwordInput.type = "password";
                this.textContent = "Show";
            }
        });
    </script>
    <script src="../assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="../assets/js/core/app-lite.js" type="text/javascript"></script>
    <script src="../assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
</body>

</html>