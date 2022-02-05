<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $name_hy
 * @property string|null $name_ru
 * @property string|null $name_en
 * @property int|null $status
 * @property int|null $parent_id
 * @property string|null $created_date
 * @property string|null $updated_date
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'parent_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name_hy', 'name_ru', 'name_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_hy' => 'Name Hy',
            'name_ru' => 'Name Ru',
            'name_en' => 'Name En',
            'status' => 'Status',
            'parent_id' => 'Parent category',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public function categories () {
        return $this::find()->all();
    }
}
