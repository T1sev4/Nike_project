<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    $user_id = $_GET["user_id"];
    $get_favorites = mysqli_query($con, "SELECT f.*, p.title, p.price, p.image, cat.name, u.first_name FROM favorites f INNER JOIN products p ON f.product_id = p.id INNER JOIN users u ON f.user_id = u.id INNER JOIN categories cat ON p.category_id = cat.id WHERE f.user_id = $user_id");

    $favorites = array();
    if(mysqli_num_rows($get_favorites) > 0){
        while($row = mysqli_fetch_assoc($get_favorites)){
            $favorites[] = $row;
        }
    }
    echo json_encode($favorites);