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
        'resize' => array(400, null),
    ),
    'big' => array(
        'resize' => array(900, null),
    )
);
$gallery->save();
*/

?>
<div style="float: left;">
<?
$gallery = new Lookset();
$gallery = $gallery->findByPk(3);
$gallery->hasDesc = false;
$gallery->hasName = false;

// render widget in view
$this->widget('LooksetManager', array(
    'gallery' => $gallery,
    'controllerRoute' => '/userlookset/lookset', //route to gallery controller
));

?>
</div>

<div style="float: left; width: 720px; border: #ddd solid 0px;">

    <div id="lookeditor" style="margin-left: 15px; margin-top: 5px;">

    </div>
</div>