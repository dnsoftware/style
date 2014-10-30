<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);



/*
$gallery = new Lookset();
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

$gallery = new Lookset();
$gallery = $gallery->findByPk(2);

// render widget in view
$this->widget('LooksetManager', array(
    'gallery' => $gallery,
    'controllerRoute' => '/userlookset/lookset', //route to gallery controller
));




?>
