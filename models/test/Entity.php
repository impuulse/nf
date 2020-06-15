<?php

namespace app\models\test;

use Ramsey\Uuid\Uuid;

/**
 * This is the model class for table "entity".
 *
 * @property string $uuid
 * @property int $id [int(11)]
 */
class Entity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid'], 'string', 'max' => 36],
            [['uuid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EntityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EntityQuery(get_called_class());
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->isNewRecord) {
                $this->uuid = Uuid::uuid4()->toString();
            }

            return true;
        }

        return false;
    }
}
