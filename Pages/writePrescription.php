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
    session_start()
    ?>


    <h1> Upload new prescription </h1>
    <div class="border border-primary container p-5 d-flex flex-column align-items-center mx-auto">

        <form method="post" enctype="multipart/form-data" class="form-control mt-5 p-4"
            style="height:auto; width:580px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">

            <label>Please select patient name : </label>

            <?php
            // Query to fetch data  
            $query = "SELECT `ID`,`Name` FROM `patients` ";
            $result = $conn->query($query);
            if (isset($_GET['dId']))
                $dId = $_GET['dId']; //DoctorId
            $pId = "";
            $Finished = false;
            if ($result->num_rows > 0) {
                echo '<select name="patientList" id="patientList" type="select" class="form-control" required>';
                echo '<option value ="Please select a name"><h3>-- Please select a name -- </h3></option>';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
                }
                echo '</select><br>';

                echo '<label>Please upload the prescription : </label><input name="prescriptionFile" id="prescriptionFile" type="file" required><br>';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (array_key_exists('button1', $_POST)) {

                        $pId = $_POST['patientList']; //patientID 
                        $_SESSION["pId"] = $pId;
                        $fileTmpPath = $_FILES['prescriptionFile']["tmp_name"];
                        $fileData =  file_get_contents($fileTmpPath);
                        //   $FileData = json_decode($fileData, true);
                        // print_r(json_decode($fileData, true));
                        if ($fileData)
                            $query = "INSERT INTO `prescription`(`Doctor_ID`, `Patient_ID`, `Prescription_File`) VALUES (?,?,?)";
                        /* else {

                        echo '<textarea name="PrescriptionText" onblur="<?php $fileData = ?>document.getElementByName(\'PrescriptionText\').value;"></textarea>';
                        $query = "INSERT INTO `prescription`(`Doctor_ID`, `Patient_ID`, `Prescription_Text`) VALUES (?,?,?)";
                    }
                    */
                        $result = $conn->prepare($query);
                        $result->bind_param("iis", $dId, $pId, $fileData);
                        $_SESSION['pId'] = $pId;
                        //  $result->execute([$dId, $pId, $fileData]);
                        //   if ($result->execute())
                        //     print("file Uploaded successfully!");
                        $result->execute();
                        $Finished = true;
                        echo '<br><script>document.getElementById("prescriptionFile").removeAttribute("required");</script>';
                        echo '<button class="btn btn-primary" name="button2">Go Home</button><br>';
                        echo '<button class="btn btn-primary" name="button3">View Prescriptions</button><br>';
                    } else if (array_key_exists("button2", $_POST)) {
                        header("Location:../index.php");
                    } else if (array_key_exists("button3", $_POST)) {

                        $pId = $_SESSION['pId'];
                        header("Location: ViewPrescription.php?pId=$pId&dId=$dId");
                    }
                    //  nl2br("File Uploaded successfully!");
                    exit("File Uploaded successfully!");
                }
                echo '<button class="btn btn-primary" type="submit" name="button1">Submit</button><br>';
                // 
            }

            /*
             $result->close();
            $conn->close();
           
            if ($Finished) {
                echo '<button class="btn btn-primary" name="button2">Go Home</button><br>';
                echo '<button class="btn btn-primary" name="button3">View Prescriptions/button><br>';
            }*/
            ?>


        </form>

    </div>
</body>

</html>