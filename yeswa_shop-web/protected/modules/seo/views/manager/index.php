<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Seo */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* $this->title = Yii::t('app', 'Index');*/
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Index');;
?>
<div class="wrapper">
	<div class="user-index">
		<div class=" panel ">
			<div class=" panel ">
				<div
					class="seo-index">

<?=  \app\components\PageHeader::widget(); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  </div>
			</div>
		</div>
		<div class="panel panel-margin">
			<div class="panel-body">
				<div class="content-section clearfix">
					
		<?php echo $this->render('_grid', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]); ?>
</div>
			</div>
		</div>
	</div>

</div>

