window.addEvent('domready', function(){
	// smooth anchor scrolling
	new SmoothScroll(); 
	// style area
	if(document.id('gkStyleArea')){
		$$('#gkStyleArea a').each(function(element,index){
			element.addEvent('click',function(e){
	            e.stop();
				changeStyle(index+1);
			});
		});
	}
	// font-size switcher
	if(document.id('gkTools') && document.id('gkComponentWrap')) {
		var current_fs = 100;
		var content_fx = new Fx.Tween(document.id('gkComponentWrap'), { property: 'font-size', unit: '%', duration: 200 }).set(100);
		document.id('gkToolsInc').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs < 150) { 
				content_fx.start(current_fs + 10); 
				current_fs += 10; 
			} 
		});
		document.id('gkToolsReset').addEvent('click', function(e){ 
			e.stop(); 
			content_fx.start(100); 
			current_fs = 100; 
		});
		document.id('gkToolsDec').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs > 70) { 
				content_fx.start(current_fs - 10); 
				current_fs -= 10; 
			} 
		});
	}
	// login popup
	if(document.id('gkButtonLogin')) {
	    var login_fx = new Fx.Tween(document.id('popupLogin'),{property: 'opacity', duration:300}).set(0);
	   	var hlogin_fx = new Fx.Tween(document.id('popupLogin'),{property: 'height', duration:300}).set(0);
	    var login = false;
	    var login_over = false;
	    
	    document.id(document.body).addEvent('click', function(e) {
	    	if(!login_over && document.id('popupLogin').getSize().y > 0) {
	    		document.id('gkButtonLogin').fireEvent('click', e);
	    	}
	    });
	    
	    document.id('popupLogin').setStyle('display','block');
	    document.id('gkButtonLogin').addEvent('click', function(e){
	    	e.stop();
	    	if(!login){
	    		login_fx.start(1);
	    		var pw = document.id('popupLogin').getElement('.gkPopupWrap');
	    		hlogin_fx.start(pw.getSize().y + (pw.getStyle('margin-top').toInt() * 2));
	    		login = true;
	    		document.id('gkButtonLogin').addClass('popup');
	    
	    		document.id('popupLogin').setStyles({
	    			"left" : (document.id('gkButtonLogin').getCoordinates().right - document.id('popupLogin').getSize().x) + "px",
	    			"top" : (document.id('gkButtonLogin').getCoordinates().top) + "px"
	    		});
	    	}else{
	    		login_fx.start(0);
	    		hlogin_fx.start(0);
	    		login = false;
	    		document.id('gkButtonLogin').removeClass('popup');
	    	}
	    
	    	document.id('popupLogin').getElement('.gkPopupWrap').addEvent('mouseover',function(){login_over = true;});
	    	document.id('popupLogin').getElement('.gkPopupWrap').addEvent('mouseout',function(){login_over = false;});
	    }); 
	}
	// search button
	if(document.id('gkButtonTools')) {
		document.id('gkToolsHide').set('tween', {duration: 250});
	
		document.id('gkButtonTools').addEvent('click', function(e){
			e.stop();
			if(document.id('gkToolsHide').getSize().x > 0) {
				document.id('gkToolsHide').tween('width', 0);
			} else {
				document.id('gkToolsHide').tween('width', 90);
			}
		});
	}
});
// function to set cookie
function setCookie(c_name, value, expire) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expire);
	document.cookie=c_name+ "=" +escape(value) + ((expire==null) ? "" : ";expires=" + exdate.toUTCString());
}
// Function to change styles
function changeStyle(style){
	var file1 = $GK_TMPL_URL+'/css/style'+style+'.css';
	var file2 = $GK_TMPL_URL+'/css/typography.style'+style+'.css';
	new Asset.css(file1);
	new Asset.css(file2);
	Cookie.write('gk1_style',style, { duration:365, path: '/' });
}