<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <?php
    include '../DB/DB_connect.php';



    $pId = "";
    $dId = "";
    $query = "";
    if (isset($_GET['dId']))
        $dId = $_GET['dId'];


    if (isset($_GET['pId']))
        $pId = $_GET['pId'];

    if (!empty($pId) && !empty($dId)) {

        $query = "SELECT `p_date`,`Prescription_File` FROM `prescription` WHERE `Patient_ID`= $pId AND `Doctor_ID`= $dId";
    } else if (!empty($dId)) {
        $query = "SELECT `p_date`,`Prescription_File` FROM `prescription` WHERE  `Doctor_ID`=$dId";
    } else if (!empty($pId)) {
        $query = "SELECT `p_date`,`Prescription_File` FROM `prescription` WHERE `Patient_ID`= $pId";
    }
    //   $result = $conn->prepare($query);
    //   $result->bind_param("i", $pId);
    //   $result->execute();
    // $result->store_result();
    $result = $conn->query($query);
    $fileTmpPath = "../images/";
    $count = 1;
    echo "<button class='btn btn-primary' onclick='header(\"Location:../index.php\");'>return to home page</button>";
    // $stmt = $result->get_result();
    $Row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        while (true) {

            echo "<table> <th> Prescription Date </th> <th> Prescription File </th>";
            $filePath = $fileTmpPath . "$count.png";
            $myfile = fopen($filePath, "w");
            file_put_contents($filePath, $Row["Prescription_File"]);
            //echo "<tr><td>" . $Row["p_date"] . "</td><td>" . $Row["Prescription_File"] . "</td></tr>";
            echo "<tr><td>" . $Row["p_date"] . "</td><td>" . $filePath . "</td><td><a href='$filePath' target='_blank'>Open File</a></td></tr>";
            //  break;
            $count++;
            if (!($Row = $result->fetch_assoc())) {
                break;
            }
        }
    }


    ?>
</body>

</html>