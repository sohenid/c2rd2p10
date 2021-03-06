$(function() {

	$.tools.validator.localize("br", {
		'*'				: 'Preecha corretamente este campo',
		':email'  		: 'E-mail inv&aacute;lido',
		':number' 		: 'Somente n&uacute;meros',
		':url' 			: 'Url inv&aacute;lida',
		'[max]'	 		: 'O valor m&aacute;ximo deve ser $1',
		'[min]'			: 'O valor m&iacute;nimo deve ser $1',
		'[required]'	: 'Preenchimento obrigat&oacute;rio'
	});
	
	$.tools.validator.addEffect('malerta', function(errors, event) {
		var input = errors[0].input;
		input.focus();
		var mensagem = input.attr('title');
		$('body').mAlerta({message: 'Preencha o campo <strong>' + mensagem + '</strong> corretamente.', close: 3000});			
	});			

	$('form.validar').validator({ 
		singleError: 'true',
		effect: 'malerta',
		errorInputEvent: null		
	});

	$('form.validar').attr('novalidate', 'novalidate').prepend('<input type="hidden" name="AcaoComplemento" value="'+Math.floor(Math.random()*100)+'" />');

	
	$('.mask-telefone').focusout(function(){
	    var phone, element;
	    element = $(this);
	    element.unmask();
	    /* removo tudo que não for numeros (\D) */
	    phone = element.val().replace(/\D/g, '');
	    if(phone.length > 10) {
	        element.mask("(99) 99999-999?9");
	    } else {
	        element.mask("(99) 9999-9999?9");
	    }
	}).trigger('focusout');
	$(".mask-data").mask("99/99/9999");
	$(".mask-CEP").mask("99999-999");
	$(".mask-CPF").mask("999.999.999-99");
	$(".mask-hora").mask("99:99");
	$("input, textarea").placeholder();	
	
});
