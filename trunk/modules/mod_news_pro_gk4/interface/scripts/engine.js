/**
* Main script file
* @package News Show Pro GK4
* @Copyright (C) 2009-2011 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: GK4 1.0 $
**/

window.addEvent("load", function(){	
	$$('.nspMain').each(function(module){
		var id = module.getProperty('id');
		var $G = $Gavick[id];
		var arts_actual = 0;
		var list_actual = 0;
		var arts_block_width = module.getElement('.nspArts') ? module.getElement('.nspArts').getSize().x : null;
		var links_block_width = module.getElement('.nspLinks ul') ? module.getElement('.nspLinks ul').getSize().x : null;
		var arts = module.getElements('.nspArt');
		var links = module.getElements('.nspLinks .nspList li');
		var arts_per_page = $G['news_column'] * $G['news_rows'];
		var pages_amount = Math.ceil(arts.length / arts_per_page);
		var links_pages_amount = Math.ceil(Math.ceil(links.length / $G['links_amount']) / $G['links_columns_amount']);
		var auto_anim = module.hasClass('autoanim');
		var hover_anim = module.hasClass('hover');
		var anim_speed = $G['animation_speed'];
		var anim_interval = $G['animation_interval'];
		var animation = true;
		
		if(arts.length > 0){
			for(var i = 0; i < pages_amount; i++){
				var div = new Element('div',{"class" : "nspArtPage"});
				div.setStyles({ "width" : arts_block_width+"px", "float" : "left" });
				div.injectBefore(arts[0]);
			}	
			
			var j = 0;
			for(var i = 0; i < arts.length; i++) {
				if(i % arts_per_page == 0 && i != 0) { j++; }
				if(Browser.Engine.trident) arts[i].setStyle('width', (arts[i].getStyle('width').toInt() - 0.2) + "%");
				arts[i].injectInside(module.getElements('.nspArtPage')[j]);
				if(arts[i].hasClass('unvisible')) arts[i].removeClass('unvisible');
			}
			
			var main_scroll = new Element('div',{"class" : "nspArtScroll1" });
			main_scroll.setStyles({ "width" : arts_block_width + "px", "overflow" : "hidden" });
			main_scroll.innerHTML = '<div class="nspArtScroll2"></div>';
			main_scroll.injectBefore(module.getElement('.nspArtPage'));
			var long_scroll = module.getElement('.nspArtScroll2');
			long_scroll.setStyle('width','100000px');
			module.getElements('.nspArtPage').injectInside(long_scroll);
			var art_scroller = new Fx.Scroll(main_scroll, {duration:$G['animation_speed'], wait:false, wheelStops:false, transition: $G['animation_function']});
		}
		
		if(links.length > 0){
			for(var i = 0; i < links_pages_amount * $G['links_columns_amount']; i++){
				var ul = new Element('ul');
				ul.setStyles({ "width" : Math.floor(links_block_width / $G['links_columns_amount']) +"px", "float" : "left" });
				ul.setProperty("class","nspList");
				ul.injectTop(module.getElement('.nspLinks'));
			}
			
			var k = 0;
			for(var i = 0; i < links.length; i++) {
				if(i % $G['links_amount'] == 0 && i != 0) { k++; }
				links[i].injectInside(module.getElements('.nspLinks ul.nspList')[k]);
				if(links[i].hasClass('unvisible')) links[i].removeClass('unvisible');
			}
			module.getElements('.nspLinks ul.nspList')[module.getElements('.nspLinks ul.nspList').length - 1].dispose();
			var link_scroll = new Element('div',{"class" : "nspLinkScroll1" });
			link_scroll.setStyles({ "width" : links_block_width + "px", "overflow" : "hidden" });
			link_scroll.innerHTML = '<div class="nspLinkScroll2"></div>';
			link_scroll.injectTop(module.getElement('.nspLinks'));
			var long_link_scroll = module.getElement('.nspLinkScroll2');
			long_link_scroll.setStyle('width','100000px');
			module.getElements('.nspLinks ul.nspList').injectInside(long_link_scroll);
			var link_scroller = new Fx.Scroll(link_scroll, {duration:$G['animation_speed'], wait:false, wheelStops:false, transition: $G['animation_function']});
		}
		
		// top interface
		nsp_art_list(0, module, 'Top');
		nsp_art_list(0, module, 'Bot');
		nsp_art_counter(0, module, 'Top', pages_amount);
		nsp_art_counter(0, module, 'Bot', links_pages_amount);
		
		if(module.getElement('.nspTopInterface .nspPagination')){
			module.getElement('.nspTopInterface .nspPagination').getElements('li').each(function(item,i){
				item.addEvent(hover_anim ? 'mouseenter' : 'click', function(){
					art_scroller.start(i*arts_block_width, 0);
					arts_actual = i;
					
					if(Browser.Engine.presto){
			 			new Fx.Tween(module.getElements('.nspArtScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left',-1 * arts_actual * arts_block_width);
					}
					
					nsp_art_list(i, module, 'Top');
					nsp_art_counter(i, module, 'Top', pages_amount);
					animation = false;
					(function(){animation = true;}).delay($G['animation_interval'] * 0.8);
				});	
			});
		}
		if(module.getElement('.nspTopInterface .nspPrev')){
			module.getElement('.nspTopInterface .nspPrev').addEvent("click", function(){
				if(arts_actual == 0) arts_actual = pages_amount - 1;
				else arts_actual--;
				art_scroller.start(arts_actual * arts_block_width, 0);
				
				if(Browser.Engine.presto){
			 		new Fx.Tween(module.getElements('.nspArtScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left', -1 * arts_actual * arts_block_width);	
				}
				
				nsp_art_list(arts_actual, module, 'Top');
				nsp_art_counter(arts_actual, module, 'Top', pages_amount);
				animation = false;
				(function(){animation = true;}).delay($G['animation_interval'] * 0.8);
			});
		}
		
		if(module.getElement('.nspTopInterface .nspNext')){
			module.getElement('.nspTopInterface .nspNext').addEvent("click", function(){
				if(arts_actual == pages_amount - 1) arts_actual = 0;
				else arts_actual++;
				art_scroller.start(arts_actual * arts_block_width, 0);
				
				if(Browser.Engine.presto){
			 		new Fx.Tween(module.getElements('.nspArtScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left', -1 * arts_actual * arts_block_width);	
				}
				
				nsp_art_list(arts_actual, module, 'Top');
				nsp_art_counter(arts_actual, module, 'Top', pages_amount);
				animation = false;
				(function(){animation = true;}).delay($G['animation_interval'] * 0.8);
			});
		}
		// bottom interface
		if(module.getElement('.nspBotInterface .nspPagination')){
			module.getElement('.nspBotInterface .nspPagination').getElements('li').each(function(item,i){
				item.addEvent(hover_anim ? 'mouseenter' : 'click', function(){
					link_scroller.start(i*links_block_width, 0);
					list_actual = i;
					
					if(Browser.Engine.presto){
			 			new Fx.Tween(module.getElements('.nspLinkScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left', -1 * list_actual * links_block_width);	
					}
					
					nsp_art_list(i, module, 'Bot', links_pages_amount);
				});	
			});
		}
		if(module.getElement('.nspBotInterface .nspPrev')){
			module.getElement('.nspBotInterface .nspPrev').addEvent("click", function(){
				if(list_actual == 0) list_actual = links_pages_amount - 1;
				else list_actual--;
				link_scroller.start(list_actual * links_block_width, 0);
				
				if(Browser.Engine.presto){
		 			new Fx.Tween(module.getElements('.nspLinkScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left', -1 * list_actual * links_block_width);	
				}
				
				nsp_art_list(list_actual, module, 'Bot', links_pages_amount);
				nsp_art_counter(list_actual, module, 'Bot', links_pages_amount);
			});
		}
		if(module.getElement('.nspBotInterface .nspNext')){
			module.getElement('.nspBotInterface .nspNext').addEvent("click", function(){
				if(list_actual == links_pages_amount - 1) list_actual = 0;
				else list_actual++;
				link_scroller.start(list_actual * links_block_width, 0);
				
				if(Browser.Engine.presto){
 					new Fx.Tween(module.getElements('.nspLinkScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left', -1 * list_actual * links_block_width);	
				}
				
				nsp_art_list(list_actual, module, 'Bot', links_pages_amount);
				nsp_art_counter(list_actual, module, 'Bot', links_pages_amount);
			});
		}
		
		if(auto_anim){
			(function(){
				if(module.getElement('.nspTopInterface .nspNext')){
					if(animation) module.getElement('.nspTopInterface .nspNext').fireEvent("click");
				}else{
					if(arts_actual == pages_amount - 1) arts_actual = 0;
					else arts_actual++;
					art_scroller.start(arts_actual * arts_block_width, 0);
					
					if(Browser.Engine.presto){
				 		new Fx.Tween(module.getElements('.nspArtScroll2')[0], {duration:$G['animation_speed'], wait:false, transition: $G['animation_function']}).start('margin-left', -1 * arts_actual * arts_block_width);	
					}
					nsp_art_list(arts_actual, module, 'Top');
					nsp_art_counter(arts_actual, module, 'Top', pages_amount);
				}
			}).periodical($G['animation_interval']);
		}
	});
	
	function nsp_art_list(i, module, position){
		if(module.getElement('.nsp'+position+'Interface .nspPagination')){
			module.getElement('.nsp'+position+'Interface .nspPagination').getElements('li').setProperty('class', '');
			module.getElement('.nsp'+position+'Interface .nspPagination').getElements('li')[i].setProperty('class', 'active');
		}
	}
	
	function nsp_art_counter(i, module, position, num){
		if(module.getElement('.nsp'+position+'Interface .nspCounter')){
			module.getElement('.nsp'+position+'Interface .nspCounter span').innerHTML =  (i+1) + ' / ' + num;
		}
	}
});