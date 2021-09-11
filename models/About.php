<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property string $content
 * @property integer $criado_em
 * @property integer $alterado_em
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'criado_em', 'alterado_em'], 'required'],
            [['content'], 'string'],
            [['criado_em', 'alterado_em'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'criado_em' => 'Created At',
            'alterado_em' => 'Updated At',
        ];
    }
}
