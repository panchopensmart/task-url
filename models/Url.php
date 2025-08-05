<?php
namespace app\models;

use Yii;

class Url extends \yii\db\ActiveRecord {
    public static function tableName()
    {
        return '{{%url}}';
    }

    public static function findOrCreateByOriginal($originalUrl)
    {
        if (empty($originalUrl)) {
            throw new \InvalidArgumentException('Original URL cannot be empty');
        }

        $model = static::findOne(['original_url' => $originalUrl]);
        if ($model === null) {
            $model = new static();
            $model->original_url = $originalUrl;
            $model->short_code = Yii::$app->security->generateRandomString(5);
            $model->save();
        }
        return $model;
    }
}