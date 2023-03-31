<?php
session_start();

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
  header("Location: dashboard.php");
  exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

require_once "components/db_connect.php";

$sql = "SELECT * FROM users WHERE id = {$_SESSION['user']} ";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <?php require_once "components/bootstrap.php" ?>
</head>

<body class="bg-light">
  <?php require_once "components/navbar.php" ?>
  <div class='container  mt-5 pt-5'>
    <h1 class="text-center">Welcome <span><?= $row['first_name']; ?></span></h1>
    <div class='card mx-auto p-3 m-5' style='width: 50rem;'>
      <div class='card-body row'>
        <img src="pictures/<?= $row['picture']; ?>" class='col-4 detail_img align-self-center' alt="<?= $row['first_name']; ?>">
        <div class='col-8'>
          <ul class='list-group list-group-flush'>
            <li class='list-group-item'><?= $row['first_name'] ?> <?= $row['last_name']; ?></li>
            <li class='list-group-item'><?= $row['email'] ?></li>
            <li class='list-group-item'><?= $row['phone_number'] ?></li>
            <li class='list-group-item'><?= $row['address'] ?></li>
          </ul>
        </div>
      </div>
      <div class='card-body mx-auto'>
        <a href="logout.php?logout" class="btn btn-warning">Sign Out</a>
        <a href="animals.php" class="btn btn-dark">Go to Animals</a>
      </div>
    </div>
  </div>
</body>

</html>