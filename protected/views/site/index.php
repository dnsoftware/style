<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<div style="height: 400px; width: 100%; border: #000 solid 0px;">

<div style="width:500px; height: 100px; margin:60px auto 10px; border: #000 solid 0px;"">

    <?
    $gallery = new Gallery();
    $gallery = $gallery->findByPk(1);

    // render widget in view
    $this->widget('GalleryManager', array(
        'gallery' => $gallery,
        'controllerRoute' => '/gallery', //route to gallery controller
    ));
    ?>


</div>