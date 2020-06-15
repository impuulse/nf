<?php

namespace app\controllers;

use app\models\test\BehaviorExampleEntity;
use app\models\test\Entity;
use app\models\test\TraitExampleEntity;
use yii\db\Exception;
use yii\web\Controller;

/**
 * Реализация примеров использования модели с behavior и trait с хранением массива в атрибутах
 * Class TestController
 * @package app\controllers
 */
class TestController extends Controller
{
    /**
     * Пример создания динамических атрибутов
     * @param string $type
     * @param string $dataType
     * @throws \Exception
     */
    public function actionExample($type = 'trait', $dataType = 'basic')
    {
        if ($dataType === 'basic') {
            $data = \Yii::$app->params['basicDataArray'];
        } else {
            $data = \Yii::$app->params['advancedDataArray'];
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            /** @var $entity TraitExampleEntity | BehaviorExampleEntity */
            $entity = $type === 'trait' ? new TraitExampleEntity() : new BehaviorExampleEntity();
            $entity->cartoon_characters = $data;
            if (!$entity->save()) {
                throw new Exception('Ошибка в создании Entity');
            }
            $entity->createAttrs();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Фильтрация записей по наборам ключ-значение
     */
    public function actionFindByAttrs()
    {
        $attrs = \Yii::$app->params['basicDataArray'];
        $entities = Entity::find()->withAttrs($attrs)->all();
    }
}
