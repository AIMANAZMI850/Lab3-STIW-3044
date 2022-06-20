<?php

include_once("dbconnect.php");

    $results_per_page = 10;
    if (isset($_GET['pageno'])) {
        $pageno = (int)$_GET['pageno'];
        $page_first_result = ($pageno - 1) * $results_per_page;
    } else {
        $pageno = 1;
        $page_first_result = 0;
    }
    
if (!isset($sqlusbjects)) {
    $sqlsubjects = "SELECT * FROM tbl_subjects";
}

$stmt = $conn->prepare($sqlsubjects);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlsubjects = $sqlsubjects . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlsubjects);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js" defer></script>
    
    <title>Welcome to My Tutor</title>
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
        </div>
<div class="w3-purple">
        <div class="w3-container w3-center">
            <h3>Subjects Lists</h3>
        </div>
    </div>
    <div class="w3-margin w3-border w3-center" style="overflow-x:auto;">
        <?php
        $i = 0;
        echo "<table class='w3-table w3-striped w3-bordered' style='width:100%'>
         <tr><th style='width:10%'>Subject Id</th><th style='width:30%'>Subject Name</th><th style='width:30%'>Subject Description</th><th style='width:10%'>Subject Price</th><th style='width:5%'>Tutor Id</th><th style='width:5%'>Subject Sessions</th><th style='width:5%'>Subject Rating</th>";
        foreach ($rows as $subjects) 
        {
            $i++;
            $subjectid = $subjects['subject_id'];
            $subjectname = $subjects['subject_name'];
            $subjectdescription = $subjects['subject_description'];
            $subjectprice = $subjects['subject_price'];
            $tutorid = $subjects['tutor_id'];
            $subjectsession= $subjects['subject_sessions'];
            $subjectrating= $subjects['subject_rating'];
           
            echo "<tr><td>$i</td><td>$subjectname</td><td>$subjectdescription</td><td>$subjectprice</td><td>$tutorid</td><td>$subjectsession</td><td>$subjectrating</td>";
           
        }   
        
        echo "</table>";
        ?>
    </div>
    <br>
    <?php
        $num = 1;
        if ($pageno == 1) {
            $num = 1;
        } else if ($pageno == 2) {
            $num = ($num) + 10;
        } else {
            $num = $pageno * 10 - 9;
        }
        echo "<div class='w3-container w3-row'>";
        echo "<center>";
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a href = "subjects.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
        }
        echo " ( " . $pageno . " )";
        echo "</center>";
        echo "</div>";
    ?>
    </br>

    <footer class="w3-footer w3-center w3-bottom w3-purple">MY TUTOR COPYRIGHT</footer>

</body>

</html>