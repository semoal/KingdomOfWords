<?php 
   include_once '../controllers/db_connect.php';
   include_once '../controllers/functions.php';
   
    $query = "SELECT * FROM  `questions`";
    if ($result = mysqli_query($mysqli, $query)) {
      $out = array();
    
    while ($row = $result->fetch_assoc()) {
        $out[] = $row;
    }
    
      /* encode array as json and output it for the ajax script*/
      echo json_encode($out);
    
      /* free result set */
      mysqli_free_result($result);
    
      /* close connection*/
      $mysqli->close();
    }
?>
