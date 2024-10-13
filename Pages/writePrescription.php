<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="align-items-center">
    <?php
    include '../DB/DB_connect.php';
    ?>


    <h1> Upload new prescription </h1>
    <div class="border border-primary container p-5 d-flex flex-column align-items-center mx-auto">
        <form method="post" class="form-control mt-5 p-4"
            style="height:auto; width:580px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">

            <label>Please select patient name : </label>

            <?php
            // Query to fetch data  
            $query = "SELECT `ID`,`Name` FROM `patients` ";
            $result = $conn->query($query);
            $dId = $_GET['dId']; //DoctorId

            if ($result->num_rows > 0) {
                echo '<select name="patientList" id="patientList" type="select" class="form-control">';
                echo '<option value ="Please select a name"><h3>-- Please select a name -- </h3></option>';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
                }
                echo '</select><br>';

                echo '<label>Please upload the prescription : </label><input name="prescriptionFile" id="prescriptionFile" type="file" ><br>';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $pId = $_POST['patientList']; //patientID 
                    $fileTmpPath = $_POST['prescriptionFile'];
                    $fileData =  file_get_contents($fileTmpPath);
                    //    print_r(json_decode($fileData, true));

                    $query = "INSERT INTO `prescription`(`ID`, `Doctor_ID`, `Patient_ID`, `Prescription_File`) VALUES ('','$dId','$pId','$fileData')";
                    print($query);
                    $result = $conn->query($query);
                }
                echo '<button class="btn btn-primary" onSubmit="document.write(' . 'File uploaded successfully!' . ');">Submit</button><br>';
            }

            //    $result->close();
            $conn->close();
            ?>


        </form>
    </div>
</body>

</html>