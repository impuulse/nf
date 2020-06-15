<?php

namespace app\models\test;

use app\behaviors\DynamicAttrsBehavior;

/**
 * Пример модели с behavior
 * Class BehaviorExampleEntity
 * @package app\models\test
 */
class BehaviorExampleEntity extends Entity
{
    /**
     * @return array|string[]
     */
    public function behaviors() : array
    {
        return [
            DynamicAttrsBehavior::class
        ];
    }
}
