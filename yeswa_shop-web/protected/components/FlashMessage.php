<?php
namespace app\components;

use Yii;
use app\components\toster\Toastr;
use app\components\notify\PNotify;
use yii\web\JsExpression;

class FlashMessage extends TBaseWidget
{

    // Error supported type ==> error, update, success, warning, info;
    
    // supported type ==> default, dialog, toster, notify;
    public $type = "default";

    public $position = "bottom-left";

    public function run()
    {
        $this->renderHtml();
    }

    public function renderHtml()
    {
        $allMessage = \Yii::$app->session->getAllFlashes();
        if (! empty($allMessage)) {
            switch ($this->type) {
                case "default":
                    
                    foreach ($allMessage as $key => $message) {
                        $msg = $message;
                        
                        if (is_array($message)) {
                            $msg = '';
                            foreach ($message as $name => $value) {
                                $msg .= '{' . $key . '}' . ' ' . $value;
                            }
                        }
                        $class = $this->flashClass($key);
                        ?>
<div class="alert alert-<?= $class ?> alert-dismissable fade in m-t-10">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?= $msg ?>
							</div>
<?php
                    }
                    break;
                case "toster":
                    foreach ($allMessage as $key => $message) {
                        $msg = $message;
                        
                        if (is_array($message)) {
                            $msg = '';
                            foreach ($message as $name => $value) {
                                $msg .= '{' . $key . '}' . ' ' . $value;
                            }
                        }
                        $class = $this->flashClass($key);
                        Toastr::widget([
                            'options' => [
                                "heading" => ucfirst($class),
                                "position" => $this->position,
                                "text" => $msg,
                                "hideAfter" => 3000,
                                // "hideAfter" => false,
                                "icon" => $class
                            ]
                        ]);
                    }
                    break;
                case "notify":
                    foreach ($allMessage as $key => $message) {
                        $msg = $message;
                        
                        if (is_array($message)) {
                            $msg = '';
                            foreach ($message as $name => $value) {
                                $msg .= '{' . $key . '}' . ' ' . $value;
                            }
                        }
                        $class = $this->flashClass($key);
                        PNotify::widget([
                            'pluginOptions' => [
                                'title' => ucfirst($class),
                                'text' => $msg,
                                'type' => $class,
                                
                                /* 'stack' => new JsExpression('stack_top_left'),
                                'addclass' => 'stack-topleft',  */
                                /* 'desktop' => [
                                    'desktop' => true
                                ], */
                            ]
                        ]);
                    }
                    break;
                case "dialog":
                    ?>
<div id="flashMessageDailog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- dialog body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<?php
                    foreach ($allMessage as $key => $message) {
                        $msg = $message;
                        
                        if (is_array($message)) {
                            $msg = '';
                            foreach ($message as $name => $value) {
                                $msg .= '{' . $key . '}' . ' ' . $value;
                            }
                        }
                        $class = $this->flashClass($key);
                        ?>
							<div class="alert alert-<?= $class ?> m-t-20">
								<?= $msg ?>
							</div>
					<?php
                    }
                    ?>
			</div>
		</div>
	</div>
</div>
<?php
                    
                    Yii::$app->controller->getView()->registerJs("
						$('#flashMessageDailog').modal('show');
						setTimeout(function() {
							$('#flashMessageDailog').modal('hide');
						}, 1000);
					");
                    break;
            }
        }
    }

    public function flashClass($key)
    {
        switch ($key) {
            case "error":
                return "danger";
                break;
            case "update":
                return "success";
                break;
            case "success":
                return "success";
                break;
            case "warning":
                return "warning";
                break;
            default:
                return "info";
                break;
        }
    }
}
