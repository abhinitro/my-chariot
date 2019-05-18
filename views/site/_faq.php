
					<div class="accordion-toggle">
						<div class="toggle-title" ng-click="toggleFaq(1)"
							ng-class="{active : activeFaq==1}"><?php echo $model->title?></div>
						<div class="toggle-content" ng-show="activeFaq==1">
							<p><?php echo $model->description?></p>
						</div>
						</div>
						