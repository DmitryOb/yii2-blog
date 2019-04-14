<?php

use yii\db\Migration;

/**
 * Class m190414_035728_add_date_to_comment
 */
class m190414_035728_add_date_to_comment extends Migration
{
    public function up()
    {
		$this->addColumn('comment', 'date', $this->date());
    }

    public function down()
    {
        $this->$this->dropColumn('comment', 'date');
    }
}
