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
$sql = "SELECT * FROM animals WHERE age >= 8";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "
        <div class='card col' style='width: 18rem;'>
        <img src='animals/pictures/" . $row['picture'] . "' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>" . $row['name'] . "</h5>
        </div>
        <ul class='list-group list-group-flush'>
        <li class='list-group-item'>Age: " . $row['age'] . "</li>
          <li class='list-group-item'>Location: " . $row['location'] . "</li>
        </ul>
        <div class='card-body'>
          <a href='details.php?id=" . $row['id'] . "' class='card-link btn btn-info'>Details</a>
          <a href='' class='card-link btn btn-success'>Adopt</a>
        </div>
      </div>
      ";
    };
} else {
    // no data in database
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <!-- Bootstrap -->
    <?php require_once "components/bootstrap.php" ?>
</head>

<body>
    <!-- User Navbar -->
    <?php require_once "components/navbar.php" ?>
    <div>
        <h1 class="text-center my-2">Our Seniors, older than 8 years.</h1>
        <div class="m-1 row row-cols-2 row-cols-lg-5 g-2 g-lg-3 justify-content-around">
            <?= $tbody; ?>
        </div>
    </div>

</body>

</html>