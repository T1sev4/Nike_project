<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <?php 
        include "views/head.php"; 
        include "config/baseurl.php";
    ?>

</head>
<body data-baseurl="<?=$BASE_URL?>">
    <?php 
        include "views/header.php"; 
        if(isset($_SESSION["id"])){
            $id = $_SESSION["id"];
        }
    ?>
    
    <div class="profile-title container">
        <?php 
            $user_info = mysqli_query($con, "SELECT * FROM users WHERE id ='$id'");
            if(mysqli_num_rows($user_info) > 0){
                $user = mysqli_fetch_assoc($user_info); 
            
        ?>
        <div class="profile-img">
            <img src="images/avatar-icon.png" alt="">
        </div>
        <div class="profile-text">
            <h1><?=$user["first_name"]?> <?=$user["last_name"]?></h1>
            <p>Nike member</p>
        </div>
    </div>

    <?php } ?>
    <?php 
        if($id == 4){
    ?>
    <div class="profile-button container">
        <a href="<?=$BASE_URL?>/newProduct.php" class="newProdBtn">New product</a>
    </div>

    <div class="profile-product container">
        <div class="product-title">
            <h2 class="titleSection">Your products</h2>
        </div>

        <div class="product-block">
            
        </div>

    </div>

    <?php }else{?>
    
    <div class="profile-fav container">
        <div class="fav-title">
            <h2 class="titleSection">Favorites</h2>
        </div>
        <div class="product-fav">
            
        </div>
    </div>
    <?php }?>



    <?php include "views/footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <script src="js/profile.js"></script>
    <script src = "js/favorites.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="slick/slick.min.js"></script>
    <script src="js/slider.js"></script>
</body>
</html>