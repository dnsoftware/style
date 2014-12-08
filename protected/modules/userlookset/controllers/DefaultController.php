<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $tagmodel = new Looktags;
        $pc_model = new Photocolormap;

        $clothtype_emptymodel = new Clothtype;
        $clothtype_model = Clothtype::model()->findAll(array('order'=>'name ASC'));
        $clothtype_spr = CHtml::listData($clothtype_model, 'id', 'name');
        $clothtype_spr = array_merge(array('0'=>'Выберите'),$clothtype_spr);

        $autocompleteConfig = array(
            'model'=>$clothtype_emptymodel, // модель
            'attribute'=>'name', // атрибут модели
            // "источник" данных для выборки
            // может быть url, который возвращает JSON, массив
            // или функция JS('js: alert("Hello!");')
            'source' =>Yii::app()->createUrl('/userlookset/lookset/clothtypeautocomp'),
            // параметры, подробнее можно посмотреть на сайте
            // http://jqueryui.com/demos/autocomplete/
            'options'=>array(
                // минимальное кол-во символов, после которого начнется поиск
                'minLength'=>'2',
                'showAnim'=>'fold',
                // обработчик события, выбор пункта из списка
                'select' =>'js: function(event, ui) {
                    // действие по умолчанию, значение текстового поля
                    // устанавливается в значение выбранного пункта
                    this.value = ui.item.value;
                    // устанавливаем значения скрытого поля
                    $("#ct2_id").val(ui.item.id);
                    return false;
                }',

                'response' => 'js: function( event, ui ) {
                    $("#ct2_id").val(0);

                    /*console.log(ui.content.length);
                    if (ui.content.length == 0)
                    {
                        $("#ct2_id").val(0);
                    }
                    */
                }
                ',
            ),
            'htmlOptions' => array(
                'maxlength'=>50,
            ),
        );


        $this->render('index', array('tagmodel'=>$tagmodel, 'clothtype_spr'=>$clothtype_spr,
                        'autocompleteConfig'=>$autocompleteConfig, 'pc_model'=>$pc_model));
	}
}