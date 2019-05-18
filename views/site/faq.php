<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<section ng-controller="FaqController" class="flat-row flat-accordion">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="accordion">
					<div class="title">
						<h3>Answers to Your Questions</h3>
					</div>



<?php
Pjax::begin(['enablePushState' => false]) ;
echo ListView::widget ( [ 
		'dataProvider' => $dataProvider,
		'itemView' => '_faq' 
] );
Pjax::end() ;
?>
					<!-- /.accordion-toggle -->
				</div>
				<!-- /.accordion -->
			</div>
			<!-- /.col-md-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>
<!-- /.flat-accordion -->
