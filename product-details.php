<?php 
    include "config/db.php";
    include "config/baseurl.php";
    $id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Details</title>
    <?php include "views/head.php"; ?>

</head>
<body data-baseurl="<?=$BASE_URL?>">
    <?php include "views/header.php"; ?>
   
    <div class="product-detail container">
        <div class="detail-block section-padding">
            <?php 
                $products = mysqli_query($con, "SELECT p.*, u.first_name, c.name FROM products p INNER JOIN users u ON p.user_id = u.id INNER JOIN categories c ON p.category_id = c.id WHERE p.id=$id");
                $product = mysqli_fetch_assoc($products);
            ?>
            <div class="detail-img">
                <img src="<?=$product["image"]?>" alt="">
            </div>
            <div class="detail-info">
                <div class="detail-info-header">
                    <h4 class="item-name"><?=$product["title"]?></h4>
                    <p class="item-category"><?=$product["name"]?></p>
                    <span class="item-price">$<?=$product["price"]?></span>
                </div>
                <p class="prodDesc">
                    <?=$product["description"]?>
                </p>
                <?php if(isset($_SESSION["id"])){?>
                <a class="addFav-button detailBtn" href="<?=$BASE_URL?>/profile.php?nickname=<?=$_SESSION["nickname"]?>">
                    Favorite
                    <svg width="24px" height="24px" fill="#111" viewBox="0 0 24 24"><path d="M21.11 4a6.6 6.6 0 0 0-4.79-1.92A6.27 6.27 0 0 0 12 3.84 6.57 6.57 0 0 0 2.89 4c-2.8 2.68-2.45 7.3.88 10.76l6.84 6.63A2 2 0 0 0 12 22a2 2 0 0 0 1.37-.54l.2-.19.61-.57c.6-.57 1.42-1.37 2.49-2.41l2.44-2.39 1.09-1.07c3.38-3.55 3.8-8.1.91-10.83zm-2.35 9.4l-.25.24-.8.79-2.44 2.39c-1 1-1.84 1.79-2.44 2.36L12 20l-6.83-6.68c-2.56-2.66-2.86-6-.88-7.92a4.52 4.52 0 0 1 6.4 0l.09.08a2.12 2.12 0 0 1 .32.3l.9.94.9-.94.28-.27.11-.09a4.52 4.52 0 0 1 6.43 0c1.97 1.9 1.67 5.25-.96 7.98z"></path></svg>
                </a>
                <a href="" class = "detailBtn">
                    Buy
                    <svg width="24px" height="24px" fill="#111" viewBox="0 0 24 24"><path d="M16 7a1 1 0 0 1-1-1V3H9v3a1 1 0 0 1-2 0V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3a1 1 0 0 1-1 1z"></path><path d="M20 5H4a2 2 0 0 0-2 2v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a2 2 0 0 0-2-2zm0 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7h16z"></path></svg>
                </a>
                <?php }else{?>
                <a class="detailBtn" href="<?=$BASE_URL?>/login.php">
                    Favorite
                    <svg width="24px" height="24px" fill="#111" viewBox="0 0 24 24"><path d="M21.11 4a6.6 6.6 0 0 0-4.79-1.92A6.27 6.27 0 0 0 12 3.84 6.57 6.57 0 0 0 2.89 4c-2.8 2.68-2.45 7.3.88 10.76l6.84 6.63A2 2 0 0 0 12 22a2 2 0 0 0 1.37-.54l.2-.19.61-.57c.6-.57 1.42-1.37 2.49-2.41l2.44-2.39 1.09-1.07c3.38-3.55 3.8-8.1.91-10.83zm-2.35 9.4l-.25.24-.8.79-2.44 2.39c-1 1-1.84 1.79-2.44 2.36L12 20l-6.83-6.68c-2.56-2.66-2.86-6-.88-7.92a4.52 4.52 0 0 1 6.4 0l.09.08a2.12 2.12 0 0 1 .32.3l.9.94.9-.94.28-.27.11-.09a4.52 4.52 0 0 1 6.43 0c1.97 1.9 1.67 5.25-.96 7.98z"></path></svg>
                </a>
                <a href="<?=$BASE_URL?>/login.php" class = "detailBtn">
                    Buy
                    <svg width="24px" height="24px" fill="#111" viewBox="0 0 24 24"><path d="M16 7a1 1 0 0 1-1-1V3H9v3a1 1 0 0 1-2 0V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3a1 1 0 0 1-1 1z"></path><path d="M20 5H4a2 2 0 0 0-2 2v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a2 2 0 0 0-2-2zm0 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7h16z"></path></svg>
                </a>
                <?php }?>
            </div>
        </div>
    </div>
    
    <div class="prod-det-comments container">
        <div class="comments">
        </div>
        <?php 
            if(isset($_SESSION["id"])){
        ?>
            <span class="comment-add">
                <textarea name="" class="comment-textarea" placeholder="Введит текст комментария"></textarea>
                <div class="text-button">
                    <button class="add-button buttonStyle">Send</button>
                </div>
            </span>
        <?php }else{?>
            <span class="comment-warning">
                To write a comment <a href="">Register</a> , or  <a href="">Log in</a> to your account.
            </span>
        <?php }?>
    </div>


    <?php include "views/footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <script src="js/comment.js"></script>
</body>
</html>