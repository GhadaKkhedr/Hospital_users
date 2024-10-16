<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <?php
    include '../DB/DB_connect.php';
    $OK = true;
    echo "<button class='btn btn-primary' onclick='header(\"Location:../index.php\");'>return to home page</button>";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //  print("here");
        $username = $_POST['usrnm'];
        $name = $_POST['Name'];
        $password = $_POST['pass'];
        $query = "SELECT `ID`, `Name`, `userName`, `Password` FROM `patients` WHERE `userName`= '$username' AND `password`='$password';";
        //  print($query);
        // Check if  already exists
        $checkStmt = $conn->query($query);
        //  $checkStmt->bind_param("s", $username);
        //$checkStmt->execute();
        // $checkStmt->store_result();
        // print_r($checkStmt->num_rows);
        if ($checkStmt->num_rows > 0) {
            // user Exists
            $OK = true;
            $row = $checkStmt->fetch_assoc();
            $ID = $row["ID"]; //
            $_SESSION["pId"]=$pId;
            header("Location: ViewPrescription.php?pId=$ID");
            //    print("ok");
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