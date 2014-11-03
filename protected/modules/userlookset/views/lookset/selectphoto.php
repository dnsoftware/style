<?php
/**
 * Created by PhpStorm.
 * User: daemon
 * Date: 01.11.14
 * Time: 23:32
 */
?>
<style>
.lookmarker
{
    height: 12px;
    width: 12px;
    position: absolute;
    top: 24px;
    left: 100px;
    text-indent: -9999px;
    border-radius: 50%;
    border: 2px solid #FFF;
    background-color: #E92E7D;
    box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.41);
    cursor: pointer;
}

.editimage
{
    position: relative;
}

.markeredit
{
    position: absolute;
    width: 150px;
    height: 300px;
    background-color: #666666;
}

</style>

<div class="editimage">
<img width="<?= Lookphotos::$markedImageWidth;?>" src="<?= $params['imgurl'];?>">
</div>

<script language="javascript">
    var markerTemplate = '<span class="lookmarker"></span>';
    var markerEditTemplate = '<div class="markeredit"></div>';

    $('.editimage').on('click', function (e) {
        xclick = e.pageX-$(this).offset().left;
        yclick = e.pageY-$(this).offset().top;
        xmarker = xclick-7;
        ymarker = yclick-7;
        console.log(e);
        var lookmarker = $(markerTemplate);
        lookmarker.css("left", xmarker);
        lookmarker.css("top", ymarker);

        var markeredit = $(markerEditTemplate);
        markeredit.css("left", xclick+10);
        markeredit.css("top", yclick-10);

        lookmarker.draggable({
            drag:function(event, ui){
            //console.log(ui.position.left);
            },
            stop:function(event, ui){
                console.log(ui.position.left);
            }
        });

        lookmarker.on('click', function (e) {
//            e.preventDefault();

            //markeredit.dialog({modal:true });
            //markeredit.css('display', 'none');
        });


        $('.editimage').append(lookmarker);
        $('.editimage').append(markeredit);



    });





</script>