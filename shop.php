<?php 
    include "config/db.php";
    $limit = 6;
    $sql = "SELECT p.*, u.first_name, c.name FROM products p INNER JOIN users u ON p.user_id = u.id
	INNER JOIN categories c ON p.category_id = c.id";
    $sql_count = "SELECT CEIL(COUNT(*)/$limit) as total FROM products p INNER JOIN users u ON 
    p.user_id = u.id INNER JOIN categories c ON p.category_id = c.id";

    $category = null;
    if(isset($_GET["category"]) && intval($_GET["category"])){
        $category = $_GET["category"];
        $sql.=" WHERE p.category_id = $category";
        $sql_count.=" WHERE p.category_id = $category";
    }
    $search = null;
    if(isset($_GET["search"])){
        $search_query = $_GET["search"];
        $search = strtolower($_GET["search"]);
        $sql.=" WHERE LOWER(p.title) LIKE '%$search%' OR LOWER(p.description) LIKE '%$search%' OR LOWER(c.name) LIKE '%$search%'";
        $sql_count.=" WHERE LOWER(p.title) LIKE '%$search%' OR LOWER(p.description) LIKE '%$search%' OR LOWER(c.name) LIKE '%$search%'";
    }
    $page = 1;
    if(isset($_GET["page"]) && intval($_GET["page"])){
        $page = $_GET["page"];
        $skip = ($_GET["page"] - 1) * $limit;
        $sql.=" LIMIT $skip, $limit";
    }else{
        $sql.=" LIMIT $limit";
    }
    $products = mysqli_query($con , $sql);
    $counts = mysqli_query($con, $sql_count);
    $count = mysqli_fetch_assoc($counts);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop</title>
    <?php include "views/head.php"; ?>

</head>
<body> 
    <?php 
        include "views/header.php"; 
    ?>
    
    <section class="page container">
        <div class="page-category">
            <div class="category-header">
                <h1>Category</h1>
            </div>
            <div class="category-list">
                <a class = "list-item" href="<?=$BASE_URL?>/shop.php">All</a>
                <?php 
                    $categories = mysqli_query($con, "SELECT * FROM categories");
                    if(mysqli_num_rows($categories) > 0){
                        while($categ = mysqli_fetch_assoc($categories)){
                    
                ?>
                    <a class="list-item" href="<?=$BASE_URL?>/shop.php?category=<?=$categ["id"]?>"><?= $categ["name"]?></a>
                <?php 
                    }
                        }
                ?>
            </div>
        </div>
        <div class="page-content">
            <div class="product-block">
                <?php 
                    if(mysqli_num_rows($products) > 0){
                        while($product = mysqli_fetch_assoc($products)){
                            $product_id = $product["id"]
                ?>
                <div class="product-item">
                    <a href="<?=$BASE_URL?>/product-details.php?id=<?=$product["id"]?>">
                        <img src="<?= $product["image"]?>" alt="">
                    </a>
                    <a href="<?=$BASE_URL?>/product-details.php?id=<?=$product["id"]?>">
                        <h4 class="item-name"><?= $product["title"]?></h4>
                    </a>
                    <p class="item-category"><?= $product["name"]?></p>
                    <span class="item-price">$<?= $product["price"]?></span>
                </div>
                
                <?php 
                        }
                    }else{
                ?>
                <p class = "productZero">0 products</p>
                <?php } ?>
            </div>
            
            <div class="pagination">
                <?php 
                    $cat_str = "";
                    if($category){
                        $cat_str = "&category=$category";
                    }
                    $search_str = "";
                    if($search){
                        $search_str="&search=$search";
                    }
                    if($page != 1 && $count["total"] > 0){
                ?>
                    <a href="<?= $BASE_URL?>/shop.php?page=<?=$page-1?><?=$cat_str?><?=$search_str?>"><</a>
                <?php }?>
                <?php 
                    for($i = 0; $i < $count["total"]; $i++){
                ?>
                <a href="<?= $BASE_URL?>/shop.php?page=<?=$i+1?><?=$cat_str?><?=$search_str?>"><?=$i + 1?></a>
                
                <?php } if($page != $count["total"] && $count["total"] > 0){?>
                    <a href="<?= $BASE_URL?>/shop.php?page=<?=$page + 1?><?=$cat_str?><?=$search_str?>">></a>
                <?php }?>
            </div>
        </div>

    </section>

    <?php include "views/footer.php"; ?>
</body>
</html>