<?php 
   include_once 'includes/db_connect.php';
   include_once 'includes/functions.php';
    $myArray = array();
    $questions_query = "SELECT * FROM questions";
    if ($result = $mysqli->query($questions_query)) {
        $tempArray = array();
         while($result=$results->fetch_assoc()){
                $tempArray = $row;
                array_push($myArray, $tempArray);
         }
        echo json_encode($myArray);
    }
    

    $result->close();
    $mysqli->close();
?>
