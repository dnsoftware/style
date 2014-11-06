<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);


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



<div id="markeredit" >
    <div style="float: right; " onclick="hideMarkerEdit();" >X</div>
    <div style="clear: both; margin-left: 10px;">

        <div id="markeredit_error"></div>

        <div class="form">
            <?php
            echo CHtml::beginForm();
            ?>

            <div class="row">
                <?php echo CHtml::activeLabel($tagmodel,'id'); ?>
                <?php echo CHtml::activeTextField($tagmodel,'id'); ?>
            </div>

            <div class="row">
                <input id="lookphotos_id" type="text" name="Looktags[p_id]" value="">
            </div>

            <div class="row">
                <?php echo CHtml::activeLabel($tagmodel,'name'); ?>
                <?php echo CHtml::activeTextField($tagmodel,'name'); ?>
            </div>
            <?
            // Второй параметр пуст, значит отсылаем данные на тот же URL.
            // Третий параметр задаёт опции запроса. Подробнее с ними можно
            // ознакомиться в документации jQuery.
            echo CHtml::ajaxSubmitButton('Обработать', $this->createUrl('/userlookset/lookset/savetag'), array(
                    'type' => 'POST',
                    'dataType' => 'json',

                    'success' => 'function(res)
                                  {
                                  console.log(res);
                                      if (res["status"] == "error")
                                      {
                                            for( index in res["data"] ) {
                                                $("#markeredit_error").append("<div>"+res["data"][index]+"</div>");
                                            };

                                      }
                                  }',
                    'error' => 'function(text)
                                  {
                                     alert("error");
                                  }',
                ),
                array(
                    // Меняем тип элемента на submit, чтобы у пользователей
                    // с отключенным JavaScript всё было хорошо.
                    'type' => 'submit',
                ));

            echo CHtml::endForm();?>

        </div>

    </div>

</div>

