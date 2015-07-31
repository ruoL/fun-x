$(function() {
    var sh = $('#sidebar').height();
    var ch = $('#content').height();
    if(ch < sh) {
        $('#content').css('minHeight', sh);
    }
});

function searchAction(ele) {
    var k = $.trim( $('#sput').val() );
    if( (k != '') && (k != '请键入关键字') ) {
        window.location.href = '/search/?k=' + encodeURI(k);
    }
}

function changeFontSize(ele, size, object) {
    $(ele).addClass('d6').siblings('a').removeClass('d6');
    object.children('*').css({
        fontSize: parseInt(size) + 'px',
        lineHeight: (parseInt(size) + 12) + 'px'
    });
}