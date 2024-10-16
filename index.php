<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <?php
    include 'DB/DB_connect.php';
    session_start();
    ?>
    <div class="bg-image container p-5 d-flex flex-column align-items-end justify-content-center" style="background-image: url('images/Home.png'); height: 100vh;background-size: cover;">

        <br><br><br>
        <div class="row">
            <div class="col-3">
                <button class="btn btn-primary" onclick="window.location.href='Pages/PatientLogin.php'">Login as patient</button>
            </div>
            <div class="col-3">
                <button class="btn btn-primary" onclick="window.location.href='Pages/DoctorLogin.php'">Login as doctor</button>
            </div>
            <div class="col-3">
                <button class="btn btn-primary" onclick="window.location.href='Pages/Register.php'">New user? Register<br></button>
            </div>
        </div>
    </div>