<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Brand */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* $this->title = Yii::t('app', 'Index'); */
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Brands'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Index');

?>
<div class="page-wrapper">
	<div class="wrapper">
		<div class="user-index">
			<div class=" panel ">

				<div class="brand-index">

<?=  \app\components\PageHeader::widget(); ?>

  </div>

			</div>

			
			<div class="panel panel-margin">
				<div class="panel-body">
					<div class="content-section clearfix">
						<header class="panel-heading head-border">   <?php echo strtoupper(Yii::$app->controller->action->id); ?> </header>
		<?php echo $this->render('_grid', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]); ?>
</div>
				</div>
			</div>
		</div>
	</div>
</div>
