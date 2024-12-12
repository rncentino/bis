<?php require "../config/config.php"; ?>
<?php
if (isset($_POST['submit'])) {
  if (
    empty($_POST['province']) or
    empty($_POST['city']) or
    empty($_POST['barangay']) or
    empty($_POST['email']) or
    empty($_POST['number']) or
    empty($_POST['username']) or
    empty($_POST['password'])
  ) {
    $error = "One or more inputs are empty!";
  } else {
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO barangay( province, city, barangay, email, number, username, password) VALUES (:province, :city, :barangay, :email, :number, :username, :password)");
    $insert->execute([
      ":province" => $province,
      ":city" => $city,
      ":barangay" => $barangay,
      ":email" => $email,
      ":number" => $number,
      ":username" => $username,
      ":password" => $password,
    ]);
    header("location: login.php");
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
            <h3 class="card-title text-center">REGISTER</h3>
            <form role="form" enctype="multipart/form-data" method="post" action="brgy-reg.php">
              <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
              <div class="mb-1">
                <input name="province" type="text" class="form-control" placeholder="Province" id="province">
              </div>
              <div class="mb-1">
                <input name="city" type="text" class="form-control" placeholder="City/Municipality" id="city">
              </div>
              <div class="mb-1">
                <input name="barangay" type="text" class="form-control" placeholder="Barangay" id="barangay">
              </div>
              <div class="mb-1">
                <input name="email" type="email" class="form-control" placeholder="Email address" id="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-1">
                <input name="number" type="number" class="form-control" placeholder="Contact number" id="number">
              </div>
              <div class="mb-1">
                <input name="username" type="text" class="form-control" placeholder="Username" id="username">
              </div>
              <div class="mb-1">
                <div class="input-group">
                  <input name="password" type="password" class="form-control" placeholder="Password" id="password">
                  <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">Show</button>
                </div>
              </div>
              <div class="text-center">
                <p><input name="agree" type="checkbox" checked> I agree to the <a class="text-primary" data-toggle="modal" data-target="#terms" data-whatever="@getbootstrap">Terms and Conditions.</a>
                </p>

                <div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="card-header text-center mt-1">
                        <h4 class="card-title" id="exampleModalLabel">TERMS & CONDITIONS</h4>
                      </div>
                      <div class="card-body text-justify">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam finibus rutrum est, non
                          ultrices erat rhoncus vel. Duis dapibus orci sed nisl convallis scelerisque. Etiam a ipsum
                          sed nulla mollis finibus at at neque. Curabitur vel massa a mauris scelerisque maximus ac eu
                          dui. Aliquam dapibus venenatis mi, eu laoreet purus. Fusce mattis, justo eget convallis aliquam,
                          dui magna interdum dolor, in iaculis nisi magna a urna. Nunc vel blandit nisi. Sed laoreet lorem
                          non mi ultrices auctor. Etiam sed nisi non turpis ultricies tempus sit amet a nunc. Quisque ac
                          malesuada dui, vitae porta nibh. Mauris convallis felis sapien, et mattis libero tristique sit amet.
                        </p>
                        <p> In hac habitasse platea dictumst. Nunc pulvinar odio nec maximus vehicula. Sed bibendum massa ut
                          felis sagittis, vel finibus quam semper. Praesent posuere dignissim malesuada. Fusce odio tortor,
                          posuere sit amet sodales et, aliquam ac justo.</p>
                        <ul>
                          <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                          <li>Suspendisse elementum lorem eget dolor ullamcorper, quis semper nunc fringilla.</li>
                          <li>Praesent at tellus id felis aliquam elementum ut ac nulla.</li>
                          <li>Donec fermentum libero vitae gravida consequat.</li>
                          <li>In eget erat eget lectus finibus efficitur sit amet non orci.</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate tristique est, eu
                          eleifend ante. Nullam porttitor a quam pulvinar fermentum. Aenean feugiat tellus erat, nec cursus
                          tellus rutrum id. Nullam a molestie urna.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <button name="submit" type="submit" class="btn btn-primary" style="width: 100%;">Sign Up</button>
                <hr>
                <p> Already have an account? <a class="text-primary" href="login.php">Login instead. </a></p>
              </div>
            </form>
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