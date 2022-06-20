<?php

if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $subjectname = addslashes($_POST['subject_name']);
    $subjectdescription = addslashes($_POST['subject_description']);
    $subjectprice = $_POST['subject_price'];
    $tutorid = $_POST['tutor_id'];
    $subjectsession = $_POST['subject_sessions'];
    $subjectrating = $_POST['subject_rating'];
    
    $sqlinsertsubjects = "INSERT INTO `tbl_subjects`(`subject_name`, `subject_description`, `subject_price`, `tutor_id`, `subject_sessions`, `subject_rating`) VALUES 
    ('$subjectname','$subjectdescription','$subjectprice',$tutorid,$subjectsession,'$subjectrating')";
    try {
        $conn->exec($sqlinsertsubjects);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('index.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('newsubject.php')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../res/images/newcourse/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js"></script>
    <script src="../js/script.js"></script>

    <title>Welcome to SlumShop</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="#" class="w3-bar-item w3-button">Profile</a>
        <a href="index.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="subjects.php" class="w3-bar-item w3-button">Subjects</a>
        <a href="tutor.php" class="w3-bar-item w3-button">Tutors</a>
        <a href="#" class="w3-bar-item w3-button">Subscriptions</a>
        <a href="login.php" class="w3-bar-item w3-button">Logout</a>
     </div>

     <div class="w3-purple">
            <button class="w3-button w3-purple w3-xlarge" onclick="w3_open()">☰</button>
            <div class="w3-container">
                <h3>New Subjects</h3>
        </div>
    </div>
   
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="newsubject.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-purple">
                <h3>New Subjects</h3>
            </div>
            <div class="w3-container w3-center">
                <img class="w3-image w3-margin" src="../res/images/New-Course.png" style="height:100%;width:400px"><br>
                <input type="file" name="fileToUpload" onchange="previewFile()">
            </div>
            <hr>

            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Subject Name</b></label>
                        <input class="w3-input w3-border w3-round" name="subject_name" type="text" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Subject Description</b></label>
                        <input class="w3-input w3-border w3-round" name="subject_description" type="text" required>
                    </p>
                </div>
            </div>
            <div class="w3-third" style="padding-right:4px">
            <p>
                <label><b>Subject Price</b></label>
                <input class="w3-input w3-border w3-round" name="subject_price" type="number" step="any" required>
            </p>
            </div>
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Tutor Id</b></label>
                        <input class="w3-input w3-border w3-round" name="tutor_id" type="number" step="any" required>
                    </p>
                </div>
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Subject Sessions</b></label>
                        <input class="w3-input w3-border w3-round" name="subject_sessions" type="number" step="any" required>
                    </p>
                </div>
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Subject Rating</b></label>
                        <input class="w3-input w3-border w3-round" name="subject_rating" type="text" required>
                    </p>
                </div>
                <p>
                    <input class="w3-button w3-purple w3-round w3-block w3-border" type="submit" name="submit" value="Insert">
                </p>
            </div>
        </form>
    </div>

    <footer class="w3-footer w3-center w3-bottom w3-purple">MY TUTOR</footer>

</body>

</html>
