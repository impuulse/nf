<?php

namespace app\models\test;

use app\traits\DynamicAttrsTrait;

/**
 * Пример модели с trait
 * Class TraitExampleEntity
 * @package app\models\test
 */
class TraitExampleEntity extends Entity
{
    use DynamicAttrsTrait;
}
