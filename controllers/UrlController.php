<?php

namespace app\controllers;

use yii\helpers\Url;
use app\models\Click;;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\Url as UrlModel;

class UrlController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index.twig');
    }

    public function actionShorten(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $url = Yii::$app->request->post('url');

        if (empty($url)) {
            return ['error' => 'URL parameter is required'];
             throw new \yii\web\BadRequestHttpException('URL parameter is required');
        }

        $model = UrlModel::findOrCreateByOriginal($url);

        return ['shortUrl' => Url::to(['/url/redirect', 'code' => $model->short_code], true)];
    }

    public function actionRedirect($code): Response
    {
        $model = UrlModel::findOne(['short_code' => $code]);
        if (!$model) throw new NotFoundHttpException();

        $userAgent = Yii::$app->request->userAgent;
        $response = file_get_contents("http://qnits.net/api/checkUserAgent?userAgent=" . urlencode($userAgent));
        $isBot = json_decode($response, true)['isBot'] ?? true;

        if (!$isBot) {
            $click = new Click();
            $click->url_id = $model->id;
            $click->created_at = new Expression('NOW()');
            $click->user_agent = $userAgent;
            $click->save();
        }

        return $this->redirect($model->original_url);
    }
}
