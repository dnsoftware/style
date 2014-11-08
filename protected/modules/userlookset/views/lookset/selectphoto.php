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
    var marker_counter = 0;
    var markers = {};
    var editimage_width = $('.editimage').width();
    var editimage_height = $('.editimage').height();

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

        clearMarkeredit();


        lookmarkConstructor(xmarker, ymarker, e);



    });


    // если e=null - значит идет загрузка данных из базы, иначе - создание маркера по клику
    function lookmarkConstructor(xmarker, ymarker, e=null, str_data=null)
    {
        xmarker = Math.round(xmarker);
        ymarker = Math.round(ymarker);

        marker_counter++;

        var lookmarker = $(markerTemplate);

        markers[marker_counter] = lookmarker;
        lookmarker.data('kod', marker_counter);
        lookmarker.css("left", xmarker);
        lookmarker.css("top", ymarker);

        if (e != null)
        {
            $('#markeredit').data('lookmarker_kod', marker_counter);
            $('#markeredit').show();
            $('#bg_layer').show();
            $('#markeredit').css("left", e.pageX+14);
            $('#markeredit').css("top", e.pageY-14);
        }

        if (str_data != null)
        {
            lookmarker.data('str_data', str_data);
            res = $.parseJSON(str_data);
            if (res["status"] == "ok")
            {
                lookmarker.data('db_id', res["data"]['id']);
            }
        }

        lookmarker.draggable({
            drag:function(event, ui){
                setMarkereditKoords();
            },
            stop:function(event, ui){
                setMarkereditKoords();

                $('#markeredit').data('lookmarker_kod', lookmarker.data('kod'))
                perc_koords = setPercentKoords();
                changeKoords();
            },
            containment:"parent"
        });

        function setMarkereditKoords()
        {
            $('#markeredit').css("left", lookmarker.offset().left+21);
            $('#markeredit').css("top", lookmarker.offset().top-7);
        }

        function changeKoords()
        {
            if (lookmarker.data('db_id') > 0)
            {
                $.ajax({
                    type: 'post',
                    url: '/index.php?r=userlookset/lookset/savetagkoords',
                    data: 'id='+lookmarker.data('db_id')+'&x_koord='+perc_koords['x']+'&y_koord='+perc_koords['y'],
                    success: function(res){
                        //console.log(res);
                        markerDataProvider(res);
                    }
                })
            }
        }

        function setPercentKoords()
        {
            var koords = [];
            koords['x'] = (lookmarker.offset().left - $('.editimage').offset().left)/editimage_width;
            koords['y'] = (lookmarker.offset().top - $('.editimage').offset().top)/editimage_height;
            $('#x_koord').val(koords['x']);
            $('#y_koord').val(koords['y']);

            return koords;
        }

        lookmarker.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            $('#markeredit').css("left", e.pageX+14);
            $('#markeredit').css("top", e.pageY-14);
            $('#markeredit').data('lookmarker_kod', lookmarker.data('kod'));
            markerDataProvider(lookmarker.data('str_data'));
            //            setPercentKoords();
            $('#markeredit, #bg_layer').show();
        });

        $('.editimage').append(lookmarker);
        setPercentKoords();
    }

    <?
    foreach ($lookmarkers as $key => $val)
    {
    ?>
        lookmarkConstructor(editimage_width*<?= $val->x_koord;?>, editimage_height*<?= $val->y_koord;?>, null, '<?= $val->str_data;?>');
    <?
    }
    ?>

</script>