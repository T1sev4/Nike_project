<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    session_start();

    $data = json_decode(file_get_contents('php://input'), true);
    $text = $data["text"];
    $product_id = $data["product_id"];
    $user_id = $_SESSION["id"];

    mysqli_query($con, "INSERT INTO comments (product_id, user_id, text) VALUES ($product_id, $user_id, '$text')");
    echo json_encode(true);
