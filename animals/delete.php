<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

// seaarch for data on the basis of id and DELETEs it from database
$id = $_GET["id"];
$sql = "DELETE FROM animals WHERE id= $id";
if (mysqli_query($connect, $sql)) {
    header("location: index.php");
}
mysqli_close($connect);

?>
