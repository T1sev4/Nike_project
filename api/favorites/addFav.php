<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    session_start();

    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = $data["product_id"];
    $user_id = $_SESSION["id"];
    
    mysqli_query($con, "INSERT INTO favorites (product_id, user_id) VALUES ($product_id, $user_id)");
    echo json_encode(true);
