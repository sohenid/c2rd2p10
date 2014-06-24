/*
 http://www.dailycoding.com/ 
 Topbar message plugin
 */
 /* 
 Modified by Larry Battle on Mar 24, 2011. Contact me at blarry@bateru.com
 Changes include using jQuery structure more and simplifying the overall script. Now passes jsLint 100%.
 Fixed no delay when clicked problem. 
 */
(function ($) {
	var defaults = {
		background: "#888",
		borderColor: "#000",
		foreColor: "#000",
		height: "50px",
		fontSize: "20px",
		close: "click",
		delay: 2000,
		speed: 200,
		message: ''
	};
    $.fn.showTopbarMessage = function (userOptions) {
		var text,
			options = $.extend( {}, defaults, userOptions),
			barStyle = { 
				height: options.height, 
				width: "100%", position: "fixed", top: "0px", left:"0px", right: "0px", margin: "0px", display: "none" 
			},
			overlayStyle = {
				height: options.height, "background-color": options.background, "border-bottom" : ("solid 5px " + options.borderColor ),
				filter: "alpha(opacity=50);-moz-opacity: 0.5;-khtml-opacity: 0.5;opacity: 0.5"
			},
			messageStyle = {
				"height": options.height, "color": options.foreColor, "font-size": options.fontSize,
				width: "100%", position: "absolute",  top: "0px", left:"0px", right: "0px", margin: "0px", "text-align": "center",
				padding: "10px 0px", "font-weight": "bold"
			};
        return this.each(function () {
			$(".topbarBox").remove();
			/*text = $(this).text();*/
			text = options.message;
			
			var $html = $( "<div/>" ).addClass( "topbarBox" ).css( barStyle ).append(
				$( "<div/>" ).css( overlayStyle ).html( " " ),
				$( "<div/>" ).css( messageStyle ).text( text )
			).click(function(){
				$(this).slideUp(options.speed, function () {
					$(this).remove();
				});
			});
			
			$html.appendTo( document.body ).slideDown( options.speed );
            if( !/click/.test(options.close) ){
                $html.delay( options.delay ).click();
			}
        });
    };
})(jQuery);