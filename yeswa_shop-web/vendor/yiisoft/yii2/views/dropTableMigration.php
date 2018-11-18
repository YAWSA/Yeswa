<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
/* @var $table string the name table */
/* @var $fields array the fields */
echo "<?php\n";
if (! empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use yii\db\Migration;

/**
 * Handles the dropping of table `<?= $table ?>`.
<?=$this->render('_foreignTables', ['foreignKeys' => $foreignKeys])?>
 */
class <?= $className ?> extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
<?=$this->render('_dropTable', ['table' => $table,'foreignKeys' => $foreignKeys])?>
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
<?=$this->render('_createTable', ['table' => $table,'fields' => $fields,'foreignKeys' => $foreignKeys])?>
    }
}
