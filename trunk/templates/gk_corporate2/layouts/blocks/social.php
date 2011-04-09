<?php

// No direct access.
defined('_JEXEC') or die;

$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');

?>

<?php if($this->getParam('fb_login', '0') == 1 || $this->getParam('fb_like', '0') == 1 || $this->getParam('fb_facepile', '0') == 1) : ?>
<div id="fb-root"></div>
<script type="text/javascript">
    //<![CDATA[
    FB.init({appId: '<?php echo $this->getParam('fb_api_id', ''); ?>', status: true, cookie: true, xfbml: true});
    $gkFBLoginClicked = false;
    window.addEvent('load', function(){
    	(function(){
    		if($$('.fb_button.fb_button_medium')[0]){
    			$$('.fb_button.fb_button_medium')[0].addEvent('click', function(){
    				if($('login-form')){
    					FB.getLoginStatus(function(response) {
    						if (response.session) {
    							$('modlgn-username').set('value','Facebook');
    							$('modlgn-passwd').set('value','Facebook');
    							$('login-form').submit();
    						}
    					});
    				} else if($('com-login-form')) {
    					FB.getLoginStatus(function(response) {
    						if (response.session) {
    							$('username').set('value','Facebook');
    							$('password').set('value','Facebook');
    							$('com-login-form').submit();
    						}
    					});
    				}
    				
    				$gkFBLoginClicked = true;
    			});
    		}
    	}).delay(1000); 
    }); 
    
    FB.Event.subscribe('auth.sessionChange', function(response) {
    	if (response.session && $gkFBLoginClicked) {
    		if($('login-form')){
    			$('modlgn-username').set('value','Facebook');
    			$('modlgn-passwd').set('value','Facebook');
    			$('login-form').submit();
    		}
    	}
    });
    //]]>
</script>
<?php endif; ?>

<?php if($this->getParam('digg_btn', '0') == 1 && $option == 'com_content' && $view == 'article') : ?>
<script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script>
<?php endif; ?>

<?php 
	// put Google Analytics code
	echo $this->googleAnalyticsParser(); 
?>