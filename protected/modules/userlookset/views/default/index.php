<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);


?>

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
        //alert($('#markeredit').data('lookmarker_kod'));
        markers[$('#markeredit').data('lookmarker_kod')].remove();
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

        $('#markeredit_form input[type=text]').each( function (number, element) {
                dbfield = element.getAttribute('dbfield');
                if (typeof res["data"][dbfield] !='undefined')
                {
                    element.value = res["data"][dbfield];
                    if (dbfield=='id')
                    {
                        markers[$('#markeredit').data('lookmarker_kod')].data('db_id', res["data"][dbfield]);
                    }
                    //console.log(res["data"][dbfield]);
                }
            }

        );

        //for( index in res["data"] ) {
            //console.log(index);
            //escapeHtml(res["data"][index]);
        //}

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
    <div style="float: right; " onclick="hideMarkerEdit();" >X</div>
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

