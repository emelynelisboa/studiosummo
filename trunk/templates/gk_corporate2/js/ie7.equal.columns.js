window.addEvent('domready', function(){
	// script to generate equal columns - unnecessary in the penguinMail template

    if(document.id('gkLeftLeft') && document.id('gkLeftRight')) {
		document.id('gkLeftLeft').setStyle('width', (document.id('gkLeftLeft').getSize().x - 20) + "px");
		document.id('gkLeftRight').setStyle('width', (document.id('gkLeftRight').getSize().x - 20) + "px");
	}
	
	if(document.id('gkRightLeft') && document.id('gkRightRight')) {
		if(document.id('gkRightLeft').getSize().x - 20 > 0) {
			document.id('gkRightLeft').setStyle('width', (document.id('gkRightLeft').getSize().x - 20) + "px");
		}
	}
	
	if(document.id('gkInset1')) {
		if(document.id('gkInset1').getSize().x - 23 > 0) {
			document.id('gkInset1').setStyle('width', (document.id('gkInset1').getSize().x - 23) + "px");
		}
	}
	if(document.id('gkInset2')) {
		if(document.id('gkInset2').getSize().x - 23 > 0) {
			document.id('gkInset2').setStyle('width', (document.id('gkInset2').getSize().x - 23) + "px");
		}
	}
	
    if(document.id('gkHeaderheader1')) {
			document.id('gkHeaderheader1').setStyle('width', (document.id('gkHeaderheader1').getSize().x - 5) + "px");
    }
    
	[document.id('gkTop1'), document.id('gkTop2'), document.id('gkTop3'), document.id('gkTop4'), document.id('gkTop5'), document.id('gkTop6')].each(function(el){
		if(el) {
			el.getElements('.gkCol').each(function(col){
				if(col.getSize().x - 1 > 0) {
					col.setStyle('width', (col.getSize().x - 1) + 'px');
				}
			});
		}
	});
    
});