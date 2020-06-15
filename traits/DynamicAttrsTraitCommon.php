<?php

namespace app\traits;

use app\models\test\Attr;
use app\models\test\AttrValue;
use app\models\test\Entity;
use yii\db\Exception;

/**
 * Работа с динамическими атрибутами в БД
 * Trait DynamicAttrsTraitCommon
 * @package app\traits
 */
trait DynamicAttrsTraitCommon
{
    /**
     * Динамические атрибуты
     * @var array
     */
    public $dynamicAttrs = [];

    /**
     * Создание динамических атрибутов в БД
     * @throws \Exception
     */
    public function createAttrs()
    {
        if (count($this->dynamicAttrs) > 0) {
            foreach ($this->dynamicAttrs as $group => $attrs) {
                if (isset($attrs[0])) {
                    foreach ($attrs as $attr) {
                        $this->saveAttrs($attr, $group);
                    }
                } else {
                    $this->saveAttrs($attrs, $group);
                }
            }
        }
    }

    /**
     * Сохранение атрибутов
     * @param $attrs
     * @param $group
     * @throws \Exception
     */
    private function saveAttrs($attrs, $group)
    {
        foreach ($attrs as $code => $value) {
            if (!Attr::find()->where(['code' => $code, 'group' => $group])->exists()) {
                $attr = new Attr();
                $attr->group = $group;
                $attr->code = $code;
                if (!$attr->save()) {
                    throw new Exception('Ошибка в сохранении атрибута '.$code);
                }
            } else {
                $attr = Attr::findOne(['code' => $code, 'group' => $group]);
            }

            if ($this instanceof Entity) {
                $uuid = $this->uuid;
            } else {
                $uuid = $this->owner->uuid;
            }

            $attrValue = new AttrValue();
            $attrValue->entity_uuid = $uuid;
            $attrValue->attr_id = $attr->id;
            $attrValue->value = $value;
            if (!$attrValue->save()) {
                throw new Exception('Ошибка в сохранении значения атрибута '.$code);
            }
        }
    }
}
