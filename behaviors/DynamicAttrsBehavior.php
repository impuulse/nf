<?php

namespace app\behaviors;

use app\traits\DynamicAttrsTraitCommon;
use yii\base\Behavior;

/**
 * Поведение для работы с динамическими атрибутами
 * Class DynamicAttrsBehavior
 * @package app\behaviors
 */
class DynamicAttrsBehavior extends Behavior
{
    use DynamicAttrsTraitCommon;

    public function canSetProperty($attribute, $checkVars = true)
    {
        return !in_array($attribute, array_keys($this->owner->getAttributes()));
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return mixed|void
     * @throws \yii\base\UnknownPropertyException
     */
    public function __set($attribute, $value)
    {
        if (!in_array($attribute, array_keys($this->owner->getAttributes()))) {
            return $this->dynamicAttrs[$attribute] = $value;
        }

        return parent::__set($attribute, $value);
    }

    /**
     * @param string $attribute
     * @return mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($attribute)
    {
        if (in_array($attribute, array_keys($this->dynamicAttrs))) {
            return $this->dynamicAttrs[$attribute];
        }

        return parent::__get($attribute);
    }
}
