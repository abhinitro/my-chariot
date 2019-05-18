<?php
if (! empty($categories)) {
    foreach ($categories as $category) {
        $subcatetories = $category->getSubCategoriesList($category->id);
        if (empty($subcatetories)) {
            
            ?>
<li><a
	href="<?= \yii\helpers\Url::toRoute(['/product/list','category'=>$category->slug])  ?>"><?=$category->title?></a></li>


<?php } else { ?>


<li class="dropdown mega-dropdown"><a class="dropdown-toggle"
	data-toggle="dropdown" aria-expanded="true"> <?=$category->title?> </a>
	<div class="custom-menu">
		<div class="row">
		
			<?php
            
            foreach ($subcatetories as $sub) {
                
                $categorylist = $sub->getsubCategories($sub);
                ?>
                    <div class="col-md-4">
                        <ul class="list-links">
                            <li>
                                <h3 class="list-links-title"><a href="<?= \yii\helpers\Url::toRoute(['/product/list','category'=>$category->slug,'subCategory'=>$sub->slug]) ?>"><?=$sub->title?></h3></a>
                            </li>
                            <?php
                if (! empty($categorylist)) {
                    foreach ($categorylist as $list) {
                        ?>
                            <li><a
						href="<?= \yii\helpers\Url::toRoute(['/product/list','category'=>$category->slug,'subCategory'=>$list->slug])  ?>"><?php echo $list->title?></a></li>

                                   <?php
                    }
                }
                ?>
                        </ul>
				<hr class="hidden-md hidden-lg">
			</div>
			

                <?php }?>
		
		
			<!-- <div class="col-md-4">
				<ul class="list-links">
					<li>
						<h3 class="list-links-title">Categories</h3>
					</li>
					<li><a href="#">Women’s Clothing</a></li>
					<li><a href="#">Men’s Clothing</a></li>
					<li><a href="#">Phones & Accessories</a></li>
					<li><a href="#">Jewelry & Watches</a></li>
					<li><a href="#">Bags & Shoes</a></li>
				</ul>
				<hr class="hidden-md hidden-lg">
			</div> -->


		</div>

	</div></li>



<?php
        }
    }
}
?>
