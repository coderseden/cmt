<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 Comments Extension</h1>
    <br>
</p>

This module provides a comments managing system.

[![Latest Stable Version](https://poser.pugx.org/coderseden/cmt/v/stable)](https://packagist.org/packages/coderseden/cmt) 
[![Total Downloads](https://poser.pugx.org/coderseden/cmt/downloads)](https://packagist.org/packages/coderseden/cmt) 
[![License](https://poser.pugx.org/coderseden/cmt/license)](https://packagist.org/packages/coderseden/cmt)
[![Build Status](https://travis-ci.org/coderseden/cmt.svg?branch=master)](https://travis-ci.org/coderseden/cmt)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/coderseden/cmt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/coderseden/cmt/?branch=master)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist coderseden/cmt "*"
```

or add

```
"coderseden/cmt": "*"
```

to the require section of your composer.json.


Configuration
-----------------------

**Database Migrations**

Before using Comments Widget, we'll also need to prepare the database.
```php
php yii migrate --migrationPath=@vendor/coderseden/cmt/migrations
```

**Module setup**

To access the module, you need to add the following code to your application configuration:
```php
'modules' => [
    'comment' => [
        'class' => 'coderseden\cmt\Module',
    ],
]
```
>**NOTE:** Module id must be `comment` and not otherwise. This is because it is referred [somewhere](https://github.com/coderseden/cmt/blob/master/traits/ModuleTrait.php#L20) in the code with such name. A PR to fix it to use configured module id is welcome.

Now you can access to management section through the following URL:
http://localhost/path/to/index.php?r=comments/index

> By default only users with `admin` role have access to comments management section. But, you can override `accessControlConfig` property for ManageController.

**Notes:**
> 1) Delete button visible only for users with `admin` role.

> 2) When you delete a comment, all nested comments will be marked as `deleted`.

> 3) You can override default CommentModel class by changing the property `commentModelClass` in the Comment Module.

> 4) You can implement your own methods `getAvatar` and `getUsername` in the `userIdentityClass`. Just create this methods in your User model. For example:

```php

public function getAvatar()
{
    // your custom code
}

public function getUsername()
{
    // your custom code
}

```

Usage
-------------------
**Basic example:**
```php
// the model to which are added comments, for example:
$model = Post::find()->where(['title' => 'some post title'])->one();

<?php echo \coderseden\cmt\widgets\Comment::widget([
    'model' => $model,
]); ?>
```

**You can use your own template for render comments:**

  ```php
<?php echo \coderseden\cmt\widgets\Comment::widget([
    'model' => $model,
    'commentView' => '@app/views/site/comments/index' // path to your template
]); ?>
  ```
  
**Use the following code for multiple widgets on the same page:**
  ```php
<?php echo \coderseden\cmt\widgets\Comment::widget([
        'model' => $model,
]); ?>

<?php echo \coderseden\cmt\widgets\Comment::widget([
        'model' => $model2,
        'formId' => 'comment-form2',
        'pjaxContainerId' => 'unique-pjax-container-id'
]); ?>
  ```
  
**To enable the pagination for comments list use the following code:**
```php
<?php echo \coderseden\cmt\widgets\Comment::widget([
      'model' => $model,
      'dataProviderConfig' => [
          'pagination' => [
              'pageSize' => 10
          ],
      ]
]); ?>
```

**Advanced example:**
```php
<?php echo \coderseden\cmt\widgets\Comment::widget([
      'model' => $model,
      'relatedTo' => 'User ' . \Yii::$app->user->identity->username . ' commented on the page ' . \yii\helpers\Url::current(),
      'maxLevel' => 2,
      'dataProviderConfig' => [
          'pagination' => [
              'pageSize' => 10
          ],
      ],
      'listViewConfig' => [
          'emptyText' => Yii::t('app', 'No comments found.'),
      ],
]); ?>
```

## Using Events

You may use the following events:

```php
'modules' => [
    'comment' => [
        'class' => 'coderseden\cmt\Module',
        'controllerMap' => [
            'default' => [
                'class' => 'coderseden\cmt\controllers\DefaultController',
                'on beforeCreate' => function ($event) {
                    $event->getCommentModel();
                    // your custom code
                },
                'on afterCreate' => function ($event) {
                    $event->getCommentModel();
                    // your custom code
                },
                'on beforeDelete' => function ($event) {
                    $event->getCommentModel();
                    // your custom code
                },
                'on afterDelete' => function ($event) {
                    $event->getCommentModel();
                    // your custom code
                },
            ]
        ]
    ]
]
```

## Using Comment Plugin Events

```js
$(document).on('beforeCreate', '#comment-form', function (e) {
    if (!confirm("Everything is correct. Submit?")) {
        return false;
    }
    return true;
});
```

Available events are:

* beforeCreate
* afterCreate
* beforeDelete
* afterDelete
* beforeReply
* afterReply

## Internationalization

All text and messages introduced in this extension are translatable under category 'yii2mod.comments'.
You may use translations provided within this extension, using following application configuration:

```php
return [
    'components' => [
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
                // ...
            ],
        ],
        // ...
    ],
    // ...
];
```

  
#### Example comments
-----
![Alt text](http://res.cloudinary.com/zfort/image/upload/v1467214676/comments-preview.png "Example comments")
