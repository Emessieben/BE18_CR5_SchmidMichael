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

// Get id and fetch data from database on base of id
$id = $_GET["id"];
$sql = "SELECT * FROM animals WHERE id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// checks if animal is still available or not and change text-color
$statusAvailableOrReservedColor;
if ($row['status'] == "available") {
  $statusAvailableOrReservedColor .= "text-success";
} else {
  $statusAvailableOrReservedColor .= "text-danger";
}

// bootstrap card with content
$html = "
  <div class='container  mt-5 pt-5'>
  
    <div class='card mx-auto p-3 m-5' style='width: 50rem;'>
      <div class='card-body row'>
        <img src='animals/pictures/" . $row['picture'] . "' class='col-4 detail_img align-self-center' alt='" . $row['name'] . "'>
        <div class='col-8'>
          <h4 class='card-title'>" . $row['name'] . "</h4>
          <p class='card-text'>" . $row['description'] . "</p>
          <ul class='list-group list-group-flush'>
          <li class='list-group-item'>Location: " . $row['location'] . "</li>
          <li class='list-group-item'>Size: " . $row['size'] . "</li>
          <li class='list-group-item'>Age: " . $row['age'] . "</li>
          <li class='list-group-item'>Vaccinated: " . $row['vaccinated'] . "</li>
          <li class='list-group-item'>Breed: " . $row['breed'] . "</li>
          <li class='list-group-item'>Status: <span class='" . $statusAvailableOrReservedColor . "'>" . $row['status'] . "</span></li>
        </ul>
        </div>
      </div>
      <div class='card-body mx-auto'>
      <a href='animals.php' class='card-link btn btn-dark'>Home</a>
      <a href='' class='card-link btn btn-success'>Adopt</a>
      </div>
    </div>
  </div>
  ";

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details <?= $row['name'] ?></title>
  <!-- Bootstrap -->
  <?php require_once "components/bootstrap.php" ?>
</head>

<body>
  <!-- User Navbar -->
  <?php require "components/navbar.php" ?>
  <?= $html ?>
</body>

</html>