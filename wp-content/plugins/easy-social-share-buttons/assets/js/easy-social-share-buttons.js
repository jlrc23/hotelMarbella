jQuery(document).ready(function($){
	
	jQuery.fn.essb_get_counters = function(){
		return this.each(function(){
			
			var plugin_url 		= $(this).find('.essb_info_plugin_url').val();
			var url 			= $(this).find('.essb_info_permalink').val();
			var counter_pos     = $(this).find('.essb_info_counter_pos').val();
			// tetsing
			//url = "http://google.com";
			
			var $twitter 	= $(this).find('.essb_link_twitter');
			var $linkedin 	= $(this).find('.essb_link_linkedin');
			var $delicious 	= $(this).find('.essb_link_delicious');
			var $facebook 	= $(this).find('.essb_link_facebook');
			var $pinterest 	= $(this).find('.essb_link_pinterest');
			var $google 	= $(this).find('.essb_link_google');
			var $stumble 	= $(this).find('.essb_link_stumbleupon');
			var $vk         = $(this).find('.essb_link_vk');



			var twitter_url		= "http://cdn.api.twitter.com/1/urls/count.json?url=" + url + "&callback=?"; 
			//
			var delicious_url	= "http://feeds.delicious.com/v2/json/urlinfo/data?url=" + url + "&callback=?" ;
			// 
			var linkedin_url	= "http://www.linkedin.com/countserv/count/share?format=jsonp&url=" + url + "&callback=?";
			// 
			var pinterest_url   = "http://api.pinterest.com/v1/urls/count.json?callback=?&url=" + url;
			// 
			var facebook_url	= "https://graph.facebook.com/fql?q=SELECT%20like_count,%20total_count,%20share_count,%20click_count,%20comment_count%20FROM%20link_stat%20WHERE%20url%20=%20%22"+url+"%22";
			// 
			var google_url		= plugin_url+"/public/get-noapi-counts.php?nw=google&url=" + url;
			var stumble_url		= plugin_url+"/public/get-noapi-counts.php?nw=stumble&url=" + url;
			var vk_url  = plugin_url+"/public/get-noapi-counts.php?nw=vk&url=" + url;
			
			 function shortenNumber(n) {
				    if ('number' !== typeof n) n = Number(n);
				    var sgn      = n < 0 ? '-' : ''
				      , suffixes = ['k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y']
				      , overflow = Math.pow(10, suffixes.length * 3 + 3)
				      , suffix, digits;
				    n = Math.abs(Math.round(n));
				    if (n < 1000) return sgn + n;
				    if (n >= 1e100) return sgn + 'many';
				    if (n >= overflow) return (sgn + n).replace(/(\.\d*)?e\+?/i, 'e'); // 1e24
				 
				    do {
				      n      = Math.floor(n);
				      suffix = suffixes.shift();
				      digits = n % 1e6;
				      n      = n / 1000;
				      if (n >= 1000) continue; // 1M onwards: get them in the next iteration
				      if (n >= 10 && n < 1000 // 10k ... 999k
				       || (n < 10 && (digits % 1000) < 100) // Xk (X000 ... X099)
				         )
				        return sgn + Math.floor(n) + suffix;
				      return (sgn + n).replace(/(\.\d).*/, '$1') + suffix; // #.#k
				    } while (suffixes.length)
				    return sgn + 'many';
				  }

			if ( $twitter.length ) {
				$.getJSON(twitter_url)
					.done(function(data){
						if (counter_pos == "right") {
							$twitter.append('<span class="essb_counter_right" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
						else {
							$twitter.prepend('<span class="essb_counter" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
					});
			}
			if ( $linkedin.length ) {
				$.getJSON(linkedin_url)
					.done(function(data){
						if (counter_pos == "right") {
							$linkedin.append('<span class="essb_counter_right" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
						else {
							$linkedin.prepend('<span class="essb_counter" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
					});
			}
			if ( $pinterest.length ) {
				$.getJSON(pinterest_url)
					.done(function(data){
						if (counter_pos == "right") {
							$pinterest.append('<span class="essb_counter_right" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
						else {
							$pinterest.prepend('<span class="essb_counter" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}						
					});
			}
			if ( $google.length ) {
				$.getJSON(google_url)
					.done(function(data){
						//var count = data.count;
						//alert(count);
						if (counter_pos == "right") {
							$google.append('<span class="essb_counter_right" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
						else {
							$google.prepend('<span class="essb_counter" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}	

					})
			}
			if ( $stumble.length ) {
				$.getJSON(stumble_url)
					.done(function(data){
						if (counter_pos == "right") {
							$stumble.append('<span class="essb_counter_right" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
						else {
							$stumble.prepend('<span class="essb_counter" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}	

					})
			}
			if ( $facebook.length ) {
				$.getJSON(facebook_url)
					.done(function(data){
						if (counter_pos == "right") {
							$facebook.append('<span class="essb_counter_right" cnt="' + data.data[0].share_count + '">' + shortenNumber(data.data[0].share_count) + '</span>');
						}
						else {
							$facebook.prepend('<span class="essb_counter" cnt="' + data.data[0].share_count + '">' + shortenNumber(data.data[0].share_count) + '</span>');
						}	
					});
			}
			if ( $delicious.length ) {
				$.getJSON(delicious_url)
					.done(function(data){
						if (counter_pos == "right") {
							$delicious.append('<span class="essb_counter_right" cnt="' + data[0].total_posts + '">' + shortenNumber(data[0].total_posts) + '</span>');
						}
						else {
							$delicious.prepend('<span class="essb_counter" cnt="' + data[0].total_posts + '">' + shortenNumber(data[0].total_posts) + '</span>');
						}	
					});
			}
			if ( $vk.length ) {
				$.getJSON(vk_url)
					.done(function(data){
						if (counter_pos == "right") {
							$vk.append('<span class="essb_counter_right" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
						else {
							$vk.prepend('<span class="essb_counter" cnt="' + data.count + '">' + shortenNumber(data.count) + '</span>');
						}
					});
			}
		});
	}; 

	jQuery.fn.essb_update_counters = function(){
		return this.each(function(){

			var $group			= $(this);
			var $total_count 	= $group.find('.essb_totalcount');
			var $total_count_nb = $total_count.find('.essb_t_nb');
			var total_text = $total_count.attr('title');
			$total_count.prepend('<span class="essb_total_text">'+total_text+'</span>');

			function count_total() {
				var total = 0;
				var counter_pos     = $('.essb_info_counter_pos').val();
				//alert(counter_pos);
				if (counter_pos == "right") {
					$group.find('.essb_counter_right').each(function(){
						total += parseInt($(this).attr('cnt'));		
						
						var value = parseInt($(this).attr('cnt'));
						
						if (!$total_count_nb) {
						value = shortenNumber(value);
						$(this).text(value);
					}
						//alert(shortenNumber(total));
					});
					
				}
				else {
					$group.find('.essb_counter').each(function(){
						total += parseInt($(this).attr('cnt'));		
					
						var value = parseInt($(this).attr('cnt'));
					
						if (!$total_count_nb) {
							value = shortenNumber(value);
							$(this).text(value);
						}
					//alert(shortenNumber(total));
					});
				}
				$total_count_nb.text(shortenNumber(total));
			}
			
			  function shortenNumber(n) {
				    if ('number' !== typeof n) n = Number(n);
				    var sgn      = n < 0 ? '-' : ''
				      , suffixes = ['k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y']
				      , overflow = Math.pow(10, suffixes.length * 3 + 3)
				      , suffix, digits;
				    n = Math.abs(Math.round(n));
				    if (n < 1000) return sgn + n;
				    if (n >= 1e100) return sgn + 'many';
				    if (n >= overflow) return (sgn + n).replace(/(\.\d*)?e\+?/i, 'e'); // 1e24
				 
				    do {
				      n      = Math.floor(n);
				      suffix = suffixes.shift();
				      digits = n % 1e6;
				      n      = n / 1000;
				      if (n >= 1000) continue; // 1M onwards: get them in the next iteration
				      if (n >= 10 && n < 1000 // 10k ... 999k
				       || (n < 10 && (digits % 1000) < 100) // Xk (X000 ... X099)
				         )
				        return sgn + Math.floor(n) + suffix;
				      return (sgn + n).replace(/(\.\d).*/, '$1') + suffix; // #.#k
				    } while (suffixes.length)
				    return sgn + 'many';
				  }
			setInterval(count_total, 1200);

		});
	}; 
	
 
	$('.essb_links.essb_counters').essb_get_counters();
	$('.essb_counters .essb_links_list').essb_update_counters();
});
