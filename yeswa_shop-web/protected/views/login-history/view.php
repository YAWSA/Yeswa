<?php

use yii\helpers\Html;
use app\components\useraction\UserAction;
use app\modules\comment\widgets\CommentsWidget;

/* @var $this yii\web\View */
/* @var $model app\models\LoginHistory */

/*$this->title =  $model->label() .' : ' . $model->id; */
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Login Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = (string)$model;
?>

<div class="wrapper">
	<div class=" panel ">

		<div
			class="login-history-view panel-body">
			<?php echo  \app\components\PageHeader::widget(['model'=>$model]); ?>



		</div>
	</div>

	<div class=" panel ">
		<div class=" panel-body ">
    <?php echo \app\components\TDetailView::widget([
    	'id'	=> 'login-history-detail-view',
        'model' => $model,
        'options'=>['class'=>'table table-bordered'],
        'attributes' => [
            'id',
            [
			'attribute' => 'user_id',
			'format'=>'raw',
			'value' => $model->getRelatedDataLink('user_id'),
			],
            'user_ip',
            'user_agent',
           
            [
                'label' => 'failure Reason',
                'format'=>'raw',
                'value' =>  $model->failer_reason,],
            
            [
			'attribute' => 'state_id',
			'format'=>'raw',
			'value' => $model->getStateBadge(),],
            [
			'attribute' => 'type_id',
			'value' => $model->getType(),
			],
            'code',
            'created_on:datetime',
        ],
    ]) ?>


<?php  ?>

 			<div>

		</div>
		</div>
	</div>

	
</div>