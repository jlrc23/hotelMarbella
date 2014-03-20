<div class="fblbReset">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
	new TWTR.Widget({
		version: 2,
		type: 'profile',
		rpp: <?php echo  $options['TW_rpp'] ?>,
		interval: <?php echo  $options['TW_interval'] * 1000 ?>,
		width: <?php echo  $options['TW_Width'] ?>,
		height: <?php echo  $options['TW_Height'] - 92 ?>,
		theme: {
			shell: {
				background: '<?php echo  $options['TW_ShellBackground'] ?>',
				color: '<?php echo  $options['TW_ShellText'] ?>'
			},
			tweets: {
				background: '<?php echo  $options['TW_TweetBackground'] ?>',
				color: '<?php echo  $options['TW_TweetText'] ?>',
				links: '<?php echo  $options['TW_Links'] ?>'
			}
		},
		features: {
			loop: <?php echo  ($options['TW_loop'] ? 'true' : 'false') ?>,
			live: <?php echo  ($options['TW_live'] ? 'true' : 'false') ?>,
			scrollbar: <?php echo  ($options['TW_scrollbar'] ? 'true' : 'false') ?>,
			avatars: true,
			behavior: '<?php echo  $options['TW_behavior'] ?>'				  
		}
	}).render().setUser('<?php echo  $options['TW_Username'] ?>').start();
</script>
</div>