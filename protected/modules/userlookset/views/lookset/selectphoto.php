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
    opacity: 0.1;
    display: none;
    left: 0px;
    top: 0px;
}


</style>

<div class="editimage">
<img photoid="<?= $model->id;?>" width="<?= Lookphotos::$markedImageWidth;?>" src="<?= $params['imgurl'];?>">
<div id="bg_layer"></div>
</div>



<script language="javascript">
    $('#lookphotos_id').attr('value', $('img[photoid]').attr('photoid'));


    var markerTemplate = '<span class="lookmarker"></span>';

    $('#bg_layer').offset().left = $('.editimage').offset().left;
    $('#bg_layer').offset().top = $('.editimage').offset().top;

    $('#bg_layer').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    $('.editimage').on('click', function (e) {
        xabs = $(this).offset().left;
        yabs = $(this).offset().top;
        xclick = e.pageX-xabs;
        yclick = e.pageY-yabs;
        xmarker = xclick-7;
        ymarker = yclick-7;
        console.log(e);
        var lookmarker = $(markerTemplate);
        lookmarker.css("left", xmarker);
        lookmarker.css("top", ymarker);

        $('#markeredit').css('display', 'block');
        //lookmarker.css('z-index', $('#bg_layer').css('z-index')+1);
        $('#bg_layer').show();

        $('#markeredit').css("left", e.pageX+14);
        $('#markeredit').css("top", e.pageY-14);

        lookmarker.draggable({
            drag:function(event, ui){
                $('#markeredit').css("left", lookmarker.offset().left+21);
                $('#markeredit').css("top", lookmarker.offset().top-7);
            },
            stop:function(event, ui){
                $('#markeredit').css("left", lookmarker.offset().left+21);
                $('#markeredit').css("top", lookmarker.offset().top-7);
            },
            containment:"parent"
        });

        lookmarker.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            //lookmarker.css('z-index', $('#bg_layer').css('z-index')+1);
            $('#markeredit').css("left", e.pageX+14);
            $('#markeredit').css("top", e.pageY-14);

            $('#markeredit, #bg_layer').show();
        });

        $('.editimage').append(lookmarker);

    });


    function hideMarkerEdit()
    {
        $('#markeredit').hide();
        $('#bg_layer').hide();
    }




</script>