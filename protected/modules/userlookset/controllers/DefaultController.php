<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $tagmodel = new Looktags;
        $clothtype_model = Clothtype::model()->findAll(array('order'=>'name ASC'));
        $clothtype_spr = CHtml::listData($clothtype_model, 'id', 'name');
        $clothtype_spr = array_merge(array('0'=>'Выберите'),$clothtype_spr);

        $this->render('index', array('tagmodel'=>$tagmodel, 'clothtype_spr'=>$clothtype_spr));
	}
}