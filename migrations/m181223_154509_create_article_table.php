<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m181223_154509_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
			'title' => $this->string(),
			'description' => $this->text(),
			'content' => $this->text(),
			'date' => $this->date(),
			'image' => $this->string(),
			'viewid' => $this->integer(),
			'user_id' => $this->integer(),
			'status' => $this->integer(),
			'category_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
    }
}
