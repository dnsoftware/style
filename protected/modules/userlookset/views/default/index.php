<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);


?>

<style>
    #markeredit
    {
        position: absolute;
        width: 250px;
        height: 200px;
        background-color: #fff;
        border: #f00 solid 1px;
        display: block;
        z-index: 120;
        height: auto;
    }

    #bg_layer {
        position: absolute;
        /*z-index: 100;
        */
        width: 100%;
        height: 100%;
        background: #000;
        opacity: 0.01;
        display: none;
        left: 0px;
        top: 0px;
    }

    .lookmarker
    {
        height: 12px;
        width: 12px;
        position: absolute;
        top: 24px;
        left: 100px;
        /*text-indent: -9999px;
        */
        border-radius: 50%;
        border: 2px solid #FFF;
        background-color: #E92E7D;
        box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.41);
        cursor: pointer;
    }

    .editimage
    {
        position: relative;
        border: #ff0000 solid 0px;
        display: inline-block;
    }

</style>

<script language="javascript">

function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function hideMarkerEdit()
{
    $('#markeredit').hide();
    $('#bg_layer').hide();

    if(typeof $('#Looktags_id').val()=='undefined' || $('#Looktags_id').val() == '' || $('#Looktags_id').val() == 0)
    {
        if (typeof $('#markeredit').data('lookmarker_kod') != 'undefined')
        {
            markers[$('#markeredit').data('lookmarker_kod')].remove();
        }
    }

}

function clearMarkeredit()
{
    $('#markeredit input[dbfield=id]').val('');
    $('#markeredit input[dbfield=name]').val('');
}


function markerDataProvider(res_str)
{
    res = $.parseJSON(res_str);
    if (res["status"] == "error")
    {
        $("#markeredit_error").html("");
        for( index in res["data"] ) {
            $("#markeredit_error").append("<div>"+res["data"][index]+"</div>");
        }
    }

    if (res["status"] == "ok")
    {
        markers[$('#markeredit').data('lookmarker_kod')].data('str_data', res_str);

        //$('#markeredit_form input[type=text]').each( function (number, element) {
        $('#markeredit_form [dbfield]').each( function (number, element) {
                dbfield = element.getAttribute('dbfield');
                if (typeof res["data"][dbfield] !='undefined')
                {
                    if($(element).is('input')){
                        element.value = res["data"][dbfield];

                        if (dbfield=='id')
                        {
                            markers[$('#markeredit').data('lookmarker_kod')].data('db_id', res["data"][dbfield]);
                        }
                    }

                    if($(element).is('select')){
                        //console.log("[value='"+res["data"][dbfield]+"']");
                        $(element).find("[value='"+res["data"][dbfield]+"']").attr("selected", "selected");

                    }
                }
            }

        );


    }

}
</script>

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
    <div style="float: right; cursor: pointer; " onclick="hideMarkerEdit();" >X</div>
    <div style="clear: both; margin-left: 10px;">

        <div id="markeredit_error"></div>

        <div id="markeredit_form" class="form">
            <?php
            echo CHtml::beginForm();
            ?>

            <div class="row">
                <?php echo CHtml::activeLabel($tagmodel,'id'); ?>
                <?php echo CHtml::activeTextField($tagmodel,'id', array('dbfield'=>'id')); ?>
            </div>

            <div class="row">
                p_id<br>
                <input id="lookphotos_id" dbfield="p_id" type="text" name="Looktags[p_id]" value="">
            </div>

            <div class="row">
                <?php echo CHtml::activeLabel($tagmodel,'x_koord'); ?>
                <?php echo CHtml::activeTextField($tagmodel,'x_koord', array('id'=>'x_koord', 'dbfield'=>'x_koord')); ?>
            </div>

            <div class="row">
                <?php echo CHtml::activeLabel($tagmodel,'y_koord'); ?>
                <?php echo CHtml::activeTextField($tagmodel,'y_koord', array('id'=>'y_koord', 'dbfield'=>'y_koord')); ?>
            </div>

            <div class="row">
                <?php echo CHtml::activeLabel($tagmodel,'name'); ?>
                <?php echo CHtml::activeTextField($tagmodel,'name', array('dbfield'=>'name')); ?>
            </div>

            <div class="row">
                <?php //echo CHtml::activeLabel($clothtype_model,'ct_id'); ?>
                <?php echo CHtml::activeDropDownList($tagmodel,'ct_id',
                    $clothtype_spr,
                    array(
                        'dbfield'=>'ct_id',
                        'options'=>array(
                                //'4'=>array('selected'=>'selected')
                                )
                         )); ?>
            </div>
            <?
            // Второй параметр пуст, значит отсылаем данные на тот же URL.
            // Третий параметр задаёт опции запроса. Подробнее с ними можно
            // ознакомиться в документации jQuery.
            echo CHtml::ajaxSubmitButton('Обработать', $this->createUrl('/userlookset/lookset/savetag'), array(
                    'type' => 'POST',

                    'success' => 'function(res)
                                  {
                                      markerDataProvider(res);
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

