/**
 * Area Administrativa
 */

$(document).ready(function() {
	/* Set WYSIWYG editor */
	/*
	$('.wysiwyg').wysiwyg({
		css: "/assets/css/bootstrap/jquery.wysiwyg-iframe.css?"+Math.random()
	});
	*/
	$('.wysiwyg').redactor({ 
							 lang: 'pt_br',
							 css: 'bootstrap.css',
							 imageUpload: $('.wysiwyg').attr('data-image-upload'),
							 imageGetJson: $('.wysiwyg').attr('data-image-json')
						  });	

	$('.wysiwyg-compact').redactor({ 
							 lang: 'pt_br',
							 css: 'bootstrap.css',
							 buttons: ['bold', 'italic']
						  });	
						  	
	$('a[rel=tooltip]').tooltip(({html:true}));

	$('input.input-file').filestyle({
		 image: "/assets/img/estrutura/selecionar-arquivo.png",
	     imageheight : 28,
	     imagewidth : 126,
	     width: 130
	});	

	/* validator */
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
	
	$('.validar .control-group.error').find('input').keydown(function (){
		$(this).parents(".control-group").removeClass('error').find('.help-inline').remove();
	})
	/* ******** */
	
	$('.check-all-permissao').click(function() {
		$(this).parents('tr').find('input:checkbox').attr('checked', $(this).is(':checked'));   
	});
	
	if($('.mostra-permissoes').length){
		$('.mostra-permissoes').on('change', function(){
			if($(this).val() == 0){
				$('.table-permissoes').show();
			}
			else{
				$('.table-permissoes').hide().find('input:checkbox').attr('checked', false);
			}
		}).trigger('change');
	}
	
	$('.check-all').click(function() {
		$(this).parents('form').find('input:checkbox').attr('checked', $(this).is(':checked')).trigger('change');   
	});
	
	$('form#formRemover input:checkbox').attr('checked', false);
	$('form#formRemover input:checkbox').change(function() {
		var total = $('form#formRemover input:checkbox:checked');
		if(total.length >= 1){ 
			$('.btn-remover-selecionados').fadeIn(); 
		} 
		else { 
			$('.btn-remover-selecionados').fadeOut();
		}
		
		/**/
		if($(this).is(':checked')){
			$(this).parents('tr').addClass('selecionado');
		}
		else{
			$(this).parents('tr').removeClass('selecionado');
		}
	});
	
	$('form#formRemover tbody tr td').not('td.sem-clique').click(function(){
		var checkbox = $(this).parents('tr').find('input:checkbox');
		var checked = (checkbox.is(':checked')) ? false : true;
		checkbox.attr('checked', checked);
		checkbox.trigger('change');
	});
	
	$('.btn-remover-selecionados').click( function(event) {
		event.preventDefault();
		$('#formRemover').submit();
    });

	$('.btn-remover-definitivo').click( function(event) {
		event.preventDefault();
		$('#formRemoverDefinitivo').submit();
    });
	
	$('.fake-link').click(function(e){
		e.preventDefault();
	});
	
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
		language: 'br'
	});

	$.tipoBanner = function(){
		if($('.banner-tipo').length){		
			if($('.banner-tipo').val() == 1){
				$('.banner-interno').hide().find('input, select, textarea').attr("disabled","disabled");
				$('.banner-externo').show().find('input, select, textarea').removeAttr("disabled");
			}
			else{
				$('.banner-interno').show().find('input, select, textarea').removeAttr("disabled");
				$('.banner-externo').hide().find('input, select, textarea').attr("disabled","disabled");
			}
		}	
	};
	$.tipoBanner();	
	
	$('.banner-tipo').on('change', function(){
		$.tipoBanner();
	});
	
	$(".ui-sortable").sortable({
		opacity:0.5,
		placeholder: "ui-state-highlight template-download span3",
		distance: 15,
		delay: 1,
		/*axis: "y",*/
		update: function(event,ui){
			/*console.log($('#fileupload').data('action'));*/
			if(typeof($('#fileupload').data('action')) === 'undefined'){
				var itemOrder = $('.ui-sortable').sortable('serialize');
				itemOrder = itemOrder + '&id=' + $('.orderId').val();
				console.log(itemOrder);
				$.post($('.orderPost').val(), itemOrder);
			}
		}
	});

	/* scroll suave */
	var scrollTo = function(target){
		$('html,body').animate({scrollTop: ($(target).offset().top) - 60}, 1000);
	}

    $('#fileupload').bind('fileuploaddone', function (e, data) {
    	var itemOrder = $('.ui-sortable').sortable('serialize');
    	/*console.log(itemOrder);*/
    }).bind('fileuploadadd', function (e, data) {
		if ($('.template-download:last').length) {
    		scrollTo('.template-download:last');
		}
    	/*template-upload*/
    	/*console.log(e);
    	console.log(data);*/
    });
    
    $('.procurar').click(function(e){
    	e.preventDefault();
		var busca = $('.busca');
    	if(busca.is(':hidden')){									
			busca.slideDown('slow');
		}
		else{
			busca.slideUp('slow');
		}
    }); 
	if($('.busca').hasClass('visible') == true){
		$('.busca').slideDown('slow');
	}
	
	/* chosen */
	$('.chosen').chosen({allow_single_deselect:true, width:'100%', no_results_text:'Não encontramos nada com:'});
	
	/* dateranger */
	$('.date-range').daterangepicker({
		locale: {
			applyLabel: 'Ok',
            clearLabel: 'Limpar',
            fromLabel: 'A partir',
            toLabel: 'Até',
            weekLabel: 'S',
            customRangeLabel: 'Escolher',	
		},
		ranges: {
	            'Hoje': ['today', 'today'],
	            'Ontem': ['yesterday', 'yesterday'],
	            'Últimos 7 dias': [Date.today().add({ days: -6 }), 'today'],
	            'Últimos 30 dias': [Date.today().add({ days: -29 }), 'today'],
	            'Mês atual': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
	            'Mês passado': [Date.today().moveToFirstDayOfMonth().add({ months: -1 }), Date.today().moveToFirstDayOfMonth().add({ days: -1 })]
		},
        opens: 'right',
        maxDate: 'today'
	    }, 
	    function(start, end) {
			if(start === null){
				$('.date-range-value').val('');
				$('.date-range span.fake-data').html('Escolha um período').parents('form').submit();
			}
			else{
				$('.date-range-value').val(start.toString('dd/MM/yyyy') + ' - ' + end.toString('dd/MM/yyyy'));
				$('.date-range span.fake-data').html(start.toString('dd/MM/yyyy') + ' - ' + end.toString('dd/MM/yyyy')).parents('form').submit();
			}
	    }
	);

	/* procurar resumir esta solução */
	$('.colorpicker').colorpicker({format: 'hex'}).on('changeColor', function(ev){
		$(this).val(ev.color.toHex());
		var cor = ev.color.toHex();
		$(this).parent('.input-append').find('.colorpicker-placeholder').css("background-color", cor);
	}).on('focusout', function(){ 
		var cor = $(this).val();
		$(this).parent('.input-append').find('.colorpicker-placeholder').css("background-color", cor);
	});
	
	/* auto focus */
	$('input:text:visible:first:not(".chzn-search input")').focus();

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
	$('.mask-data').mask('99/99/9999');
	$('.mask-CEP').mask('99999-999');
	$('.mask-CPF').mask('999.999.999-99');
	$('.mask-CNPJ').mask('99.999.999/9999-99');
	$('.mask-hora').mask('99:99');
	$('.mask-dinheiro').maskMoney({symbol:"",decimal:",",thousands:".",showSymbol:"false"});
	$('.mask-medida').maskMoney({symbol:"",decimal:"",thousands:".",showSymbol:"false",precision:0});
	$('.mask-inteiro').maskMoney({symbol:"",decimal:"",thousands:"",showSymbol:"false",precision:0});
	$('.mask-float').maskMoney({symbol:"",decimal:",",thousands:"",showSymbol:"false",precision:2});
	
	
	$('select.buscaCidades.chosen').chosen().change(function(){
		var wrap = $(this).parents('.control-group');
		if(wrap) wrap = $(this).parents('div');
		
		$.getJSON('/ajax/cidades/'+$(this).val(), function(resposta){
			if(resposta['error']){
				var options = '<option value="">' + resposta['error'] + '</option>';
			}
			else{
				var options = '<option value="">-</option>';
				$.each(resposta, function(key, val) {
					options += '<option value="' + val[key]['k'] + '">' + val[key]['v'] + '</option>';
				});
			}
			/* campo cidade mais próximo */
			console.log()
			wrap.next().find('select.recebeCidades.chosen').html(options).trigger("liszt:updated");
		});
	});
	
	/* password strength */
	$('.pass-strength').keyup(function(e) {
		var icone = $(this).parent('div').find('.add-on');
		var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
		var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		var enoughRegex = new RegExp("(?=.{6,}).*", "g");
		if (false == enoughRegex.test($(this).val())) {
			icone.html('<span class="label label-important">fraca</span>');
		} else if (strongRegex.test($(this).val())) {
			icone.html('<span class="label label-success">forte</span>');
		} else if (mediumRegex.test($(this).val())) {
			icone.html('<span class="label label-warning">média</span>');
		} else {
			icone.html('<span class="label label-important">fraca</span>');
		}
		return true;
	});	
	
	$('.sub-mens-individuais').live('click', function(e){
		var form = $(this).parents('form.validar');
		var action = form.attr('action');
		if(!form.data('validator')){
			form.validator({
				singleError: 'true',
				effect: 'malerta',
				errorInputEvent: null,
				onBeforeValidate: function(e, els){
					$('#form-alert').remove();
				}
			})
			.bind('onBeforeFail', function(e, els)  {
				/* evento onBeforeFail */
			})
			.bind('onFail', function(e, els)  {
				/* evento onFail */
			})
			.bind('onSuccess', function(e, els) {
				/* evento onSuccess */
				$.getJSON(action + '?' + form.serialize(), function(json) {
					if(json['erro']){
						$('body').mAlerta({message: json['erro'], css: 'erro', close: 3000});
		            }
					else{
						$('.modal').modal('hide')
											   	.on('hidden', function(){
											   		$('body').mAlerta({message: json['sucesso'], css: 'sucesso', close: 3000});
											   	});
					}
				});
				
				return false; /* evita o submit */
			});
		}
		
		/* forço o submit no clique do botão */
		form.submit();
	});

	if($('ol.nested-sortable').length){
	    $('ol.nested-sortable').nestedSortable({
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			maxLevels: 3,
	
			isTree: true,
			expandOnHover: 700,
			startCollapsed: false,
	
			update: function(event, ui){
				var ordenacao = $('ol.nested-sortable').nestedSortable('serialize');
				$.post('/admix/categorias/ordenar/', ordenacao);
			}
		});
	};
	
    $('.disclose').on('click', function() {
		$(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
	});

	/*$('#serialize').click(function(){
		serialized = $('ol.nested-sortable').nestedSortable('serialize');
		$('#serializeOutput').text(serialized+'\n\n');
	});*/

    $('.inserir-ajax').on('onSuccess', function(e){ /* evento do validador */
    	e.preventDefault();
		var action = $(this).attr('action');
		var input = $(this).find('input[name="Categoria_Nome"]');

		$.post(action, {Categoria_Nome: input.val()}).done(function(resposta){
			var resposta = $.parseJSON(resposta);
			if(resposta['error']){
				$('body').mAlerta({css: 'erro', message: resposta['error'], close: 3000});		
			}
			else{
				$('body').mAlerta({css: 'sucesso', message: resposta['sucesso'], close: 3000});
				var li = $('.nested-sortable').find('li:last').clone();
				li.attr('id', 'li_' + resposta['id']).find('a:first').html(resposta['nome']);
				
				/*var li = '<li id="li_'+ resposta['id'] +'" class="level-0 nav-0-1 mjs-nestedSortable-leaf"><div><span class="disclose"><span></span></span><a href="#">' + resposta['nome'] + '</a></div></li>';*/
				$('.nested-sortable').append(li).nestedSortable('refresh');
				input.val(''); /* limpa o campo */
			}
		});
	});

    $(document).on('click', 'ol.nested-sortable .remover', function(e){    
		e.preventDefault();
		var childs = $(this).parents('li:first').find('li');
		/*console.log(childs.length);*/
		if(childs.length == 0){
			var li = $(this).parents('li:first');
			var id = li.attr('id').replace('li_', '');
			var action = $('.action-remover').val();
			$.post(action, {id: id}).done(function(resposta){
				var resposta = $.parseJSON(resposta);
				if(resposta['error']){
					$('body').mAlerta({css: 'erro', message: resposta['error'], close: 3000});		
				}
				else{
					li.fadeOut(500, function(){ 
						li.remove(); 
						$('body').mAlerta({css: 'sucesso', message: resposta['sucesso'], close: 3000});
					});
				}
			});
		}
		else{
			$('body').mAlerta({css: 'erro', message: 'Você deve remover as categorias pedentes a esta.', close: 3000});
		}
	});
	
    $(document).on('click', 'ol.nested-sortable .alterar', function(e){    
		e.preventDefault();
		var li = $(this).parents('li:first');
		var id = li.attr('id').replace('li_', '');
		var action = $('.action-alterar').val();
		var url = action+'/'+id;
		
		$.get(url, function(data) {
			$('<div class="modal hide fade">' + data + '</div>').modal()
																.on('shown', function(){ 
																	/*var firstSelect 	= $(this).find('select:visible:enabled:first');*/
																	var firstInput 		= $(this).find('input:visible:enabled:first');
																	/*var firstTextarea 	= $(this).find('textarea:visible:enabled:first');
																	if(firstSelect.length != 0){ firstSelect.focus(); }
																	else if(firstInput.length != 0){ firstInput.focus(); }
																	else { firstTextarea.focus(); }*/
																	firstInput.focus();
																})
																.on('hidden', function () { 
																	$(this).remove(); 
																});
		});
		
	});

    $(document).on('click', '.ajax-post', function(e){
    	e.preventDefault();
    	$(this).parents('form').submit();
    });
    
    $(document).on('submit', '.modal .form-interno', function(e){
    	e.preventDefault();
    	
		var form = $(this);/*.parents('form.validar');*/
		var action = form.attr('action');
		if(!form.data('validator')){
			form.validator({
				singleError: 'true',
				effect: 'malerta',
				errorInputEvent: null,
				onBeforeValidate: function(e, els){
					$('#form-alert').remove();
				}
			})
			.bind('onBeforeFail', function(e, els)  {
				/* evento onBeforeFail */
			})
			.bind('onFail', function(e, els)  {
				/* evento onFail */
			})
			.bind('onSuccess', function(e, els) {
				/* evento onSuccess */
				/*$.getJSON(action + '?' + form.serialize(), function(json) {*/
				$.post(action, form.serialize()).done(function(resposta){
					var resposta = $.parseJSON(resposta);
					if(resposta['erro']){
						$('body').mAlerta({message: resposta['erro'], css: 'erro', close: 3000});
		            }
					else{
						$('.modal').modal('hide')
											   	.on('hidden', function(){
											   		$('#li_'+resposta['id']).find('a:first').html(resposta['nome']);
											   		$('body').mAlerta({message: resposta['sucesso'], css: 'sucesso', close: 3000});
											   	});
					}
				});
				
				return false; /* evita o submit */
			});
		}
		
		/* forço o submit no clique do botão */
		form.submit();
    	
    });
    
    $(document).on('click', '[data-toggle="modal"]', function(e){
		e.preventDefault();
		
		/*var url = $(this).attr('href');*/
		var url = $(this).data('href');
		if (url.indexOf('#') == 0) {
			$(url).modal('open');
		} else {
			$.get(url, function(data) {
				$('<div class="modal hide fade">' + data + '</div>').modal()
																	.on('shown', function(){ 
																		var firstSelect 	= $(this).find('select:visible:enabled:first');
																		var firstInput 		= $(this).find('input:visible:enabled:first');
																		var firstTextarea 	= $(this).find('textarea:visible:enabled:first');
																		if(firstSelect.length != 0){ firstSelect.focus(); }
																		else if(firstInput.length != 0){ firstInput.focus(); }
																		else { firstTextarea.focus(); }
																	})
																	.on('hidden', function () { 
																		$(this).remove(); 
																	});
			});
		}
		
	});
	
	
});