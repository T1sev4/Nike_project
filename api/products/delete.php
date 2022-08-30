<?php
    include "../../config/db.php";

    $id = $_GET["id"];
    mysqli_query($con, "DELETE FROM products WHERE id = '$id'");
    echo json_encode(true);