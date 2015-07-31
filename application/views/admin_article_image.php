<!DOCTYPE HTML>
<html>
<head>
<title>裁切头图</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link type="text/css" href="<?php echo base_url('minify/?b=static/css&f=admincp.css,dialog.css'); ?>" rel="stylesheet" />
<style type="text/css">
#crop-image{background:#FFF; margin:10px}
</style>
<script type="text/javascript" src="http://weinan.fun-x.cn/minify/?b=static/scripts&amp;f=jquery.min.js,jquery.dialog.js,jquery.select.js,jquery.crop.js,admincp.js"></script>
<script type="text/javascript">
$(function() {

    var aid     = art.dialog.data('aid');
    var path    = art.dialog.data('path');
    var image   = new Image();
    
    $(image).load(function() {
        
        var html  = '<img src="' + path + '?' + Math.random() + '" id="crop-image" />';
            html += '<input type="hidden" id="aid" name="aid" value="' + aid + '" />';
            html += '<input type="hidden" id="path" name="path" value="' + path + '"  />';
            html += '<input type="hidden" id="x" name="x" />';
            html += '<input type="hidden" id="y" name="y" />';
            html += '<input type="hidden" id="w" name="w" />';
            html += '<input type="hidden" id="h" name="h" />';
        
        $('#cropimage').html(html);

        $('#crop-image').imgAreaSelect({
            x1: 0,
            y1: 0,
            x2: 400,
            y2: 300,
            minWidth: 400,
            minHeight: 300,
            handles: true,
            aspectRatio: '4:3',
            onSelectChange: preview
        });
    }) .error( function() { } ) .attr('src', path);
    
    function preview(img, selection) {
        if ( selection.width && selection.height ) {
            $('#x').val(selection.x1);
            $('#y').val(selection.y1);
            $('#w').val(selection.width);
            $('#h').val(selection.height);
        }
    }

});
</script>
</head>
<body>
<form id="cropimage" method="post" action="<?php echo admin_site_url('article/crop_image_action'); ?>"></form>
</body>
</html>