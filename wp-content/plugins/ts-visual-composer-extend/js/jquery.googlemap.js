/* Google Map with styles and Directions
 * (c) Tekanewa Scripts 2014
 * /

/* Define Custom Google Map Styles */
/* ------------------------------- */
// Global Style Holder
var $google_roadmap_style		= [];
// Default
var $style_default				= [];
// Pale Dawn
var $style_pale_dawn 			= [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]},{"featureType":"landscape","stylers":[{"color":"#f2e5d4"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}];
// Subtle Grayscale
var $style_subtle_grayscale 	= [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];
// Blue Water
var $style_blue_water			= [{"featureType":"water","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"landscape","stylers":[{"color":"#f2f2f2"}]},{"featureType":"road","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]}];
// Midnight Commander
var $style_midnight_commander	= [{"featureType":"water","stylers":[{"color":"#021019"}]},{"featureType":"landscape","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"transit","stylers":[{"color":"#146474"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]}];
// Retro
var $style_retro				= [
								   {"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"water","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"transit","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"landscape","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"road.highway","stylers":[{"visibility":"off"}]},
								   {"featureType":"road.local","stylers":[{"visibility":"on"}]},
								   {"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},
								   {"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-17},{"gamma":0.36}]},
								   {"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#3f518c"}]}
								];
// Shades of Grey
var $style_shades_grey			= [
								   {"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},
								   {"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},
								   {"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},
								   {"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},
								   {"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},
								   {"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},
								   {"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},
								   {"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},
								   {"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},
								   {"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}
								];
// Gowalla
var $style_gowalla				= [
								   {"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},
								   {"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},
								   {"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"off"}]},
								   {"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},
								   {"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},
								   {"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]},
								   {"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]}
								];
// Light Monochrome
var $style_light_monochrome		= [
								   {"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},
								   {"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},
								   {"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},
								   {"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},
								   {"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},
								   {"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},
								   {"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},
								   {"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},
								   {"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}
								];
// Greyscale
var $style_greyscale			= [{"featureType":"all","stylers":[{"saturation":-100},{"gamma":0.5}]}];
// Subtle
var $style_subtle				= [
								   {"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},
								   {"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},
								   {"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},
								   {"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},
								   {"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},
								   {"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},
								   {"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},
								   {"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}
								];
// Paper
var $style_paper				= [
								   {"featureType":"administrative","stylers":[{"visibility":"off"}]},
								   {"featureType":"poi","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"road","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"water","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"transit","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"landscape","stylers":[{"visibility":"simplified"}]},
								   {"featureType":"road.highway","stylers":[{"visibility":"off"}]},
								   {"featureType":"road.local","stylers":[{"visibility":"on"}]},
								   {"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},
								   {"featureType":"road.arterial","stylers":[{"visibility":"off"}]},
								   {"featureType":"water","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{},
								   {"featureType":"road.highway","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},
								   {"featureType":"road"},{},{"featureType":"landscape","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}
								];
// Neutral Blue
var $style_neutral_blue			= [
								   {"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]},
								   {"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},
								   {"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},
								   {"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},
								   {"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},
								   {"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},
								   {"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},
								   {"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}
								];
// Bright & Bubbly
var $style_bright_bubbly		= [{"featureType":"water","stylers":[{"color":"#19a0d8"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"weight":6}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#e85113"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efe9e4"},{"lightness":-40}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#efe9e4"},{"lightness":-20}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"lightness":-100}]},{"featureType":"road.highway","elementType":"labels.icon"},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"lightness":20},{"color":"#efe9e4"}]},{"featureType":"landscape.man_made","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":-100}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"hue":"#11ff00"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"hue":"#4cff00"},{"saturation":58}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#f0e4d3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#efe9e4"},{"lightness":-25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#efe9e4"},{"lightness":-10}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"simplified"}]}];
// Apple Mapsesque
var $style_apple_mapsesque		= [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]}];
// Shift Worker
var $style_shift_worker			= [{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}];
// Avocado World
var $style_avocado_world		= [{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}];
// Mapbox
var $style_mapbox				= [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}];
// Countries
var $style_countries			= [{"featureType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"lightness":-100}]}];
// Lunar Landscape
var $style_lunar_landscape		= [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}];
// Snazzy Maps
var $style_snazzy_maps			= [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#333739"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2ecc71"}]},{"featureType":"poi","stylers":[{"color":"#2ecc71"},{"lightness":-7}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"lightness":-28}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"visibility":"on"},{"lightness":-15}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"lightness":-18}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2ecc71"},{"lightness":-34}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#333739"},{"weight":0.8}]},{"featureType":"poi.park","stylers":[{"color":"#2ecc71"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#333739"},{"weight":0.3},{"lightness":10}]}];

// Create Global Array of Available Map Styles
var $map_styles_array = [
	{
		Name: 	'Default', 
		Code: 	'DEFAULT',
		String:	'$style_default'
	},
	{
		Name: 	'Pale Dawn', 
		Code: 	'PALEDAWN',
		String:	'$style_pale_dawn'
	},
	{
		Name: 	'Blue Water', 
		Code: 	'BLUEWATER',
		String:	'$style_blue_water'
	},
	{
		Name: 	'Midnight Commander', 
		Code: 	'MIDNIGHTCOMMANDER',
		String:	'$style_midnight_commander'
	},
	{
		Name: 	'Retro', 
		Code: 	'RETRO',
		String:	'$style_retro'
	},
	{
		Name: 	'Shades of Grey', 
		Code: 	'SHADESGREY',
		String:	'$style_shades_grey'
	},
	{
		Name: 	'Gowalla', 
		Code: 	'GOWALLE',
		String:	'$style_gowalla'
	},
	{
		Name: 	'Light Monochrome', 
		Code: 	'LIGHTMONOCHROME',
		String:	'$style_light_monochrome'
	},
	{
		Name: 	'Greyscale', 
		Code: 	'GREYSCALE',
		String:	'$style_greyscale'
	},
	{
		Name: 	'Subtle', 
		Code: 	'SUBTLE',
		String:	'$style_subtle'
	},
	{
		Name: 	'Paper', 
		Code: 	'PAPER',
		String:	'$style_paper'
	},
	{
		Name: 	'Neutral Blue', 
		Code: 	'NEUTRALBLUE',
		String:	'$style_neutral_blue'
	},
	{
		Name: 	'Bright & Bubbly', 
		Code: 	'BRIGHTBUBBLY',
		String:	'$style_bright_bubbly'
	},
	{
		Name: 	'Apple Maps-Esque', 
		Code: 	'APPLEMAPS',
		String:	'$style_apple_mapsesque'
	},
	{
		Name: 	'Shift Worker', 
		Code: 	'SHIFTWORKER',
		String:	'$style_shift_worker'
	},
	{
		Name: 	'Avocado World', 
		Code: 	'AVOCADOWORLD',
		String:	'$style_avocado_world'
	},
	{
		Name: 	'Map Box', 
		Code: 	'MAPBOX',
		String:	'$style_mapbox'
	},
	{
		Name: 	'Countries', 
		Code: 	'COUNTRIES',
		String:	'$style_countries'
	},
	{
		Name: 	'Lunar Landscape', 
		Code: 	'LUNAR',
		String:	'$style_lunar_landscape'
	},
	{
		Name: 	'Snazzy Maps', 
		Code: 	'SNAZZYMAPS',
		String:	'$style_snazzy_maps'
	},
];


(function($){
	// FUNCTION TO PRINT ROUTE INFO
	function print_route(panel, PrintoutText){
		var width  				= 800;
		var height 				= 500;
		var left   				= (screen.width  - width)/2;
		var top    				= (screen.height - height)/2;
		var params 				= 'width=' + width + ', height=' + height;
		
		params += ', top='+top+', left='+left;
		params += ', directories=no';
		params += ', location=no';
		params += ', menubar=no';
		params += ', resizable=no';
		params += ', scrollbars=no';
		params += ', status=no';
		params += ', toolbar=no';
		
		var a 					= window.open('', '', params);
		a.document.open("text/html", "replace");
		a.document.writeln("<html>");
		a.document.writeln("<head>");
		a.document.writeln("<title>Directions</title>");
		a.document.writeln("<style>");
		a.document.writeln("body {font-family: Verdana}");
		a.document.writeln("</style>");
		a.document.writeln("</head>");
		a.document.writeln("<body>");
		a.document.writeln("<b>Directions:</b><br/>");
		a.document.writeln(PrintoutText);
		a.document.writeln("<hr><br/>");
		a.document.writeln(panel.html());
		a.document.writeln("<hr><br/>");
		a.document.writeln("</body></html>");
		a.document.close();
		a.print();
	}

	function buildMap(imap, geocode, iaddress, info_window, zoom, icon, maptype, mapstyle, IconAnimation, AnimationTypeShort, AnimationTypeLong, PanControl, ZoomControl, ScaleControl, StreetControl, StyleControl, DistanceUnit){
		var myLatlng	= "";
		var ZoomLevel	= zoom;
		
		// Add OpenStreetMap to Map Types
		var mapTypeIds 	= [];
		for(var type in google.maps.MapTypeId) {
			mapTypeIds.push(google.maps.MapTypeId[type]);
		};
		
		// Add OpenStreet to Map Types
		mapTypeIds.push("OSM");
		
		// Define Options for Google Map
		var map;
		if ((maptype != "OSM") && (maptype != "osm")) {
			maptype = eval("google.maps.MapTypeId." + maptype.toUpperCase());
		} else {
			maptype = maptype.toUpperCase();
		};
		
		map = new google.maps.Map(imap, {
			zoom: 		zoom,
			mapTypeId: 	maptype,
			mapTypeControlOptions: {
				mapTypeIds: 	mapTypeIds,
				style: 			google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: 		google.maps.ControlPosition.TOP_LEFT
			},
			panControl: 		PanControl,
			panControlOptions: {
				position: 		google.maps.ControlPosition.LEFT_TOP
			},
			zoomControl: 		ZoomControl,
			zoomControlOptions: {
			  style: 			google.maps.ZoomControlStyle.DEFAULT,
			  position: 		google.maps.ControlPosition.LEFT_TOP
			},
			scaleControl: 		ScaleControl,
			scaleControlOptions: {
				position: 		google.maps.ControlPosition.LEFT_TOP
			},
			streetViewControl:	StreetControl,
			streetViewControlOptions: {
				position: 		google.maps.ControlPosition.LEFT_TOP
			},
			styles: 			eval(mapstyle)
		});

		// Add Custom Map Styles to Google Map
		if (StyleControl == true) {
			for (var x=0; x < $map_styles_array.length; x++) {
				var $style_name 	= $map_styles_array[x].Name;
				var $style_code 	= $map_styles_array[x].Code;
				var $style_string 	= $map_styles_array[x].String;
				map.mapTypes.set($style_code, new google.maps.StyledMapType(eval($style_string), {name: $style_name}));
			};
		};
		
		// Add OpenstreetMap Control to Map
		map.mapTypes.set("OSM", new google.maps.ImageMapType({
			getTileUrl: function(coord, zoom) {
				return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
			},
			tileSize: 			new google.maps.Size(256, 256),
			name: 				"Open Street",
			maxZoom: 			18
		}));
		
		// Add Road Map Style Selector
		if (StyleControl == true) {
			var controlTypeUI = document.createElement('SELECT');
			var maptypes 	= '';
			for (var x=0; x < $map_styles_array.length; x++) {
				var $style_name 	= $map_styles_array[x].Name;
				var $style_code 	= $map_styles_array[x].Code;
				var $style_string 	= $map_styles_array[x].String;
				if ($style_string == mapstyle) {
					maptypes	+= '<option value="' + $style_code + '" selected="selected">' + $style_name + '</option>';
				} else {
					maptypes	+= '<option value="' + $style_code + '">' + $style_name + '</option>';
				}
			};
			jQuery(controlTypeUI).addClass('gmap-control-select');
			jQuery(controlTypeUI).html(maptypes);
			google.maps.event.addDomListener(controlTypeUI, 'change', function() {
				map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				map.setMapTypeId(jQuery(this).val());
			});
			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlTypeUI);
		};

		// Add Traffic Layer
		var controlDiv = document.createElement('DIV');
		jQuery(controlDiv).addClass('gmap-control-container');
		jQuery(controlDiv).addClass('gmnoprint');
		var controlUI = document.createElement('DIV');
		jQuery(controlUI).addClass('gmap-control');
		jQuery(controlUI).text($languageTextMapTraffic);
		jQuery(controlDiv).append(controlUI);
		if (DistanceUnit == 1) {
			var legend = '<ul>'
					   + '<li><span style="background-color: #30ac3e">&nbsp;&nbsp;</span><span style="color: #30ac3e"> > 80 ' + $languageTextMapSpeedKM + '</span></li>'
					   + '<li><span style="background-color: #ffcf00">&nbsp;&nbsp;</span><span style="color: #ffcf00"> 40 - 80 ' + $languageTextMapSpeedKM + '</span></li>'
					   + '<li><span style="background-color: #ff0000">&nbsp;&nbsp;</span><span style="color: #ff0000"> < 40 ' + $languageTextMapSpeedKM + '</span></li>'
					   + '<li><span style="background-color: #c0c0c0">&nbsp;&nbsp;</span><span style="color: #c0c0c0"> ' + $languageTextMapNoData + '</span></li>'
					   + '</ul>';
		} else {
			var legend = '<ul>'
					   + '<li><span style="background-color: #30ac3e">&nbsp;&nbsp;</span><span style="color: #30ac3e"> > 50 ' + $languageTextMapSpeedMiles + '</span></li>'
					   + '<li><span style="background-color: #ffcf00">&nbsp;&nbsp;</span><span style="color: #ffcf00"> 25 - 50 ' + $languageTextMapSpeedMiles + '</span></li>'
					   + '<li><span style="background-color: #ff0000">&nbsp;&nbsp;</span><span style="color: #ff0000"> < 25 ' + $languageTextMapSpeedMiles + '</span></li>'
					   + '<li><span style="background-color: #c0c0c0">&nbsp;&nbsp;</span><span style="color: #c0c0c0"> ' + $languageTextMapNoData + '</span></li>'
					   + '</ul>';
		}
		var controlLegend = document.createElement('DIV');
		jQuery(controlLegend).addClass('gmap-control-legend');
		jQuery(controlLegend).html(legend);
		jQuery(controlLegend).hide();
		jQuery(controlDiv).append(controlLegend);
		jQuery(controlUI).mouseenter(function() {
			jQuery(controlLegend).show();
		})
		jQuery(controlUI).mouseleave(function() {
			jQuery(controlLegend).hide();
		});
		var trafficLayer = new google.maps.TrafficLayer();
		google.maps.event.addDomListener(controlUI, 'click', function() {
			if (typeof trafficLayer.getMap() == 'undefined' || trafficLayer.getMap() === null) {
				jQuery(controlUI).addClass('gmap-control-active');
				map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				trafficLayer.setMap(map);
			} else {
				trafficLayer.setMap(null);
				jQuery(controlUI).removeClass('gmap-control-active');
			}
		});
		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
		
		// Add Bicycle Layer
		var controlBikeDiv = document.createElement('DIV');
		jQuery(controlBikeDiv).addClass('gmap-control-container');
		jQuery(controlBikeDiv).addClass('gmnoprint');
		var controlBikeUI = document.createElement('DIV');
		jQuery(controlBikeUI).addClass('gmap-control');
		jQuery(controlBikeUI).text($languageTextMapBikes);
		jQuery(controlBikeDiv).append(controlBikeUI);
		var bikeLayer = new google.maps.BicyclingLayer();
		google.maps.event.addDomListener(controlBikeUI, 'click', function() {
			if (typeof bikeLayer.getMap() == 'undefined' || bikeLayer.getMap() === null) {
				jQuery(controlBikeUI).addClass('gmap-control-active');
				map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				bikeLayer.setMap(map);
			} else {
				bikeLayer.setMap(null);
				jQuery(controlBikeUI).removeClass('gmap-control-active');
			}
		});
		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlBikeDiv);
		
		// Create the DIV to hold the Home Control
		var homeControlDiv = document.createElement('DIV');
		jQuery(homeControlDiv).addClass('gmap-control-container');
		jQuery(homeControlDiv).addClass('gmnoprint');
		var controlHomeUI = document.createElement('DIV');
		jQuery(controlHomeUI).addClass('gmap-control-Home');
		jQuery(controlHomeUI).text($languageTextMapHome);
		jQuery(homeControlDiv).append(controlHomeUI);
		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
		google.maps.event.addDomListener(controlHomeUI, 'click', function() {
			map.setCenter(myLatlng);
			map.setZoom(ZoomLevel);
		});
		
		// Listener for Changes in MapType
		google.maps.event.addListener(map, 'maptypeid_changed', function(e){
			if (map.getMapTypeId() == "OSM"){
				jQuery(controlBikeUI).addClass('gmap-control-Hide');
				jQuery(controlUI).addClass('gmap-control-Hide');
			} else {
				jQuery(controlBikeUI).removeClass('gmap-control-Hide');
				jQuery(controlUI).removeClass('gmap-control-Hide');
			}
		});
		if (map.getMapTypeId() == "OSM"){
			jQuery(controlBikeUI).addClass('gmap-control-Hide');
			jQuery(controlUI).addClass('gmap-control-Hide');
		} else {
			jQuery(controlBikeUI).removeClass('gmap-control-Hide');
			jQuery(controlUI).removeClass('gmap-control-Hide');
		}
		
		// Add One Time Event Listener for when Map is fully loaded
		google.maps.event.addListenerOnce(map, 'idle', function(){
			/*if (ResetOpenPanel == true) {
				jQuery('#MainPanel').click ();
			};*/
		});
		
		// Listener for Screen Size Changes
		google.maps.event.addDomListener(window, 'resize', function() {
			google.maps.event.trigger(map, "resize");
			map.setCenter(myLatlng);
		});
		
		// Geocode of provided Location
		var address 	= iaddress;
		
		if (geocode == true) {
			var geocoder	= new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					myLatlng = results[0].geometry.location;
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				};
			});
		} else {
			address 		= address.replace(" ", "");
			$coordinates 	= address.split(',');
			myLatlng = new google.maps.LatLng($coordinates[0], $coordinates[1])
		};

		map.setCenter(myLatlng);
		if (IconAnimation == true) {
			var marker = new google.maps.Marker({
				map: 		map,
				position: 	myLatlng,
				draggable: 	false,
				icon:		icon,
				animation: 	AnimationTypeLong,
				content: 	info_window
			});
			if (AnimationTypeShort == "bounce") {
				google.maps.event.addListener(marker, 'dblclick', function() {
					if (marker.getAnimation() != null) {
						marker.setAnimation(null);
					} else {
						marker.setAnimation(google.maps.Animation.BOUNCE);
					};
				});
			};
		} else {
			var marker = new google.maps.Marker({
				map: 		map,
				position: 	myLatlng,
				draggable: 	false,
				icon:		icon,
				content: 	info_window
			});
		}
		if (info_window != ''){
			/*var infowindow = new google.maps.InfoWindow({
				content: info_window
			});   
			infowindow.open(map, marker);
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);              
			});*/
			var infobox = new InfoBox({
				content: 			info_window,
				alignBottom:		false,
				boxClass:			'infoBox',
				disableAutoPan: 	false,
				maxWidth: 			400,
				pixelOffset: 		new google.maps.Size(-200, 0),
				zIndex: 			null,
				boxStyle: {
					//background: 	"url('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/examples/tipbox.gif') no-repeat",
					opacity: 		0.75,
					width: 			"400px"
				},
				closeBoxMargin: 	"12px 4px 2px 2px",
				closeBoxURL: 		"http://www.google.com/intl/en_us/mapfiles/close.gif",
				infoBoxClearance: 	new google.maps.Size(1, 1)
			});
			google.maps.event.addListener(marker, 'click', function() {
				infobox.open(map, this);
				map.panTo(myLatlng);
			});
		};
		
		// Set Timeout Function
		setTimeout(function(){
			jQuery('.ts-map-container').find('img').css({
				'max-width':	'none',
				'max-height':	'none'
			});
		},500);
	};

	function redrawMap(imap, iaddress, info_window, zoom, maptype, mapstyle, ipanel, start, end, wp, travel_mode_select, opt_wp, printable_panel, DivContainerDistance, RoadMapStyle, DistanceUnit, Indication, PrintRoute, ResetMap, PanControl, ZoomControl, ScaleControl, StreetControl) {
		var directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
		var directionsService = new google.maps.DirectionsService();
		var oldDirections = [];
		var currentDirections;

		var myLatlng	= "";
		var ZoomLevel	= zoom;
		
		// Add OpenStreetMap to Map Types
		var mapTypeIds 	= [];
		for(var type in google.maps.MapTypeId) {
			mapTypeIds.push(google.maps.MapTypeId[type]);
		};
		
		if ((maptype != "OSM") && (maptype != "osm")) {
			maptype = eval("google.maps.MapTypeId." + maptype.toUpperCase());
		} else {
			maptype = maptype.toUpperCase();
		};
		
		var myOptions = {
			zoom: 				zoom,
			mapTypeId: 			maptype,
			mapTypeControlOptions: {
				mapTypeIds: 	mapTypeIds,
				style: 			google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: 		google.maps.ControlPosition.TOP_LEFT
			},
			panControl: 		PanControl,
			panControlOptions: {
				position: 		google.maps.ControlPosition.LEFT_TOP
			},
			zoomControl: 		ZoomControl,
			zoomControlOptions: {
			  style: 			google.maps.ZoomControlStyle.DEFAULT,
			  position: 		google.maps.ControlPosition.LEFT_TOP
			},
			scaleControl: 		ScaleControl,
			scaleControlOptions: {
				position: 		google.maps.ControlPosition.LEFT_TOP
			},
			streetViewControl:	StreetControl,
			streetViewControlOptions: {
				position: 		google.maps.ControlPosition.LEFT_TOP
			},
			styles: 			$style_default
		};
		map = new google.maps.Map(imap, myOptions);
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(ipanel); 
		google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
			if (currentDirections) {
				oldDirections.push(currentDirections);
			}
			currentDirections = directionsDisplay.getDirections();  
			computeTotalDistance(directionsDisplay.directions, DivContainerDistance, DistanceUnit, Indication, PrintRoute, ResetMap);
		});    
		
		// Add OpenstreetMap Control to Map
		map.mapTypes.set("OSM", new google.maps.ImageMapType({
			getTileUrl: function(coord, zoom) {
				return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
			},
			tileSize: 			new google.maps.Size(256, 256),
			name: 				"Open Street",
			maxZoom: 			18
		}));
		
		// Add Traffic Layer
		var controlDiv = document.createElement('DIV');
		jQuery(controlDiv).addClass('gmap-control-container');
		jQuery(controlDiv).addClass('gmnoprint');
		var controlUI = document.createElement('DIV');
		jQuery(controlUI).addClass('gmap-control');
		jQuery(controlUI).text($languageTextMapTraffic);
		jQuery(controlDiv).append(controlUI);
		if (DistanceUnit == 1) {
			var legend = '<ul>'
					   + '<li><span style="background-color: #30ac3e">&nbsp;&nbsp;</span><span style="color: #30ac3e"> > 80 ' + $languageTextMapSpeedKM + '</span></li>'
					   + '<li><span style="background-color: #ffcf00">&nbsp;&nbsp;</span><span style="color: #ffcf00"> 40 - 80 ' + $languageTextMapSpeedKM + '</span></li>'
					   + '<li><span style="background-color: #ff0000">&nbsp;&nbsp;</span><span style="color: #ff0000"> < 40 ' + $languageTextMapSpeedKM + '</span></li>'
					   + '<li><span style="background-color: #c0c0c0">&nbsp;&nbsp;</span><span style="color: #c0c0c0"> ' + $languageTextMapNoData + '</span></li>'
					   + '</ul>';
		} else {
			var legend = '<ul>'
					   + '<li><span style="background-color: #30ac3e">&nbsp;&nbsp;</span><span style="color: #30ac3e"> > 50 ' + $languageTextMapSpeedMiles + '</span></li>'
					   + '<li><span style="background-color: #ffcf00">&nbsp;&nbsp;</span><span style="color: #ffcf00"> 25 - 50 ' + $languageTextMapSpeedMiles + '</span></li>'
					   + '<li><span style="background-color: #ff0000">&nbsp;&nbsp;</span><span style="color: #ff0000"> < 25 ' + $languageTextMapSpeedMiles + '</span></li>'
					   + '<li><span style="background-color: #c0c0c0">&nbsp;&nbsp;</span><span style="color: #c0c0c0"> ' + $languageTextMapNoData + '</span></li>'
					   + '</ul>';
		}
		var controlLegend = document.createElement('DIV');
		jQuery(controlLegend).addClass('gmap-control-legend');
		jQuery(controlLegend).html(legend);
		jQuery(controlLegend).hide();
		jQuery(controlDiv).append(controlLegend);
		jQuery(controlUI).mouseenter(function() {
			jQuery(controlLegend).show();
		})
		jQuery(controlUI).mouseleave(function() {
			jQuery(controlLegend).hide();
		});
		var trafficLayer = new google.maps.TrafficLayer();
		google.maps.event.addDomListener(controlUI, 'click', function() {
			if (typeof trafficLayer.getMap() == 'undefined' || trafficLayer.getMap() === null) {
				jQuery(controlUI).addClass('gmap-control-active');
				map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				trafficLayer.setMap(map);
			} else {
				trafficLayer.setMap(null);
				jQuery(controlUI).removeClass('gmap-control-active');
			}
		});
		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
		
		// Add Bicycle Layer
		var controlBikeDiv = document.createElement('DIV');
		jQuery(controlBikeDiv).addClass('gmap-control-container');
		jQuery(controlBikeDiv).addClass('gmnoprint');
		var controlBikeUI = document.createElement('DIV');
		jQuery(controlBikeUI).addClass('gmap-control');
		jQuery(controlBikeUI).text($languageTextMapBikes);
		jQuery(controlBikeDiv).append(controlBikeUI);
		var bikeLayer = new google.maps.BicyclingLayer();
		google.maps.event.addDomListener(controlBikeUI, 'click', function() {
			if (typeof bikeLayer.getMap() == 'undefined' || bikeLayer.getMap() === null) {
				jQuery(controlBikeUI).addClass('gmap-control-active');
				map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				bikeLayer.setMap(map);
			} else {
				bikeLayer.setMap(null);
				jQuery(controlBikeUI).removeClass('gmap-control-active');
			}
		});
		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlBikeDiv);
		
		var waypts 	= [];
		var dest 	= wp;
		
		var SystemUnit;
		if (DistanceUnit == 1) {
			SystemUnit = google.maps.DirectionsUnitSystem.METRIC
		} else {
			SystemUnit = google.maps.DirectionsUnitSystem.IMPERIAL
		};
		
		var request	= {
			origin: 				start,
			destination: 			end,
			waypoints:				waypts,
			unitSystem: 			SystemUnit,
			optimizeWaypoints:		opt_wp,
			travelMode: 			google.maps.DirectionsTravelMode[travel_mode_select]
		};    
		for (var i = 0; i < dest.length; i++) {
			if (dest[i].value != "") {
				waypts.push({
					location:		dest[i].value,
					stopover:		true
				});
			}
		}; 
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
				printable_panel.html('');
				var route = response.routes[0];
				for (var i = 0; i < route.legs.length; i++) {
					var routeSegment = i + 1;
					printable_panel.append("<b>Route Segment: "
					+ routeSegment
					+ "</b><br/>"
					+ "From: "
					+ route.legs[i].start_address
					+ "<br/>"
					+ "To: "
					+ route.legs[i].end_address
					+ "<br/>"
					+ "Distance: "
					+ route.legs[i].distance.text
					+ "<br/><br/>");
				}        
			};
			if (status != 'OK'){
				//alert(status);
				jQuery(ResetMap).click();
				return false;
			};
			setTimeout(function(){
				jQuery('.ts-map-container').find('img').css({
					'max-width':	'none',
					'max-height':	'none'
				});
			},500);
		}); 
		setTimeout(function(){
			jQuery('.ts-map-container').find('img').css({
				'max-width':		'none',
				'max-height':		'none'
			});
		},500);
	}
	
	function computeTotalDistance(result, DivContainerDistance, DistanceUnit, Indication, PrintRoute, ResetMap) {
		var total 	= 0;
		var myroute = result.routes[0];
		for (i = 0; i < myroute.legs.length; i++) {
			total += myroute.legs[i].distance.value;
		};
		total = total / 1000;
		total = Math.round(total / DistanceUnit * 1000) / 1000;
		if (DistanceUnit == 1) {
			jQuery(DivContainerDistance).html($languageTextDistance + " " + total + " " + $languageTextMapKilometes);
		} else {
			jQuery(DivContainerDistance).html($languageTextDistance + " " + total + " " + $languageTextMapMiles);
		};
		jQuery(DivContainerDistance).show();
		jQuery(Indication).show();
		jQuery(PrintRoute).show();
		jQuery(ResetMap).show();
	} 
	// END GOOGLE MAP API
  
	$.fn.JQMap = function(options) {  
		/***************************************/
		/** List of available default options **/
		/***************************************/
		var defaults = {  
			// Individual Settings
			jqm_GeoCode				:	false,
			jqm_Height           	:	'600',						//--> Height of map container
			jqm_Width            	:	'800',						//--> Width of map container
			jqm_MapIcon				:	'',							//--> Path to map icon
			jqm_MapType				:	'ROADMAP',					//--> Initial Map Type
			jqm_MapStyle			:	'$style_default',			//--> Roadmap Style
			jqm_MapFullWidth		:	false,
			jqm_MapDirections		:	true,						//--> Show or hide the directions control panel
			jqm_PanControl			:	true,
			jqm_ZoomControl			:	true,
			jqm_ScaleControl		:	true,
			jqm_StreetControl		:	true,
			jqm_StyleControl		:	false,
			jqm_PercentCalcPanel 	:	'300',						//--> width in pixel of overlay calc panel
			jqm_PercentCalcDir   	:	'500',						//--> width in pixel of overlay directions panel
			jqm_StartOpacity     	:	10,							//--> start Opacity of search and direction overlay div
			jqm_Metric				:	false,						//--> If TRUE, Meters / km will be used instead of Miles and Yards
			jqm_TexStartPoint    	:	'',							//--> text of Info Window on page load
			jqm_Fixdestination   	:	'',							//--> Set a fix destination or map starting point
			jqm_TooltipContent		:	'',							//--> info window content
			jqm_ZoomStartPoint   	:	17,							//--> Initial Zoom Level for the map
			jqm_ShowTarget		 	:	true, 						//--> if FALSE, user will not be able to enter a target destination; jqm_Fixdestination will be used instead
			jqm_ShowBouncer		 	:	false, 						//--> if FALSE, no icon will be shown on the map
			jqm_Animation			:	true,						//--> if FALSE, the icon will not be animated
			jqm_AnimationType		:	'bounce',					//--> if icon is set to be animated, selected between 'bounce' or 'drop'
			jqm_StartPanel     		:	true,						//--> If TRUE, the map will open the data entry panel on page load
			// Global Settings
			jqm_OverlayColor     	:	'#FFFFFF',					//--> color of search and direction overlay div
			jqm_TextCalcShow        :	'Show Address Input',		//--> text of button to show calc form
			jqm_TextCalcHide        :	'Hide Address Input',		//--> text of button to hide calc form
			jqm_TextDirectionShow  	:	'Show Directions',			//--> text of button to show directions
			jqm_TextDirectionHide  	:	'Hide Directions',			//--> text of button to hide directions
			jqm_TextResetMap     	:	'Reset Map',				//--> text of button to reset map
			jqm_PrintRouteText   	:	'Print Route',				//--> text of print route button
			jqm_TextViewOnGoogle	:	'View on  Google',			//--> text of link to Google button
			jqm_WpExtra          	:	'You can use only 8 destinations plus point of origin.',
			jqm_TextButtonCalc   	:	'Show Route',										//--> text of button to calculate route
			jqm_TextSetTarget   	:	'Please enter your Start Address:',					//--> text of Instructions Div if final destination has been preset (jqm_ShowTarget: false)
			jqm_TextNoTarget   		:	'Please enter your Start and End Address:',			//--> text of Instructions Div if no final destination has been preset (jqm_ShowTarget: true)
			jqm_TextTravelMode   	:	'Travel Mode',										//--> text of travel mode select
			jqm_TextDriving      	:	'Driving',											//--> text DRIVING mode
			jqm_TextWalking      	:	'Walking',											//--> text WALKING mode
			jqm_TextBicy         	:	'Bicycling',										//--> text BICYCLING mode
			jqm_TextWP           	:	'Optimize Waypoints',								//--> text Optimize Waypoints
			jqm_TextButtonAdd    	:	'Add Stop on the Way',								//--> text of button to add a destination
		}; 
 
		var o = $.extend(defaults, options);

		var ResetGeoCode		= o.jqm_GeoCode;
		var ResetLatLng 		= o.jqm_Fixdestination;
		var ResetWidth 			= o.jqm_Width;
		var ResetFull			= o.jqm_MapFullWidth;
		var ResetType			= o.jqm_MapType;
		var ResetStyle			= o.jqm_MapStyle;
		var ResetPan			= o.jqm_PanControl;
		var ResetZoomer			= o.jqm_ZoomControl;
		var ResetScaler			= o.jqm_ScaleControl;
		var ResetStreet			= o.jqm_StreetControl;
		var ResetStyler			= o.jqm_StyleControl;
		var ResetMetric			= o.jqm_Metric;
		var ResetHeight 		= o.jqm_Height;
		var ResetDirections		= o.jqm_MapDirections;
		var ResetIcon			= o.jqm_MapIcon;
		var ResetZoom			= o.jqm_ZoomStartPoint;
		var ResetOpacity 		= o.jqm_StartOpacity;
		var ResetTarget 		= o.jqm_ShowTarget;
		var ResetBouncer 		= o.jqm_ShowBouncer;
		var ResetOpenPanel 		= o.jqm_StartPanel;
		var ResetDestination 	= o.jqm_Fixdestination;
		var ResetText 			= o.jqm_TexStartPoint;
		var ResetInfoWindow		= o.jqm_TooltipContent;
		var ResetAnimation		= o.jqm_Animation;
		var ResetAnimationType	= o.jqm_AnimationType;

		var PrintoutText 		= o.jqm_TexStartPoint;
		var ZoomLevel 			= o.jqm_ZoomStartPoint;
		var IconAnimation 		= o.jqm_Animation;

		if (o.jqm_Metric == false) {
			var DistanceUnit 	= 1.609344001;
		} else {
			var DistanceUnit 	= 1;
		};
		
		if (o.jqm_ShowTarget == true) {
			InfoText = o.jqm_TextNoTarget;
		} else {
			InfoText = o.jqm_TextSetTarget;
		};

		if (IconAnimation == true) {
			if (o.jqm_AnimationType == "bounce") {
				var AnimationTypeShort 	= "bounce";
				var AnimationTypeLong 	= google.maps.Animation.BOUNCE;
			} else if (o.jqm_AnimationType == "drop") {
				var AnimationTypeShort 	= "drop";
				var AnimationTypeLong 	= google.maps.Animation.DROP;
			}
		} else {
			var AnimationTypeShort 		= "";
			var AnimationTypeLong 		= "";
		}

		return this.each(function() {                       
			// Create map, form to calc route and info panel  
			var $this = jQuery(this);
			var $input_destination = '<div style="padding: 5px" class="container_dest">\
				<span id="waypoint_marker2"><img src="http://maps.gstatic.com/mapfiles/markers2/icon_greenB.png" alt="" style="vertical-align:middle" /></span>\
				<input type="text" value="" /><span class="ts-map-elimina" style="cursor:pointer; display: none"></span>\
			</div>';
			
			if(o.jqm_Width == '' || o.jqm_Width == 0){
				alert('You must provide a width in map setup to continue.')
				$this.html('You must provide a width in map setup to continue.')
				return false;
			}
			if(o.jqm_Height == '' || o.jqm_Height == 0){
				alert('You must provide a height in map setup to continue.')
				$this.html('You must provide a Height in map setup to continue.')
				return false;
			}       
			if( o.jqm_Fixdestination != ''){
				$input_destination = '<input type="hidden" value="' + o.jqm_Fixdestination + '" class="final_destination" />';
			}
		
			// Calculate Number of existing Maps
			var number_map = jQuery('.map').length + 1                    
			
			// Create Map Markup
			$this.css('width', o.jqm_Width + '%').html(''
				+'<div style="width: 100%;' + (o.jqm_MapDirections == false ? "display: none;": "") + '">'
					+'<span id="ResetMap-' + number_map + '" alt="Click here to reset the map to its original state and to remove all directions." class="ts-map-reset ts-map-resetmap">' + o.jqm_TextResetMap + '</span>'
					+'<span id="MainPanel-' + number_map + '" alt="Click here to open or close the panel to enter your address and other information." class="ts-map-toggle ts-map-route">' + o.jqm_TextCalcShow + '</span> '
					+'<span id="ShowDirections-' + number_map + '" alt="Click here to show your directions." class="ts-map-toggle ts-map-indication" style="display: none">' + o.jqm_TextDirectionShow + '</span> '
					+'<span id="TotalDistance-' + number_map + '" alt="This represents the total distance travelled for your selected route." class="ts-map-distance" style="display: none;"></span>'
					+'<span id="GoogleLink-' + number_map + '" class="ts-map-link"><a href="http://maps.google.com/maps?q=' + o.jqm_Fixdestination.replace(" ", "") + '+(My+Point)&z=14&ll=' + o.jqm_Fixdestination.replace(" ", "") + '" target="_blank">' + o.jqm_TextViewOnGoogle + '</a></span>'
				+'</div>'
				
				+'<div class="ts-map-container" style="height:' + o.jqm_Height + 'px; position: relative;">'
				+'<div class="ts-map-opacity-search" style="width:' + o.jqm_PercentCalcPanel + 'px; height:100%; position:absolute; top:0px; z-index:9; filter:alpha(opacity=' + o.jqm_StartOpacity*10 + ');-moz-opacity:'+o.jqm_StartOpacity/10+';opacity:'+o.jqm_StartOpacity/10+';background:'+o.jqm_OverlayColor+';left:0px;display:none"></div>'
				+'<div class="ts-map-opacity-panel" style="width:' + o.jqm_PercentCalcDir + 'px; height:100%; position:absolute;top:0px;z-index:9;filter:alpha(opacity='+o.jqm_StartOpacity*10+');-moz-opacity:'+o.jqm_StartOpacity/10+';opacity:'+o.jqm_StartOpacity/10+';background:'+o.jqm_OverlayColor+';right:0px;display:none"></div>'
				+'<div class="ts-map-main-panel" style="overflow:auto;width:' + o.jqm_PercentCalcDir + 'px; height:100%; position:absolute;top:0px;z-index:999;right:0px;display:none"></div>'
				+'<div class="ts-map-form-search" style="height:100%; width:' + o.jqm_PercentCalcPanel + 'px; display:none;">'

				+'<div class="ts-map-address ts-map-waypoints">'
					+'<div class="ts-map-instructions">' + InfoText + '</div>'
					+'<div style="padding:5px" class="container_dest">'
						+'<span id="waystop_marker1">'
						+'<img src="http://maps.gstatic.com/mapfiles/markers2/icon_greenA.png" alt="" style="vertical-align:middle" /></span>'
						+'<input alt="Enter your Home or Start Address here." class="" style="margin-left: 15px; margin-top: 10px; width: 200px;" type="text" value="" />'
						+'<span class="ts-map-elimina" alt="Click here to remove this waypoint." style="display: none;"></span>'
					+'</div>'
					+$input_destination
				+'</div>'
				+'<button alt="Click here to add more destinations to your route." id="ts-map-add-waypoint-' + number_map + '" class="ts-map-button ts-map-add-waypoint default"><span class="ts-map-add-waypoint-img"></span><span class="ts-map-add-waypoint-txt">' + o.jqm_TextButtonAdd + '</span></button>'
				
				+'<div class="ts-map-seperator"></div>'

				+'<div class="ts-map-travel-selector" alt="Select your preferred mode of travel.">'
					+'<span style="margin-top: 10px; margin-left: 5px; width: 100%; display: block;"><b>' + o.jqm_TextTravelMode + '</b></span>'
					+'<select class="ts-map-travel-mode" name="ts-map-travel-mode" id="ts-map-travel-mode-' + number_map + '">'
						+'<option value="DRIVING" selected="selected">' + o.jqm_TextDriving + '</option>'
						+'<option value="WALKING">' + o.jqm_TextWalking + '</option>'
						+'<option value="BICYCLING">' + o.jqm_TextBicy + '</option>'
					+'</select>'
					+'<span class="ts-map-optimizer" alt="Check this box if you want to optimize your waypoints for the most direct route.">'
						+'<input type="checkbox" name="ts-map-optimizer-check-' + number_map + '" class="ts-map-optimizer-check" id="ts-map-optimizer-check-' + number_map + '" value="1" />'
						+'<label style="padding-left: 6px; cursor: pointer; display: inline-block;" for="ts-map-optimizer-check-' + number_map + '">' + o.jqm_TextWP + '</label>'
					+'</span>'
				+'</div>'

				+'<div class="ts-map-seperator"></div>'
				
				+'<button alt="Click here to find directions based on your address." id="ts-map-start-calc-' + number_map + '" class="ts-map-button ts-map-start-calc"><span class="ts-map-start-calc-img"></span><span class="ts-map-start-calc-txt">' + o.jqm_TextButtonCalc + '</span></button>'
				+'<button alt="Click here to print your directions." id="ts-map-print-route-' + number_map + '" class="ts-map-button ts-map-print-route" style="display: none"><span class="ts-map-print-route-img"></span><span class="ts-map-print-route-txt">' + o.jqm_PrintRouteText + '</span></button>'
				+'</div>'
				+'<div class="map" style="width: 100%; height: 100%;"><div style="width:100%; text-align: center; position: absolute; top: 50%;"></div>'
				+'</div>'
				+'<div id="ts-map-print-panel-' + number_map + '" class="ts-map-print-panel" style="display: none;"></div>'
				+'</div>');
			
			var $start_calc 		= $this.find('.ts-map-start-calc');
			var $map 				= $this.find('.map');
			var $div_distance 		= $this.find('.ts-map-distance');
			var $panel 				= $this.find('.ts-map-main-panel');
			var $destination 		= $this.find('.ts-map-waypoints');
			var $add_destination 	= $this.find('.ts-map-add-waypoint');
			var $button_reset		= $this.find('.ts-map-resetmap');
			var $button_route 		= $this.find('.ts-map-route');
			var $button_indications	= $this.find('.ts-map-indication');
			var $travel_select 		= $this.find('.ts-map-travel-mode');
			var $printable_panel 	= $this.find('.ts-map-print-panel');
			var $opt_wp 			= $this.find('.ts-map-optimizer-check');
			var $print_route 		= $this.find('.ts-map-print-route');
			var $form_search 		= $this.find('.ts-map-form-search');
			var $opacity_search 	= $this.find('.ts-map-opacity-search');
			var $opacity_panel 		= $this.find('.ts-map-opacity-panel');
			var $roadmap_style		= o.jqm_MapStyle;
			var waypoint_array 		= ",A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
			var waypoint			= waypoint_array.split(",");
			
			//autocomplete_map($destination, $start_calc);
			
			$start_calc.click(function(){
				redrawMap($map[0], o.jqm_Fixdestination, o.jqm_TooltipContent, o.jqm_ZoomStartPoint, o.jqm_MapType, o.jqm_MapStyle, $panel[0], $destination.find("input:first").val(), $destination.find("input:last").val(), $this.find('.wp'), $travel_select.val(), $opt_wp.prop('checked'), $printable_panel, $div_distance, $roadmap_style, DistanceUnit, $button_indications, $print_route, $button_reset, o.jqm_PanControl, o.jqm_ZoomControl, o.jqm_ScaleControl, o.jqm_StreetControl);
			});
			$travel_select.change(function(){
				redrawMap($map[0], o.jqm_Fixdestination, o.jqm_TooltipContent, o.jqm_ZoomStartPoint, o.jqm_MapType, o.jqm_MapStyle, $panel[0], $destination.find("input:first").val(), $destination.find("input:last").val(), $this.find('.wp'), jQuery(this).val(), $opt_wp.prop('checked'), $printable_panel, $div_distance, $roadmap_style, DistanceUnit, $button_indications, $print_route, $button_reset, o.jqm_PanControl, o.jqm_ZoomControl, o.jqm_ScaleControl, o.jqm_StreetControl);
			});
			$opt_wp.click(function(){
				redrawMap($map[0], o.jqm_Fixdestination, o.jqm_TooltipContent, o.jqm_ZoomStartPoint, o.jqm_MapType, o.jqm_MapStyle, $panel[0], $destination.find("input:first").val(), $destination.find("input:last").val() ,$this.find('.wp'), $travel_select.val(), jQuery(this).prop('checked'), $printable_panel, $div_distance, $roadmap_style, DistanceUnit, $button_indications, $print_route, $button_reset, o.jqm_PanControl, o.jqm_ZoomControl, o.jqm_ScaleControl, o.jqm_StreetControl);
			});
			$print_route.click(function(){
				print_route($panel, PrintoutText);
			});
			if(o.jqm_Fixdestination != ''){
				//buildMap($map[0], o.jqm_GeoCode, o.jqm_Fixdestination, o.jqm_TooltipContent, o.jqm_ZoomStartPoint, o.jqm_MapIcon, o.jqm_MapType, o.jqm_MapStyle, IconAnimation, AnimationTypeShort, AnimationTypeLong, o.jqm_PanControl, o.jqm_ZoomControl, o.jqm_ScaleControl, o.jqm_StreetControl, o.jqm_StyleControl, DistanceUnit);          
			}   

			$add_destination.click(function(){
				if ($destination.find("input").length >= 10){
					//alert(o.jqm_WpExtra);
					return false;
				};
				var d_lenght = $destination.find("input").not('.final_destination').length + 1;
				var waypoint_marker = '<img src="http://maps.gstatic.com/mapfiles/markers2/icon_green' + waypoint[d_lenght] + '.png" alt="" style="vertical-align:middle" />';
				if( o.jqm_Fixdestination != ''){
					jQuery('<div style="padding:5px" class="container_dest"><span id="waypoint_marker' + d_lenght + '">' + waypoint_marker + '</span><input type="text" value="" style="margin-left: 15px; margin-top: 10px; width: 200px;"/><span class="ts-map-elimina" style=""></span></div>').insertBefore($destination.find(".final_destination"));
				}else{
					$destination.append('<div style="padding:5px" class="container_dest"><span id="waypoint_marker' + d_lenght + '">' + waypoint_marker + '</span><input type="text" value="" style="margin-left: 15px; margin-top: 10px; width: 220px;"/><span class="ts-map-elimina" style=""></span></div>');
				}
				$destination.find("input").not('.final_destination').addClass("wp");
				$destination.find("input:first,input:last").not('.final_destination').removeClass("wp");
				if( o.jqm_Fixdestination != ''){
					var max_input = 2;
				}else{
					var max_input = 3;
				}
				if($destination.find("input").not('.final_destination').length < max_input){
				   $destination.find("input").not('.final_destination').eq(0).next("span").css("display","none");
				   $destination.find("input").not('.final_destination').eq(1).next("span").css("display","none");
				}else{
				   $destination.find("input").not('.final_destination').next("span").css("display","");
				}  
				//autocomplete_map($destination, $start_calc);
				$this.find('.ts-map-elimina').click(function(){
					jQuery(this).parent("div").remove();
					$destination.find('.container_dest').each(function(i){
						i++; 
						waypoint_marker =  '<img src="http://maps.gstatic.com/mapfiles/markers2/icon_green' + waypoint[i] + '.png" alt="" style="vertical-align: middle" />';   
						jQuery(this).find('span[id^="waypoint_marker"]').attr({'id':'waypoint_marker' + i}).html(waypoint_marker);  
					});
					var tot_input = $destination.find("input").not('.final_destination').length;
					$destination.find("input").not('.final_destination').addClass("wp");
					$destination.find("input:first,input:last").not('.final_destination').removeClass("wp");
					if($destination.find("input").not('.final_destination').length < max_input){
						$destination.find("input").not('.final_destination').eq(0).next("span").css("display","none");
						$destination.find("input").not('.final_destination').eq(1).next("span").css("display","none");
					}else{
						$destination.find("input").not('.final_destination').next("span").css("display","");
					}
					//autocomplete_map($destination, $start_calc);
				});                 
			});  

			$button_route.click(function(){
				var statusA = $form_search.is(":visible");
				var statusB = $panel.is(":visible");
				if (statusA == false) {
					jQuery(this).html(o.jqm_TextCalcHide);
					if (statusB == true) {
						if ($map.width() < (parseInt(o.jqm_PercentCalcPanel) + parseInt(o.jqm_PercentCalcDir))) {
							$button_indications.toggleClass('ts-map-toggle-c');
							$button_indications.html(o.jqm_TextDirectionShow);
							$panel.slideToggle('slow');
							$opacity_panel.slideToggle('slow');
						};
					};
				} else {
					jQuery(this).html(o.jqm_TextCalcShow);
				};
				jQuery(this).toggleClass('ts-map-toggle-c');
				$form_search.slideToggle('slow');
				$opacity_search.slideToggle('slow');
			});

			$button_indications.click(function(){
				var statusA = $panel.is(":visible");
				var statusB = $form_search.is(":visible");
				if (statusA == false) {
					jQuery(this).html(o.jqm_TextDirectionHide);
					if (statusB == true) {
						if ($map.width() < (parseInt(o.jqm_PercentCalcPanel) + parseInt(o.jqm_PercentCalcDir))) {
							$button_route.toggleClass('ts-map-toggle-c');
							$button_route.html(o.jqm_TextCalcShow);
							$form_search.slideToggle('slow');
							$opacity_search.slideToggle('slow');
						};
					};
				} else {
					jQuery(this).html(o.jqm_TextDirectionShow);
				};
				jQuery(this).toggleClass('ts-map-toggle-c');
				$panel.slideToggle('slow');
				$opacity_panel.slideToggle('slow');
			});
			
			$button_reset.click(function(){
				$this.empty();
				$this.JQMap({
					jqm_GeoCode:			ResetGeoCode,
					jqm_Width: 				ResetWidth,
					jqm_Height: 			ResetHeight,
					jqm_MapFullWidth:		ResetFull,
					jqm_MapType:			ResetType,
					jqm_MapStyle:			ResetStyle,
					jqm_PanControl:			ResetPan,
					jqm_ZoomControl:		ResetZoomer,
					jqm_ScaleControl:		ResetScaler,
					jqm_StreetControl:		ResetStreet,
					jqm_StyleControl:		ResetStyler,
					jqm_Metric:				ResetMetric,
					jqm_MapDirections:		ResetDirections,
					jqm_MapIcon:			ResetIcon,
					jqm_ZoomStartPoint:		ResetZoom,
					jqm_StartOpacity: 		ResetOpacity,
					jqm_ShowTarget: 		ResetTarget,
					jqm_ShowBouncer: 		ResetBouncer,
					jqm_Fixdestination: 	ResetDestination,
					jqm_TexStartPoint: 		ResetText,
					jqm_StartPanel: 		ResetOpenPanel,
					jqm_TooltipContent:		ResetInfoWindow,
					jqm_Animation:			ResetAnimation,
					jqm_AnimationType:		ResetAnimationType,
					jqm_TextResetMap:		$languageTextResetMap,
					jqm_TextCalcShow:		$languageTextCalcShow,
					jqm_TextCalcHide:		$languageTextCalcHide,
					jqm_TextDirectionShow:	$languageTextDirectionShow,
					jqm_TextDirectionHide:	$languageTextDirectionHide,
					jqm_PrintRouteText:		$languagePrintRouteText,
					jqm_TextViewOnGoogle:	$languageTextViewOnGoogle,
					jqm_TextButtonCalc:		$languageTextButtonCalc,
					jqm_TextSetTarget:		$languageTextSetTarget,
					jqm_TextTravelMode:		$languageTextTravelMode,
					jqm_TextDriving:		$languageTextDriving,
					jqm_TextWalking:		$languageTextWalking,
					jqm_TextBicy:			$languageTextBicy,
					jqm_TextWP:				$languageTextWP,
					jqm_TextButtonAdd:		$languageTextButtonAdd,
				}); 
			});
		
			if (o.jqm_MapFullWidth == true) {
				var $maxWidth = 0;
				if (typeof $this.attr('data-break-parents') == 'undefined') {
					return;
				}
				var breakNum = parseInt($this.attr('data-break-parents'));
				if (isNaN(breakNum)) {
					return;
				}
				var $immediateParent = $this.parent();
				var $parent = $immediateParent;
				for (var i = 0; i < breakNum; i++) {
					if ($parent.is('html')) {
						break;
					}
					$parent = $parent.parent();
					if ($parent.css("max-width") != "none") {
						$maxWidth = parseInt($parent.css("max-width").replace("px", "").replace("%", "").replace("em", ""));
					}
				}
				var parentWidth = $parent.width()
					+ parseInt( $parent.css('paddingLeft') )
					+ parseInt( $parent.css('paddingRight') )
					+ parseInt( $parent.css('marginLeft') )
					+ parseInt( $parent.css('marginRight') );
				var left = - ( $immediateParent.offset().left - $parent.offset().left );
				if (left > 0) {
					left = 0;
				}
				$this.addClass('fullwidth');
				$this.css({
					'width':    	parentWidth,
					'left':     	left,
					'position':		'relative'
				});
			};

			jQuery(window).on("debouncedresize", function(event) {
				$button_reset.click();
			});

			setTimeout(function(){
				buildMap($map[0], o.jqm_GeoCode, o.jqm_Fixdestination, o.jqm_TooltipContent, o.jqm_ZoomStartPoint, o.jqm_MapIcon, o.jqm_MapType, o.jqm_MapStyle, IconAnimation, AnimationTypeShort, AnimationTypeLong, o.jqm_PanControl, o.jqm_ZoomControl, o.jqm_ScaleControl, o.jqm_StreetControl, o.jqm_StyleControl, DistanceUnit);
			},500);
		});  
	};  
})(jQuery);