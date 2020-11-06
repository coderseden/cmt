<?php

namespace yii2mod\comments\behaviors;

use Yii;
use yii\db\BaseActiveRecord;

class BlameableBehavior extends \yii\behaviors\BlameableBehavior
{
	/**
	 * {@inheritdoc}
	 *
	 * In case, when the [[value]] property is `null`, the value of [[defaultValue]] will be used as the value.
	 */
	protected function getValue($event)
	{
		if ($this->value === null && Yii::$app->has('customer')) {
			$userId = Yii::$app->get('customer')->id;
			if ($userId === null) {
				return $this->getDefaultValue($event);
			}

			return $userId;
		} elseif ($this->value === null) {
			return $this->getDefaultValue($event);
		}

		return parent::getValue($event);
	}
}
