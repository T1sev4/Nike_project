<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    $product_id = $_POST["product_id"];

    if(isset($_POST["title"], $_POST["category_id"], $_POST["price"], $_POST["description"], $_POST["product_id"]) && 
    strlen($_POST["title"]) > 0 &&
    strlen($_POST["price"]) > 0 &&
    strlen($_POST["description"]) > 0 &&
    intval($_POST["category_id"]) &&
    intval($_POST["product_id"]))
    {
        $title = $_POST["title"];
        $price = $_POST["price"];
        $desc = $_POST["description"];
        $categ_id = $_POST["category_id"];
        session_start();
        $user_id = $_SESSION["id"];
        if(isset($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 0){
            $query = mysqli_query($con, "SELECT image FROM products WHERE id = '$product_id'");
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                $old_path = __DIR__."/../../".$row["image"];
                // проверяем есть ли такой файл
                if(file_exists($old_path)){
                    unlink($old_path);
                }
            }
            $ext = end(explode('.' , $_FILES["image"]["name"]));
            $image_name = time().'.'.$ext;
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/products/$image_name");
            $path = "images/products/$image_name";
            $prep = mysqli_prepare($con, "UPDATE products SET title = ?, price = ?, description = ?, category_id = ?, image = ? WHERE id = ?");
            mysqli_stmt_bind_param($prep, "sisiss", $title, $price, $desc, $categ_id, $path, $product_id);
            mysqli_stmt_execute($prep);
        }
        else{
            $prep = mysqli_prepare($con, "UPDATE products SET title = ?, price = ?, description = ?, category_id = ? WHERE id = ?");
            mysqli_stmt_bind_param($prep, "sisis", $title, $price, $desc, $categ_id, $product_id);
            mysqli_stmt_execute($prep);
        }
        $nickname = $_SESSION["nickname"];
        header("Location:$BASE_URL/profile.php?nickname=$nickname");
    }
    else{   
        header("Location:$BASE_URL/edit-product.php?error=5&id=$product_id");
    }