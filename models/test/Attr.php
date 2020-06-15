<?php

namespace app\models\test;

use Yii;

/**
 * This is the model class for table "attr".
 *
 * @property int $id
 * @property string|null $group
 * @property string $code
 *
 * @property AttrValue[] $attrValues
 */
class Attr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['group', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group' => 'Group',
            'code' => 'Code',
        ];
    }

    /**
     * Gets query for [[AttrValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttrValues()
    {
        return $this->hasMany(AttrValue::className(), ['attr_id' => 'id']);
    }
}
