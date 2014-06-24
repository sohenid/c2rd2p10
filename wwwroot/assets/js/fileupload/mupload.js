/*
 * jQuery File Upload Plugin JS Example 6.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/assets/html/result.html?%s'
        )
    );
    
    /* max upload e extensoes aceitas */
    $('#fileupload').fileupload('option', {
    	maxFileSize: 5000000, /* 5MB */
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        previewMaxWidth: 260,
        previewMaxHeight: 188,
        process: [{
	                action: 'load',
	                fileTypes: /^image\/(gif|jpeg|png)$/,
	                maxFileSize: 10000000 /* 10MB */
        }]
    });
    
    $('#fileupload')
    .bind('fileuploadsubmit', function (e, data) { $('.fileupload-buttonbar .float-progress').slideDown(); })
    .bind('fileuploaddone', function (e, data) { $('.fileupload-buttonbar .float-progress').slideUp(); });
    
	/*console.log(window.location.hostname);*/
    if (window.location.hostname === 'blueimp.github.com') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            process: [
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1440,
                    maxHeight: 900
                },
                {
                    action: 'save'
                }
            ]
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
    	$('#fileupload').each(function () {
            var that = this;
            var id = $(that).find('input[name="id"]').val();
            $.getJSON(this.action+'/', { metodo:"consultar", id:id, cache:Math.random() },
              	function (result) {
            	/*console.log(result);*/
                if (result && result.length) {
                    $(that).fileupload('option', 'done')
                    .call(that, null, {
                        result: result
                    });
                }
                else{
                	/*console.log($(that).find('.table').find('.files').prepend('<tr><td colspan="6">Clique em adicionar imagens e selecione as imagens que deseja publicar.</td></tr>'));
                	console.log('Clique em adicionar imagens e selecione as imagens que deseja publicar.');*/
                }
            });
        });    	
    }
    
    /* Open download dialogs via iframes, to prevent aborting current uploads: */
    $('#fileupload .files a:not([target^=_blank])').live('click', function (e) {
        e.preventDefault();
        $('<iframe style="display:none;"></iframe>')
        .prop('src', this.href)
        .appendTo('body');
    });    

});
