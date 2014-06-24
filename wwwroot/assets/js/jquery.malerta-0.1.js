/*
http://www.mixd.com.br/ 
*/
(function ($) {
	var defaults = {
		close: 'click',
		delay: 2000,
		speed: 400,
		message: 'Defina a mensagem',
		css: 'alert' /* aviso, erro, sucesso*/
	};
    $.fn.mAlerta = function (userOptions) {
		var icon,
			btcss,
			options = $.extend( {}, defaults, userOptions);
			
        return this.each(function () {
			$('#form-alert').remove();
			
			switch(options.css) {
				case 'erro':
					btcss = 'alert-error';
					icon = 'icon-remove';
					break;
				case 'sucesso':
					btcss = 'alert-success';
					icon = 'icon-ok';
					break;
				default:
					btcss = 'alert';
					icon = 'icon-exclamation-sign';
			}
			/*icon = '<img src="'+icon+'">';*/
			icon = '<i class="'+ icon +' f32"></i>';
			$(this).append('<div id="form-alert" class="' + btcss + '">' + icon + ' ' + options.message + '</div>');
			if(options.close == 'click'){
				$('#form-alert').append('<a class="close">&times;</a>');
				$('#form-alert .close').click(function(){
					$('#form-alert').slideUp( options.speed , function () {
						$('#form-alert').remove();
					});
				});
				$('#form-alert').slideDown( options.speed );
			}
			else{
				$('#form-alert').slideDown( options.speed )
	   			.delay(options.close)
	   			.slideUp( options.speed, function () {
	   				$("#form-alert").remove();
	   			});
			}
        });
    };
})(jQuery);