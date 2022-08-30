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
				<h2>new product</h2>
			</div>
			<!-- enctype нужен для того чтобы отправлять данные вместе с картинкой (отправляет файл) -->
			<form class="form-newProd" method="POST" action="api/products/add.php" enctype="multipart/form-data">
				
                <fieldset class="fieldset">
                    <input class="input" type="text" name="title" placeholder="Product Name">
                </fieldset>

                <fieldset class="fieldset">
                    <select name="category_id" id="" class="input">
                        <?php 
                            $categories = mysqli_query($con, "SELECT * FROM categories");
                            if(mysqli_num_rows($categories) > 0){
                                while($categ = mysqli_fetch_assoc($categories)){
                        ?>
                            <option value="<?=$categ["id"]?>"><?= $categ["name"]?></option>
                        <?php
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
                    <input class="input" type="number" name="price" placeholder="Price">
                </fieldset>

                <fieldset class="fieldset">
                    <textarea class="input input-textarea" name="description" id="" cols="30" rows="10" placeholder="Описание"></textarea>
                </fieldset>
                
                <fieldset class="fieldset">
                    <button class="button buttonStyle" type="submit">Save</button>
                </fieldset>
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