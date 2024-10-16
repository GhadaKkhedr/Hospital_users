<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ٌRegister</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <?php
    include '../DB/DB_connect.php';
    //  print_r($_POST["Options"]);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST['usrnm'];
        $name = $_POST['Name'];
        $password = $_POST['pass'];
        $Options = $_POST['Options'];
        $GoTo = "";
        $checkStmt = '';
        // Check if  already exists
        if ($Options == 1) {
            $checkStmt = $conn->prepare("INSERT INTO `doctors`(`ID`, `Name`, `userName`, `Password`) VALUES ('','$name','$username','$password');");

            // should check here if exist , Don't insert ...


            //  $checkStmt->bind_param("s", $username);
            $GoTo = '../Pages/DoctorLogin.php';
        } else if ($Options == 2) {
            $checkStmt = $conn->prepare("INSERT INTO `patients`(`ID`, `Name`, `userName`, `Password`) VALUES ('','$name','$username','$password');");

            // should check here if exist , Don't insert ...


            $GoTo = '../Pages/PatientLogin.php';
        }
        if ($checkStmt->execute()) {

            $checkStmt->close();
            $conn->close();
            header("Location: $GoTo");
        }
    }
    ?>

    <div class="border border-primary container p-5 d-flex flex-column align-items-center mx-auto">
        <form method="post" class="form-control mt-5 p-4"
            style="height:auto; width:380px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <h1>Register</h1>
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
                <div class="d-flex">
                    <label>Select are you a ? &nbsp;&nbsp;&nbsp; </label>
                    <input type="radio" id="Doctor" name="Options" value="1"> Doctor
                    <input type="radio" id="Patient" name="Options" value="2">Patient
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>

            </div>
        </form>
    </div>


</body>

</html>