<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $sqlinsert = "INSERT INTO `tbl_user`(`user_name`, `user_email`, `user_password`, `user_phone`, `user_address`) 
                  VALUES ('$name','$email','$password','$phone','$address')";
    try {
        $conn->exec($sqlinsert);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('users.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('register.php')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../res/images/users";
    $target_file = $target_dir . $filename . ".jpg";
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
    <script src="../js/script.js"></script>

    <title>Registration Page</title>
</head>

<body>
    <header class="w3-header w3-purple w3-center w3-padding-32">
        <h3><b>MY TUTOR</b></h3>
        <p><b>Registration Page</b></p>
       
    </header>
    
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="register.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure to register this user?')">
            <div class="w3-container w3-purple">
                <h3>Register New User</h3>
                
            </div>
            <div class="w3-bar w3-purple">
                    <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
            </div>
            <div class="w3-container w3-center">
                <img class="w3-image w3-margin" src="../res/images/users/profile.png" style="height:100%;width:200px"><br>
                <input type="file" name="fileToUpload" onchange="previewFile()">
            </div>
            <hr>
            
                <p>
                    <label><b>Name</b></label>
                    <input class="w3-input w3-round w3-border" type="text" name="name"  id="idname" placeholder="Your full name" required>
                </p>
                <p>
                    <label><b>Email</b></label>
                    <input class="w3-input w3-round w3-border" type="email" name="email" placeholder="Your email" required>
                </p>
                <p>
                    <label><b>Password</b></label>
                    <input class="w3-input w3-round w3-border" type="text" name="password" id="idepass" placeholder="Your password" required>
                </p>
                <p>
                    <label><b>Phone Number</b></label>
                    <input class="w3-input w3-round w3-border" type="text" name="phone"  id="idphone" placeholder="Your phone number" required>
                </p>
                <p>
                    <label><b>Address</b></label>
                    <input class="w3-input w3-round w3-border" type="address" name="address"  id="idaddress" placeholder="Your address" required>
                </p>
               
                <p>
                    <input class="w3-button w3-round w3-border w3-yellow " type="submit" name="submit" value="Register">
                </p>
				
        </form>
    </div>

    <footer class="w3-footer w3-center w3-bottom w3-purple">MY TUTOR COPYRIGHT</footer>

</body>

</html>