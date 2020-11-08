<?php

namespace coderseden\cmt;

use Yii;

/**
 * Class Module
 *
 * @package coderseden\cmt
 */
class Module extends \yii\base\Module
{
    /**
     * @var string the class name of the [[identity]] object
     */
    public $userIdentityClass;

    /**
     * @var string the class name of the comment model object, by default its coderseden\cmt\models\CommentModel
     */
    public $commentModelClass = 'coderseden\cmt\models\CommentModel';

    /**
     * @var string the namespace that controller classes are in
     */
    public $controllerNamespace = 'coderseden\cmt\controllers';

    /**
     * @var bool when admin can edit comments on frontend
     */
    public $enableInlineEdit = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (null === $this->userIdentityClass) {
            $this->userIdentityClass = Yii::$app->getUser()->identityClass;
        }
    }
}
