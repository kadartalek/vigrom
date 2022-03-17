<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
// @formatter:off
echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use app\db\Migration;

/**
 * Class <?= $className . "\n" ?>
 */
class <?= $className ?> extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        echo "<?= $className ?> cannot be processed.\n";

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "<?= $className ?> cannot be reverted.\n";

        return false;
    }
}
