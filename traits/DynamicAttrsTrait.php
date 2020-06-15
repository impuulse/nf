<?php

namespace app\traits;

/**
 * Для работы с динамическими атрибутами
 * Trait DynamicAttrsTrait
 * @package app\traits
 */
trait DynamicAttrsTrait
{
    use DynamicAttrsTraitCommon;

    /**
     * @param $attribute
     * @return mixed|null
     */
    public function __get($attribute)
    {
        if (in_array($attribute, array_keys($this->dynamicAttrs))) {
            return $this->dynamicAttrs[$attribute];
        }

        return parent::__get($attribute);
    }

    /**
     * @param $attribute
     * @param $value
     */
    public function __set($attribute, $value)
    {
        if (!in_array($attribute, array_keys($this->getAttributes()))) {
            return $this->dynamicAttrs[$attribute] = $value;
        }

        return parent::__set($attribute, $value);
    }
}
