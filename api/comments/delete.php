<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    $id = $_GET["id"];
    
    mysqli_query($con , "DELETE FROM comments WHERE id = '$id'");
    echo json_encode(true); 
