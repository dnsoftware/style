<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $tagmodel = new Looktags;

        $this->render('index', array('tagmodel'=>$tagmodel));
	}
}