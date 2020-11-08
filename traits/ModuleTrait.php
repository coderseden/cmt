<?php

namespace coderseden\cmt\traits;

use Yii;
use coderseden\cmt\Module;

/**
 * Class ModuleTrait
 *
 * @package coderseden\cmt\traits
 */
trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return Yii::$app->getModule('comment');
    }
}
