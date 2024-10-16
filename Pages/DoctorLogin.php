<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <?php
    include '../DB/DB_connect.php';

    echo "<button class='btn btn-primary' onclick='header(\"Location:../index.php\");'>return to home page</button>";
    $OK = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['usrnm'];
        $name = $_POST['Name'];
        $password = $_POST['pass'];

        $query = "SELECT `ID`, `Name`, `userName`, `Password` FROM `doctors` WHERE `userName`= '$username' AND `password`='$password';";
        // Check if  already exists
        $checkStmt = $conn->prepare($query);
        //  $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();
        print_r($checkStmt->num_rows);
        if ($checkStmt->num_rows > 0) {
            // user Exists
            $result = $conn->query($query);
            $dId = $result->fetch_assoc()["ID"];
            $OK = true;
            $_SESSION["dId"]=$dId;
            header("Location: writePrescription.php?dId=$dId");
        } else {
            $OK = false;
            // redirect to register
            header("Location: Register.php");
            die();
        }
        $checkStmt->close();
        $conn->close();
    }
    ?>
    <div class="border border-primary container p-5 d-flex flex-column align-items-center mx-auto">
        <form method="post" class="form-control mt-5 p-4"
            style="height:auto; width:380px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <h1>Login</h1>
            <div class="container mx-auto">
                <label for="Name"> Name : </label>
                <input name="Name" id="Name" type="text" placeholder="enter your name " class="form-control" required>
                <br>
                <label for="usrnm">User Name : </label>
                <input name="usrnm" id="usrnm" type="text" placeholder="enter your user name " class="form-control" required>
                <br>
                <label for="pass">Password : </label>
                <input name="pass" id="pass" type="password" placeholder="enter your password " class="form-control" required>
                <br>

                <button class="btn btn-primary" type="submit">Submit</button>

            </div>
        </form>
    </div>


</body>

</html>