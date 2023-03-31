<?php
session_start();
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    // remove ' and " from string, to avoid Error
    $description = mysqli_escape_string($connect, $description);
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccinated = $_POST["vaccinated"];
    $breed = $_POST["breed"];
    $status = $_POST["status"];
    $picture = file_upload($_FILES["picture"], "animal");

    $sql = "INSERT INTO `animals`(`picture`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`, `name`) 
    VALUES ('$picture->fileName','$location','$description','$size','$age','$vaccinated','$breed','$status','$name')";

    // alerts Success/Error
    if (mysqli_query($connect, $sql)) {
        $message = "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>Swal.fire(
        'Successfully created!',
        '',
        'success'
    )</script>";
    } else {
        header("location: error.php");
    }
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Animal</title>
    <?php require_once '../components/bootstrap.php' ?>
</head>

<body>
<div class="container w-75">
    <fieldset class="border rounded p-3 m-3 bg-light">
        <legend class='text-center fs-1 fw-bold'>Add Animal</legend>
        <form method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Name" required></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class='form-control' type="text" name="location" placeholder="Location" required></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" placeholder="Description" required></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="text" name="size" placeholder="Size" required></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="text" name="age" placeholder="Age" required></td>
                </tr>
                <tr>
                    <th>Vaccinated</th>
                    <td>
                        <select class="form-select" type="text" name="vaccinated" placeholder="vaccinated" required>
                            <option value="yes" for="vaccinated">yes</option>
                            <option value="no" for="vaccinated">no</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="breed" required></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <select class="form-select" type="text" name="status" placeholder="Status" required>
                            <option value="available" for="status">available</option>
                            <option value="adopted" for="status">adopted</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture"></td>
                </tr>
                <tr>
                <td><a href="index.php"><button class='btn btn-dark' type="button">Home</button></a></td>
                    <td><button class='btn btn-warning' type="submit" name="submit">+ Add Animal</button></td>
                </tr>
            </table>
        </form>
    </fieldset>
</div>
    <?= $message ?>

</body>

</html>