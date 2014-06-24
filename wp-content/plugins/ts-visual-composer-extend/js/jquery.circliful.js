(function( $ ) {
    $.fn.circliful = function(options) {
        var settings = $.extend({
            // These are the defaults.
            foregroundColor: 			"#556b2f",
            backgroundColor: 			"#eee",
            fillColor: 					false,
            width: 						15,
            dimension: 					250,
            size: 						15, 
			percent: 					50,
            animationStep: 				1.0
        }, options );
		return this.each(function() {
			var parentsize				= jQuery(this).parent().width();
			var counterID				= '';
			var dimension 				= '';
			var text 					= '';
			var textPre					= '';
			var textPost				= '';
			var info 					= '';
			var infoPadding				= 20;
			var width 					= '';
			var size 					= 0;
			var percent 				= 0;
			var endPercent 				= 100;
			var fgcolor 				= '';
			var bgcolor 				= '';
			var icon 					= '';
			var iconColor				= '#dddddd';
			var iconPosition			= 'left';
			var animationstep 			= 0.0;
			jQuery(this).addClass('circliful');
			counterID					= jQuery(this).attr('data-id');
			if(jQuery(this).data('width') != undefined) {
				width 					= jQuery(this).data('width');
			} else {
				width 					= settings.width;
			}
			if (parentsize > settings.dimension) {
				dimension				= settings.dimension * 0.9;
			} else {
				dimension 				= parentsize * 0.9;
			}
			size						= dimension / 6;
			if (jQuery(this).data('percent') != undefined) {
				percent 				= jQuery(this).data('percent') / 100;
				endPercent 				= jQuery(this).data('percent');
			} else {
				percent 				= settings.percent / 100;
			}
			if (jQuery(this).data('fgcolor') != undefined) {
				fgcolor 				= jQuery(this).data('fgcolor');
			} else {
				fgcolor 				= settings.foregroundColor;
			}
			if (jQuery(this).data('bgcolor') != undefined) {
				bgcolor 				= jQuery(this).data('bgcolor');
			} else {
				bgcolor 				= settings.backgroundColor;
			}
			if (jQuery(this).data('animation-step') != undefined) {
				animationstep 			= parseFloat(jQuery(this).data('animation-step'));
			} else {
				animationstep 			= settings.animationStep;
			}
			if (jQuery(this).data('text') != undefined) {
				text 					= jQuery(this).data('text');
				if (text.length != 0) {
					textPre				= jQuery(this).data('prefix');
					textPost			= jQuery(this).data('postfix');
				} else {
					text				= "";
					textPre				= "";
					textPost			= "";
				}
				if (jQuery(this).data('icon') != undefined) {
					if (jQuery(this).data('icon-position') != undefined) {
						iconPosition 	= jQuery(this).data('icon-position');
					} else {
						iconPosition 	= iconPosition;
					}
					if (jQuery(this).data('icon-color') != undefined) {
						iconColor 		= jQuery(this).data('icon-color');
					} else {
						iconColor 		= iconColor;
					}
					if (text.length != 0) {
						icon			= '<i id="' + counterID + '-icon" class="ts-font-icon circle-icon ' + jQuery(this).data('icon') + '" style="color: ' + iconColor + '; font-size: inherit; line-height: inherit;"></i>';
					} else {
						icon			= '<i id="' + counterID + '-icon" class="ts-font-icon circle-icon ' + jQuery(this).data('icon') + '" style="color: ' + iconColor + '; font-size: ' + size + 'px; line-height: ' + dimension + 'px;"></i>';
					}
				}
				if (jQuery(this).data('type') != undefined) {
					type 				= jQuery(this).data('type');
					if (type == 'half') {
						if (iconPosition == "left") {
							jQuery(this).append('<span id="' + counterID + '-text" class="circle-text-half">' + icon + textPre + '<span id="' + counterID + '-value" class="circle-text-value">' + text + '</span>' + textPost + '</span>');
						} else if (iconPosition == "right") {
							jQuery(this).append('<span id="' + counterID + '-text" class="circle-text-half">' + textPre + '<span id="' + counterID + '-value" class="circle-text-value">' + text + '</span>' + textPost + icon + '</span>');
						}
						jQuery(this).find('.circle-text-half').css({'line-height': (dimension / 1.45) + 'px', 'font-size' : size + 'px' });
					} else {
						if (iconPosition == "left") {
							jQuery(this).append('<span id="' + counterID + '-text" class="circle-text">' + icon + textPre + '<span id="' + counterID + '-value" class="circle-text-value">' + text + '</span>' + textPost + '</span>');
						} else if (iconPosition == "right") {
							jQuery(this).append('<span id="' + counterID + '-text" class="circle-text">' + textPre + '<span id="' + counterID + '-value" class="circle-text-value">' + text + '</span>' + textPost + icon + '</span>');
						}
						if (jQuery(this).data('info') != undefined) {
							jQuery(this).find('.circle-text').css({'line-height': size + 'px', 'font-size': size + 'px', 'padding-top': ((dimension * 0.5) - (size * 0.75)) + 'px'});
						} else {
							jQuery(this).find('.circle-text').css({'line-height': dimension + 'px', 'font-size' : size + 'px' });
						}
					}
				} else {
					if (iconPosition == "left") {
						jQuery(this).append('<span id="' + counterID + '-text" class="circle-text">' + icon + '<span class="circle-text-value">' + text + '</span></span>');
					} else if (iconPosition == "right") {
						jQuery(this).append('<span id="' + counterID + '-text" class="circle-text">' + '<span class="circle-text-value">' + text + '</span>' + icon + '</span>');
					}
					if (jQuery(this).data('info') != undefined) {
						jQuery(this).find('.circle-text').css({'line-height': size + 'px', 'font-size': size + 'px', 'padding-top': ((dimension * 0.5) - (size * 0.75)) + 'px'});
					} else {
						jQuery(this).find('.circle-text').css({'line-height': dimension + 'px', 'font-size' : size + 'px' });
					}
				}
			} else if (jQuery(this).data('icon') != undefined) {
			
			}
			if (jQuery(this).data('info') != undefined) {
				info = jQuery(this).data('info');
				if (jQuery(this).data('type') != undefined) {
					type 			= jQuery(this).data('type');
					if(type == 'half') { 
						jQuery(this).append('<span class="circle-info-half">' + info + '</span>');
						jQuery(this).find('.circle-info-half').css({'line-height': (dimension * 0.99) + 'px', 'font-size': (size * 0.4) + 'px' });
					} else {
						jQuery(this).append('<span id="' + counterID + '-info" class="circle-info">' + info + '</span>');
						//jQuery(this).find('.circle-info').css({'line-height': (size * 0.40) + 'px', 'font-size': (size * 0.40) + 'px', 'padding-top': ((dimension * 0.5) + (size * 0.40)) + 'px' });
						jQuery(this).find('.circle-info').css({'padding-top': ((dimension * 0.5) + (size * 0.33)) + 'px' });
					}
				} else {
					jQuery(this).append('<span id="' + counterID + '-info" class="circle-info">' + info + '</span>');
					//jQuery(this).find('.circle-info').css({'line-height': (size * 0.40) + 'px', 'font-size': (size * 0.40) + 'px', 'padding-top': ((dimension * 0.5) + (size * 0.40)) + 'px' });
					jQuery(this).find('.circle-info').css({'padding-top': ((dimension * 0.5) + (size * 0.33)) + 'px' });
				}
			}
			jQuery(this).width(dimension + 'px');
			var canvas 				= jQuery('<canvas></canvas>').attr({ width: dimension, height: dimension }).appendTo(jQuery(this)).get(0);
			var context 			= canvas.getContext('2d');
			var x 					= canvas.width / 2;
			var y 					= canvas.height / 2;
			var degrees 			= percent * 360.0;
			var radians 			= degrees * (Math.PI / 180);
			//var radius 			= canvas.width / 2.5;
			var radius 				= canvas.width / 2 - width / 2 - 1;
			var startAngle 			= 2.3 * Math.PI;
			var endAngle 			= 0;
			var counterClockwise 	= false;
			var curPerc 			= animationstep === 0.0 ? endPercent : 0.0;
			var curStep 			= Math.max(animationstep, 0.0);
			var circ 				= Math.PI * 2;
			var quart 				= Math.PI / 2;
			var type 				= '';
			var fill 				= false;
			if (jQuery(this).data('type') != undefined) {
				type = jQuery(this).data('type');
				if(type == 'half') {
					var startAngle 	= 2.0 * Math.PI;
					var endAngle 	= 3.13;
					var circ 		= Math.PI * 1.0;
					var quart 		= Math.PI / 0.996;
				}
			}
			if (jQuery(this).data('fill') != undefined) {
				fill 				= jQuery(this).data('fill');
			} else {
				fill 				= settings.fillColor;
			}
			//animate foreground circle
			function animate(current) {
				context.clearRect(0, 0, canvas.width, canvas.height);
				context.beginPath();
				context.arc(x, y, radius, endAngle, startAngle, false);
				context.lineWidth 	= width - 1;
				// Line Background Color
				context.strokeStyle	= bgcolor;
				context.stroke();
				if(fill) {
					context.fillStyle = fill;
					context.fill();
				}
				context.beginPath();
				context.arc(x, y, radius, -(quart), ((circ) * current) - quart, false);
				context.lineWidth 	= width;
				// Line Foreground Color
				context.strokeStyle = fgcolor;
				context.stroke();
				if (curPerc < endPercent) {
					curPerc += curStep;
					requestAnimationFrame(function () {
						animate(Math.min(curPerc, endPercent) / 100);
					});
				} else {
					// Animation Completed
				}
			}
			jQuery('#' + counterID + '-info').fitText(1.50, {
				'lineHeight': 		true
			});
			if ((text.length != 0) && (icon.length != 0)) {
				jQuery('#' + counterID + '-text').fitText(0.75, {
					'lineHeight': 		false
				});
			};
			if ((text.length == 0) && (info.length == 0) && (icon.length != 0)) {
				jQuery('#' + counterID + '-text').css({'line-height': dimension + 'px'});
				jQuery('#' + counterID + '-icon').css({'line-height': dimension + 'px', 'font-size': radius + 'px'});
			}
			if ((text.length != 0) && (info.length == 0) && (icon.length == 0)) {
				jQuery('#' + counterID + '-text').css({'line-height': dimension + 'px', 'font-size': radius + 'px'});
			}
			jQuery(this).attr("data-size", jQuery(this).parent().width());
            jQuery(this).waypoint({
                handler: function(direction) {
					jQuery(this).attr("data-view", "true");
					// Start Number Animation
					if (text.length != 0) {
						var $counter_decimals 	= jQuery(this).attr("data-decimals");
						var $counter_grouper 	= jQuery(this).attr("data-group");
						var $counter_seperator 	= jQuery(this).attr("data-seperator");
						var countValue = new countUp(counterID + '-value', 0, text, parseInt($counter_decimals), 1.5, {
							useEasing :         true,
							useGrouping :       true,
							separator :         $counter_grouper,
							decimal :           $counter_seperator
						});
						countValue.start();
					}
					// Start Circle Animation
					animate(curPerc / 100);
                },
                offset: 			'85%',
                triggerOnce: 		true
            });
		});
	};
}( jQuery ));