<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail w-50' src='pictures/" . $row['picture'] . "'</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['location'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['size'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['vaccinated'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['status'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn m-2' type='button'>Update</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm m-2' type='button'>Delete</button></a></td>
            </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='10'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals CRUD</title>
    <?php require_once '../components/bootstrap.php' ?>

</head>

<body>
    <div class="container">
        <div class='text-center m-3'>
            <a href="create.php"><button class='btn btn-primary mx-3' type="button">+ Add Animal</button></a>
            <a href="../dashboard.php"><button class='btn btn-success mx-3' type="button">Dashboard</button></a>
        </div>
        <table class='table table-striped'>
            <thead class='table-info'>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Age</th>
                    <th>Vaccinated</th>
                    <th>Breed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
    </div>
</body>

</html>