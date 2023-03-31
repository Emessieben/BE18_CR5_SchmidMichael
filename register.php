<?php
require_once "components/db_connect.php";
require_once "components/file_upload.php";
session_start();
if (isset($_SESSION["user"])) {
  header("location: home.php");
  exit;
}
if (isset($_SESSION["adm"])) {
  header("location: dashboard.php");
  exit;
}

// function to clean input from white spaces and other unwanted stuff
function cleanInput($param)
{
  $cleaned = trim($param);
  $cleaned = strip_tags($param);
  $cleaned = htmlspecialchars($param);
  return $cleaned;
}

$fNameError = $lNameError = $emailError = $passwordError = $first_name = $last_name = $email = $password = "";
$error = false;

if (isset($_POST["register"])) {
  $first_name = cleanInput($_POST["first_name"]);
  $last_name = cleanInput($_POST["last_name"]);
  $password = cleanInput($_POST["password"]);
  $email = cleanInput($_POST["email"]);
  $phone_number = cleanInput($_POST["phone_number"]);
  $address = cleanInput($_POST["address"]);

  // First name validation
  if (empty($first_name)) {
    $error = true;
    $fNameError = "Please enter your first name.";
  } elseif (strlen($first_name) < 3) {
    $error = true;
    $fNameError = "First name must have at least 3 characters.";
  } elseif (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
    $error =  true;
    $fNameError = "Only letters are allowed.";
  }

  // Last name validation
  if (empty($last_name)) {
    $error = true;
    $lNameError = "Please enter your Last name.";
  } elseif (strlen($last_name) < 3) {
    $error = true;
    $lNameError = "last name must have at least 3 characters.";
  } elseif (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
    $error =  true;
    $lNameError = "Only letters are allowed.";
  }

  // Email validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a vaild email address.";
  } else {
    $query = "SELECT email from users WHERE email = '$email'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) != 0) {
      $error = true;
      $emailError = "Proived Email is already in use.";
    }
  }

  // Password validation
  if (empty($password)) {
    $error = true;
    $passwordError = "Please enter a password.";
  } elseif (strlen($password) < 6) {
    $error = true;
    $passwordError = "Password must have at least 6 characters.";
  }
  // Password will be crypted
  $password = hash("sha256", $password);
  $uploadError = '';
  $picture = file_upload($_FILES["picture"]);

  // runs query if there is no error
  if (!$error) {
    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`) 
      VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$address', '$picture->fileName', '$password')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
      $errorType = "success";
      $errorMessage = "Successfully registered! You are able to login now.";
      $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
    } else {
      $errorType = "danger";
      $errorMessage = "Something went wrong, try again!";
      $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
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
  <title>Register</title>
  <!-- Bootstrap -->
  <?php require_once "components/bootstrap.php" ?>
</head>

<body>

  <div class="container text-center mx-auto">

    <?php
    if (isset($errorMessage)) {
    ?>
      <div class="alert alert-<?= $errorType ?>" role="alert">
        <?= $errorMessage ?>
        <?= $uploadError ?>
      </div>
    <?php
    }
    ?>

    <form class="w-50 mx-auto my-5 border rounded p-5 bg-light" method="post" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>" enctype="multipart/form-data">
      <h1 class="m-3">Registration</h1>
      <input type="text" placeholder="Please type your first name" class="form-control m-1" name="first_name" value="<?= $first_name ?>" required>
      <!-- first name error -->
      <span class="text-danger"><?= $fNameError ?></span>
      <input type="text" placeholder="Please type your last name" class="form-control m-1" name="last_name" value="<?= $last_name ?>" required>
      <!-- last name error -->
      <span class="text-danger"><?= $lNameError ?></span>
      <input type="email" placeholder="Please type your email" class="form-control m-1" name="email" value="<?= $email ?>" required>
      <!-- email error -->
      <span class="text-danger"><?= $emailError ?></span>
      <input type="text" placeholder="Please phone number" class="form-control m-1" name="phone_number" required>
      <input type="text" placeholder="Please type address" class="form-control m-1" name="address" required>
      <input type="file" class="form-control m-1" name="picture">
      <input type="password" placeholder="Please type your password" class="form-control m-1" name="password" maxlength="20" required>
      <!-- password error -->
      <span class="text-danger"><?= $passwordError ?></span>
      <input type="submit" class="btn btn-primary m-3 btn-lg" value="Register" name="register">
      <br>
      <a class="fw-lighter link-opacity-75 link-opacity-50-hover text-decoration-none" href="index.php">Already registered? Click here</a>
    </form>
  </div>
</body>

</html>