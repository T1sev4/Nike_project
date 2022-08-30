<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    $nickname = $_GET["nickname"];

    $get_products = mysqli_query($con, "SELECT p.*, c.name, u.first_name FROM  products p INNER JOIN
    categories c ON p.category_id = c.id INNER JOIN users u ON p.user_id = u.id WHERE u.first_name = '$nickname'");

    $products = array();
    if(mysqli_num_rows($get_products) > 0){
        while($row = mysqli_fetch_assoc($get_products)){
            $products[] = $row;
        }
    }
    echo json_encode($products);