var BASE_URL = 'http://mobile.mixd.com.br/';

var vWindowWidth = $(window).width() - 80;
var vWindowHeight = $(window).height();

$('#menu').css('width', vWindowWidth);
$('#menu').css('height', vWindowHeight);
$("#menu").css('right', vWindowWidth * -1);

//$('#menu').css('display', 'block');

$('#show-hide-menu').click(function() {
    if ($('#show-hide-menu').hasClass('closed')) {
        $('#menu').css('display', 'block');
        $('#show-hide-menu').addClass('open');
        $('#show-hide-menu').removeClass('closed');
        $('body').animate({'right': vWindowWidth, 'left': vWindowWidth * -1}, 500);

    } else {
        $('#show-hide-menu').addClass('closed');
        $('#show-hide-menu').removeClass('open');
        $('body').animate({'right': '0', 'left': '0'}, 500, function() {
            $('#menu').css('display', 'none');
        });
    }
});