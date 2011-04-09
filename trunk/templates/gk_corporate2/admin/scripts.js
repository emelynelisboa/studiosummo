window.addEvent('domready', function(){
	// load the template updates
	getUpdates();
	// generate switchers
	generateFormElements();
	// create help icons
	generateHelpIcons();
	// get translations
	var $lang = getTranslations();
	// fix the Joomla!1.6 behaviour
	$$('.panel h3.title').each(function(panel) {
		panel.addEvent('click', function(){
			if(panel.hasClass('pane-toggler')) {
				(function(){ panel.getParent().getElement('.pane-slider').setStyle('height', 'auto'); }).delay(750);
			}
		});
	});
	// fonts forms
	$$('.gkfont_form').each(function(el) {
		var base_id = el.getElement('input').getProperty('id');
		var base_el = document.id(base_id);
		if(base_el.value == '') base_el.value = 'standard;Arial, Helvetica, sans-serif';
		var values = (base_el.value).split(';');
		// id of selectbox are different from input id
		base_id = base_id.replace('jform_params_font_', 'jformparamsfont_');
		document.id(base_id + '_type').set('value', values[0]);
		
		if(values[0] == 'standard') {
			document.id(base_id + '_normal').set('value', values[1]);
			document.id(base_id + '_google').setStyle('display', 'none');
			document.id(base_id + '_squirrel').setStyle('display', 'none');
		} else if(values[0] == 'google') {
			document.id(base_id + '_google').set('value', values[1]);
			document.id(base_id + '_normal').setStyle('display', 'none');
			document.id(base_id + '_squirrel').setStyle('display', 'none');
		} else if(values[0] == 'squirrel') {
			document.id(base_id + '_squirrel').set('value', values[1]);
			document.id(base_id + '_normal').setStyle('display', 'none');
			document.id(base_id + '_google').setStyle('display', 'none');
		}
		
		document.id(base_id + '_type').addEvents({
			'change' : function() { 
				if(document.id(base_id + '_type').value == 'standard') {
					document.id(base_id + '_normal').setStyle('display', 'block');
					document.id(base_id + '_google').setStyle('display', 'none');
					document.id(base_id + '_squirrel').setStyle('display', 'none');
				} else if(document.id(base_id + '_type').value == 'google') {
					document.id(base_id + '_normal').setStyle('display', 'none');
					document.id(base_id + '_google').setStyle('display', 'block');
					document.id(base_id + '_squirrel').setStyle('display', 'none');				
				} else if(document.id(base_id + '_type').value == 'squirrel') {
					document.id(base_id + '_normal').setStyle('display', 'none');
					document.id(base_id + '_google').setStyle('display', 'none');
					document.id(base_id + '_squirrel').setStyle('display', 'block');
				}
			},
			'blur' :function() { 
				if(document.id(base_id + '_type').value == 'standard') {
					document.id(base_id + '_normal').set('display', 'block');
					document.id(base_id + '_google').setStyle('display', 'none');
					document.id(base_id + '_squirrel').setStyle('display', 'none');
				} else if(document.id(base_id + '_type').value == 'google') {
					document.id(base_id + '_normal').set('display', 'none');
					document.id(base_id + '_google').setStyle('display', 'block');
					document.id(base_id + '_squirrel').setStyle('display', 'none');				
				} else if(document.id(base_id + '_type').value == 'squirrel') {
					document.id(base_id + '_normal').set('display', 'none');
					document.id(base_id + '_google').setStyle('display', 'none');
					document.id(base_id + '_squirrel').setStyle('display', 'block');
				}
			}
		});
		
		document.id(base_id + '_normal').addEvents({
			'change' : function() { base_el.set('value', document.id(base_id + '_type').value + ';' + document.id(base_id + '_normal').value); },
			'blur' : function() { base_el.set('value', document.id(base_id + '_type').value + ';' + document.id(base_id + '_normal').value); }
		});
		
		document.id(base_id + '_google').addEvents({
			'change' : function() { base_el.set('value', document.id(base_id + '_type').value + ';' + document.id(base_id + '_google').value); },
			'blur' : function() { base_el.set('value', document.id(base_id + '_type').value + ';' + document.id(base_id + '_google').value); }
		});
		
		document.id(base_id + '_squirrel').addEvents({
			'change' : function() { base_el.set('value', document.id(base_id + '_type').value + ';' + document.id(base_id + '_squirrel').value); },
			'blur' : function() { base_el.set('value', document.id(base_id + '_type').value + ';' + document.id(base_id + '_squirrel').value); }
		});
	});
	
	// overrides 
	['layout_override', 'tools_for_pages', 'suffix_override', 'module_override', 'menu_override'].each(function(txt) {
		var rules = document.id(txt + '_rules');
		var textarea = document.id('jform_params_' + txt);
		var items = textarea.innerHTML.split( /\r\n|\r|\n/ );
		
		for(var i = 0; i < items.length; i++) {
			if(items[i] != "") {
				var item = new Element('div');
				var type = items[i].split('=')[0].test(/^\d+$/) ? 'ItemID' : 'Option';
				item.innerHTML = '<em>' + type + '</em> <strong>' + items[i].split('=')[0] + '</strong> - <strong>' + items[i].split('=')[1] + '</strong> <a href="#" class="' + txt + '_remove_rule">' + $lang['tpl_js_remove_rule'] + '</a>';
				item.inject(rules, 'bottom');
			}
		}
	
		rules.addEvent('click', function(e){
			var evt = new Event(e);
			evt.stop();
			if(e.target.hasClass(txt + '_remove_rule')) {
				var parent = e.target.getParent();
				var values = parent.getElements('strong');
				textarea.innerHTML = textarea.innerHTML.replace(values[0].innerHTML + "=" + values[1].innerHTML + "\n", '');
				parent.destroy();
			}
		});
	
		document.id(txt + '_add_btn').addEvent('click', function(){
			var rule = document.id(txt + '_input').value + "=" + document.id(txt + '_select').value + "\n";
			
			if(textarea.innerHTML.contains(rule)) {
				alert($lang['tpl_js_specified_rule_exists']);
			} else {
				textarea.innerHTML += rule;
				var item = new Element('div');
				var type = document.id(txt + '_input').value.test(/^\d+$/) ? 'ItemID' : 'Option';
				var value = document.id(txt + '_input').value;
				var layout = document.id(txt + '_select').value;
				item.innerHTML = '<em>' + type + '</em> <strong>' + value + '</strong> - <strong>' + layout + '</strong> <a href="#" class="' + txt + '_remove_rule">' + $lang['tpl_js_remove_rule'] + '</a>';
				item.inject(rules, 'bottom');
			}
		});
	});
	
	// layout override 
	var grules = document.id('google_analytics_rules');
	var gtextarea = document.id('jform_params_google_analytics');
	var gitems = gtextarea.innerHTML.split( /\r\n|\r|\n/ );
	
	for(var i = 0; i < gitems.length; i++) {
		if(gitems[i] != "") {
			var gitem = new Element('div');
			gitem.innerHTML = '<strong>' + gitems[i] + '</strong> <a href="#" class="google_analytics_remove_rule">' + $lang['tpl_js_remove_rule'] + '</a>';
			gitem.inject(grules, 'bottom');
		}
	}

	grules.addEvent('click', function(e){
		var evt = new Event(e);
		evt.stop();
		if(e.target.hasClass('google_analytics_remove_rule')) {
			var parent = e.target.getParent();
			var values = parent.getElement('strong');
			gtextarea.innerHTML = gtextarea.innerHTML.replace(values.innerHTML + "\n", '');
			parent.destroy();
		}
	});

	document.id('google_analytics_add_btn').addEvent('click', function(){
		var rule = document.id('google_analytics_input').value + "\n";
		
		if(gtextarea.innerHTML.contains(rule)) {
			alert($lang['tpl_js_specified_rule_exists']);
		} else {
			gtextarea.innerHTML += rule;
			var item = new Element('div');
			var value = document.id('google_analytics_input').value;
			item.innerHTML = '<strong>' + value + '</strong> <a href="#" class="google_analytics_remove_rule">' + $lang['tpl_js_remove_rule'] + '</a>';
			item.inject(grules, 'bottom');
		}
	});
	// hide
	document.id('jform_params_startlevel-lbl').getParent().setStyle('display','none');
});
// function to get the translations
function getTranslations() {
	var translations = [];
	
	document.id('template_options_translations').getElements('span').each(function(el){
		translations[el.getProperty('id')] = el.innerHTML;
	});
	
	return translations;
}
// function to generate the updates list
function getUpdates() {	
	document.id('jform_params_template_updates-lbl').destroy(); // remove unnecesary label
	var update_url = 'http://www.gavick.com/updates.raw?task=json&tmpl=component&query=product&product=gk_corporate2_j16';
	var update_div = document.id('gk_template_updates');
	update_div.innerHTML = '<div id="gk_update_div"><span id="gk_loader"></span>Loading update data from GavicPro Update service...</div>';
	
	new Asset.javascript(update_url,{
		id: "new_script",
		onload: function(){
			content = '';
			$GK_UPDATE.each(function(el){
				content += '<li><span class="gk_update_version"><strong>Version:</strong> ' + el.version + ' </span><span class="gk_update_data"><strong>Date:</strong> ' + el.date + ' </span><span class="gk_update_link"><a href="' + el.link + '" target="_blank">Download</a></span></li>';
			});
			update_div.innerHTML = '<ul class="gk_updates">' + content + '</ul>';
			if(update_div.innerHTML == '<ul class="gk_updates"></ul>') update_div.innerHTML = '<p>There is no available updates for this template</p>';	
		}
	});
}
// function to generate the additional elements
function generateFormElements() {
	// remove next label
	var buf = null;
	$$('.next-remove').each(function(el, i) {
        if(i % 2 == 0) {
            el.getParent().getElement('label').destroy();
            buf = el.getParent().innerHTML;
            el.getParent().destroy();
        } else {
            el.getParent().innerHTML += buf;
        }
	});
	// create suffix labels
	$$('.suffix-px').each(function(el) {
		new Element('span', {'class' : 'gkFormSuffixPx', 'html' : 'px'}).inject(el, 'after');
	});
	$$('.suffix-percents').each(function(el) {
		new Element('span', {'class' : 'gkFormSuffixPercents', 'html' : '%'}).inject(el, 'after');
	});
	$$('.suffix-pxorpercents').each(function(el) {
		new Element('span', {'class' : 'gkFormSuffixPxOrPercents', 'html' : ''}).inject(el, 'after');
	});
	// switchers
	$$('.gk_switch').each(function(el){
		el.setStyle('display','none');
		var style = (el.value == 1) ? 'on' : 'off';
		var switcher = new Element('div',{'class' : 'switcher-'+style});
		switcher.inject(el, 'after');
		switcher.addEvent("click", function(){
			if(el.value == 1){
				switcher.setProperty('class','switcher-off');
				el.value = 0;
			}else{
				switcher.setProperty('class','switcher-on');
				el.value = 1;
			}
		});
	});
}
// function to generate the help icons
function generateHelpIcons() {
	var urls = [
		'http://www.gavickmagazine.com/home/item/184-gavern-framework%E2%80%93page-layout-part-1.html',
		'http://www.gavickmagazine.com/home/item/184-gavern-framework%E2%80%93page-layout-part-1.html',
		'http://www.gavickmagazine.com/home/item/189-gavern-framework%E2%80%93fonts.html',
		'http://www.gavickmagazine.com/home/item/193-gavern-framework-features.html',
		'http://www.gavickmagazine.com/home/item/192-gavern-framework-refreshed-typography.html',
		'http://www.gavickmagazine.com/home/item/199-gavern-framework%E2%80%93menu.html',
		'http://www.gavickmagazine.com/home/item/206-gavern-framework%E2%80%93social-api.html',
		'http://www.gavickmagazine.com/home/item/202-gavern-framework%E2%80%93mobile-version.html',
		'http://www.gavickmagazine.com/home/item/188-gavern-framework%E2%80%93advanced-settings.html',
		'http://www.gavick.com/support/updates.html'
	]
	
	$$('div.panel').each(function(el, i) {
		var link = new Element('a', { 'class' : 'gkHelpLink', 'href' : urls[i], 'target' : '_blank' })
		link.inject(el.getElement('h3'), 'bottom');
		link.addEvent('click', function(e) { e.stopPropagation(); });
	});
}