<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<div style="height: 400px; width: 100%; border: #000 solid 0px;">

<div style="width:500px; height: 100px; margin:60px auto 10px; border: #000 solid 0px;"">

    <?
    deb::dump(User::getNext_service_user_id());
    //deb::dump(Yii::app()->user->getRole());
    //deb::dump(Yii::app()->user);
    ?>


</div>