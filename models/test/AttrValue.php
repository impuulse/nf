<?php

namespace app\models\test;

use Yii;

/**
 * This is the model class for table "attr_value".
 *
 * @property int $id
 * @property string $entity_uuid
 * @property int $attr_id
 * @property string $value
 *
 * @property Attr $attr
 */
class AttrValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attr_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_uuid', 'attr_id', 'value'], 'required'],
            [['attr_id'], 'integer'],
            [['entity_uuid'], 'string', 'max' => 36],
            [['value'], 'string', 'max' => 255],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_uuid' => 'Entity Uuid',
            'attr_id' => 'Attr ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Attr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attr::className(), ['id' => 'attr_id']);
    }
}
