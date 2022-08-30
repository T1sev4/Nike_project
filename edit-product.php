<!DOCTYPE html>
<html lang="en">
<head>
    <title>newProduct</title>
    <?php include "views/head.php"; ?>
</head>
<body>
    <?php include "views/header.php"; ?>
    
    <section class="newProdPage container">
		<div class="newProdPage-block">

			<div class="newProdPage-header">
				<h2>edit product</h2>
			</div>
			
			<form class="form-newProd" action="api/products/edit.php" method="POST" enctype="multipart/form-data">
                <?php 
                    $product_id = $_GET["id"];
                    $products_info = mysqli_query($con, "SELECT * FROM products WHERE id = '$product_id'");
                    if(mysqli_num_rows($products_info) > 0){
                        $product_info = mysqli_fetch_assoc($products_info);
                ?>
                <input type="hidden" name="product_id" value="<?=$product_id?>">
                <fieldset class="fieldset">
                    <input class="input" type="text" name="title" placeholder="Product Name" value = "<?=$product_info["title"]?>">
                </fieldset>

                <fieldset class="fieldset">
                    <select name="category_id" id="" class="input">
                        <?php 
                            $categories = mysqli_query($con, "SELECT * FROM categories");
                            if(mysqli_num_rows($categories) > 0){
                                while($categ = mysqli_fetch_assoc($categories)){
                                    if($categ["id"] == $product_info["category_id"]){
                        ?>
                            <option value="<?=$categ["id"]?>" selected><?= $categ["name"]?></option>
                        <?php 
                            }else{
                        ?>
                            <option value="<?=$categ["id"]?>"><?= $categ["name"]?></option>
                        <?php 
                                    }
                                }
                            }
                        ?>
                    </select>
                </fieldset class="fieldset">
                
                <fieldset class="fieldset">
                    <button class="button input-file buttonStyle">
                        <input type="file" name="image">	
                        Choose a picture
                    </button>
                </fieldset>
                    
                <fieldset class="fieldset">
                    <input class="input" type="text" name="price" placeholder="Price" value = "<?= $product_info["price"]?>">
                </fieldset>

                <fieldset class="fieldset">
                    <textarea class="input input-textarea" name="description" id="" cols="30" rows="10" placeholder="Описание"><?=$product_info["description"]?></textarea>
                </fieldset>
                
                <fieldset class="fieldset">
                    <button class="button buttonStyle" type="submit">Save</button>
                </fieldset>
                <?php }?>
			</form>

			
            <?php
                if(isset($_GET["error"])){
            ?>
				<p class="text-danger"> Заголовок и Описание не могут быть пустыми!</p>
            <?php }?>

		</div>

	</section>
	
    <?php include "views/footer.php"; ?>
</body>
</html>