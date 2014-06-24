<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {google_analytics} function plugin
 *
 * Type:     function<br>
 * Name:     google_analytics<br>
 * Date:     Jul 8, 2011<br>
 * Purpose:  Mostrar o analytics do google<br>
 * Input:
 *         - param = UA-xxxxxx-x
 *
 * Examples:<br>
 * <pre>
 * {google_analytics code=UA-xxxxxx-x} 
 * </pre>
 * @author László Kovács <info@laszlokovacs.com>
 * @author credit to MIXD Internet <atendimento@mixd.com.br>
 * @param $params é obrigatório 
 * @return string|null
 */

function smarty_function_google_analytics($params, &$smarty){ 
	if(empty($params['code'])){
		#trigger_error("google_analytics: faltando parametros", E_USER_WARNING);
        return;
    }

	/*$return = "
<script type=\"text/javascript\">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '".$params['code']."']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>";*/

$return = "
  <script type=\"text/javascript\">
      (function(i, s, o, g, r, a, m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function() {
              (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
                  m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

      ga('create', '".$params['code']."', '".$_SERVER['HTTP_HOST']."');
      ga('send', 'pageview');
  </script>";
   
   return $return; 
}

?>