window.addEvent('load', function() {
	var Equalizer = new Class({
		initialize: function(elements) {
			this.elements = $$(elements);
		},
		equalize: function(hw) {
			if(!hw) { hw = 'height'; }
			var max = 0,
				prop = (typeof document.body.style.maxHeight != 'undefined' ? 'min-' : '') + hw; //ie6 ftl
				offset = 'offset' + hw.capitalize();
			this.elements.each(function(element,i) {
				var calc = element[offset];
				if(calc > max) { max = calc; }
			},this);
			this.elements.each(function(element,i) {
				element.setStyle(prop,max - (element[offset] - element.getStyle(hw).toInt()));
			});
			return max;
		}
	});
	
	var columnizer = new Equalizer('.gkCol:not(.gkColLeft) .box').equalize('height');	
	var height = parseInt($$("#gkToptop4 .box").getStyle("min-height").toString().replace("px",""));	
	var offset = 120; /*che sarebbe 24px di padding per entrambi i box(x4), + 10px di margin-top solo per uno, + 1px di bordi */
	var mid = Math.round((height - offset) / 2);
	var mod = (height - offset) % 2;	
	$$("#gkToptop2 .box").setStyle("min-height", mid + "px");	
	$$("#gkToptop2 .dark").setStyle("min-height", mid + "px");
});