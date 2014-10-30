<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<div style="height: 400px; width: 100%; border: #000 solid 0px;">

<div style="width:500px; height: 100px; margin:60px auto 10px; border: #000 solid 0px;"">

    <?
    /*
    $this->widget('application.extensions.imageAttachment.ImageAttachmentWidget', array(
        'model' => $model,
        'behaviorName' => 'preview',
        'apiRoute' => 'site/saveImageAttachment',
    ));
    */
    /*
    if($model->preview->hasImage())
        echo CHtml::image($model->preview->getUrl('medium'),'Medium image version');
    else
        echo 'no image uploaded';
    */

    /*
    // создание галереи
    $gallery = new Gallery();
    $gallery->name = true;
    $gallery->description = true;
    $gallery->versions = array(
        'small' => array(
            'resize' => array(200, null),
        ),
        'medium' => array(
            'resize' => array(800, null),
        )
    );
    $gallery->save();
    */

    /*
    $gallery = new Gallery();
    $gallery = $gallery->findByPk(1);

    // render widget in view
    $this->widget('GalleryManager', array(
        'gallery' => $gallery,
        'controllerRoute' => '/gallery', //route to gallery controller
    ));
    */

    ?>


</div>