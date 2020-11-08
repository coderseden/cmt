<?php

namespace coderseden\cmt\events;

use yii\base\Event;
use coderseden\cmt\models\CommentModel;

/**
 * Class CommentEvent
 *
 * @package coderseden\cmt\events
 */
class CommentEvent extends Event
{
    /**
     * @var CommentModel
     */
    private $_commentModel;

    /**
     * @return CommentModel
     */
    public function getCommentModel()
    {
        return $this->_commentModel;
    }

    /**
     * @param CommentModel $commentModel
     */
    public function setCommentModel(CommentModel $commentModel)
    {
        $this->_commentModel = $commentModel;
    }
}
