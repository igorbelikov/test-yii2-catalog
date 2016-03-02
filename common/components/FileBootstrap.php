<?php

namespace common\components;

/**
 * Class Bootstrap
 * @package common\components
 * @author Igor Belikov <work.belka@gmail.com>
 */
class FileBootstrap implements \yii\base\BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $app->controllerMap['file'] = 'common\components\FileController';
        }
    }
}