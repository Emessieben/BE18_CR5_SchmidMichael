<?php
session_start();

// if User redirect to home.php
if (isset($_SESSION["user"])) {
  header("location: home.php");
  exit;
}
// if admin redirect to dashboard.php
if (isset($_SESSION["adm"])) {
  header("location: dashboard.php");
  exit;
}

require_once "components/db_connect.php";

// clean white spaces
function cleanInput($param)
{
  $cleaned = trim($param);
  $cleaned = strip_tags($param);
  $cleaned = htmlspecialchars($param);
  return $cleaned;
}

$emailError = $email = $passwordError = "";

if (isset($_POST["login"])) {
  $error = false;

  // cleans the vars
  $email = cleanInput($_POST["email"]);
  $password = cleanInput($_POST["password"]);

  // Email validation
  if (empty($email)) {
    $error = true;
    $emailError = "Please enter your email address.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter valid email address.";
  }
  if (empty($password)) {
    $error = true;
    $passwordError = "Please enter your password.";
  }

  // check input of user with database
  if (!$error) {
    // crypt the password
    $password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($count == 1) {
      if ($row["status"] == "adm") {
        $_SESSION["adm"] = $row["id"];
        header("Location: dashboard.php");
      } else {
        $_SESSION["user"] = $row["id"];
        header("Location: home.php");
      }
    }
  }
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap -->
  <?php require_once "components/bootstrap.php" ?>
</head>

<body>
  <div class="container text-center">
    <form class="w-50 mx-auto my-5 border rounded p-5 bg-light" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <h1 class="m-3">Login</h1>
      <input type="email" autocomplete="off" name="email" class="form-control m-1" placeholder="Email" value="<?php echo $email; ?>" maxlength="40" />
      <span class="text-danger"><?php echo $emailError; ?></span>

      <input type="password" name="password" class="form-control m-1" placeholder="Password" maxlength="15" />
      <span class="text-danger"><?php echo $passwordError; ?></span>
      <button class="btn btn-primary btn-lg m-3" type="submit" name="login">Login</button>
      <br>
      <a class="fw-lighter link-opacity-75 link-opacity-50-hover text-decoration-none" href="register.php">Not registered yet? Click here</a>
    </form>
  </div>
</body>

</html>