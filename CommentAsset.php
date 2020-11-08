<?php

namespace coderseden\cmt;

use yii\web\AssetBundle;

/**
 * Class CommentAsset
 *
 * @package coderseden\cmt
 */
class CommentAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/coderseden/cmt/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/comment.js',
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/comment.css',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
    ];
}
