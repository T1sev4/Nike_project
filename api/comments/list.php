<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    $product_id = $_GET["id"];
    $comments_query = mysqli_query($con, "SELECT c.*, u.first_name, u.last_name FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.product_id = $product_id");

    $comments = array();
    if(mysqli_num_rows($comments_query) > 0){
        while($row = mysqli_fetch_assoc($comments_query)){
            $comments[] = $row;
        }
    }
    echo json_encode($comments);