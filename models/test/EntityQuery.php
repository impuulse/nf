<?php

namespace app\models\test;

/**
 * This is the ActiveQuery class for [[Entity]].
 *
 * @see Entity
 */
class EntityQuery extends \yii\db\ActiveQuery
{
    public function withAttrs($attrs)
    {
        if (count($attrs) > 0) {
            $query = $this
                ->innerJoin('attr_value', 'attr_value.entity_uuid = entity.uuid')
                ->innerJoin('attr', 'attr.id = attr_value.attr_id');

            foreach ($attrs as $code => $value) {
                $query->orWhere(['code' => $code, 'value' => $value]);
            }

            return $query;
        }

        return $this;
    }
}
