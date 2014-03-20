<?php
global $wpdb;
if($options['PI_TabPosition']=='Middle' && in_array($options['PI_TabDesign'],array(3,6)))
{
	$fblbHead_PI_position='top: 50%; margin-top: -30px;';
}
if($options['PI_TabPosition']=='Middle' && in_array($options['PI_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_PI_position='top: 50%; margin-top: -78px;';
}
if($options['PI_TabPosition']=='Middle' && in_array($options['PI_TabDesign'],array(7,8)))
{
	$fblbHead_PI_position='top: 50%; margin-top: -45px;';
}
if($options['PI_TabPosition']=='Middle' && in_array($options['PI_TabDesign'],array(9)))
{
	$fblbHead_PI_position='top: 50%; margin-top: -18px;';
}
if($options['PI_TabPosition']=='Middle' && in_array($options['PI_TabDesign'],array(11,13)))
{
	$fblbHead_PI_position='top: 50%; margin-top: -54px;';
}
if($options['PI_TabPosition']=='Middle' && in_array($options['PI_TabDesign'],array(12,14)))
{
	$fblbHead_PI_position='top: 50%; margin-top: -39px;';
}
if($options['PI_TabPosition']=='Top')
{
	$fblbHead_PI_position='top: 5px;';
}
if($options['PI_TabPosition']=='Bottom')
{	
	$fblbHead_PI_position='bottom: 5px;';
}
if($options['PI_TabPosition']=='Fixed')
{	
	$fblbHead_PI_position='top: '.$options['PI_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterPi <?php echo ($options['PI_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['PI_Position'] ?>" style="<?php echo  ($options['PI_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['PI_VPositionPx'] ? $options['PI_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo  ($options['PI_Position'] == 'Left' ? 'left: -' . ($options['PI_Width'] + $options['PI_Border']) . 'px;' : 'right: -' . ($options['PI_Width'] + $options['PI_Border']) . 'px;') ?><?php echo  ($options['PI_ZIndex'] ? 'z-index: ' . $options['PI_ZIndex'] . ';' : '') ?>">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['PI_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['PI_BorderColor'] ?>; height: <?php echo  $options['PI_Height'] ?>px; width: <?php echo  $options['PI_Width'] ?>px; padding: <?php echo  ($options['PI_Position'] == 'Left' ? $options['PI_Border'] . 'px ' . $options['PI_Border'] . 'px ' . $options['PI_Border'] . 'px 0' : $options['PI_Border'] . 'px 0 ' . $options['PI_Border'] . 'px ' . $options['PI_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_PI_position; ?> <?php echo  ($options['PI_Position'] == 'Left' ? 'left: ' . ($options['PI_Width'] + $options['PI_Border']) . 'px;' : 'right: ' . ($options['PI_Width'] + $options['PI_Border']) . 'px;') ?>">Google Plus</h2>
				<div class="fblbInner" style="background: <?php echo $options['PI_BackgroundColor']?>; height: <?php echo  $options['PI_Height'] ?>px;">
					<div style="height: 36px; background-color: #ececec;">
						<a href="http://pinterest.com/<?php echo $options['PI_Username'];?>/"><img style="float: <?php echo  ($options['PI_Position'] == 'Left' ? 'right' : 'left') ?>; padding: 5px;" src="http://passets-cdn.pinterest.com/images/follow-on-pinterest-button.png" width="156" height="26" alt="Follow Me on Pinterest" /></a>
					</div>
					<div style="overflow-y: auto; overflow-x: hidden; height: <?php echo $options['PI_Height']-36;?>px;">
						<ul id="fblbPiList" class="fblbList" style="height: <?php echo $options['PI_Height']-36;?>px">
						<?php
							$posts = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."arscodess_pi` ORDER By datetime DESC LIMIT ".($options['PI_NumberofPosts'] ? $options['PI_NumberofPosts'] : 10));
							$i=0;
							foreach($posts as $v)
							{
								echo 
								'<li style="text-align: center;">'.fblb_truncate($v->description, 1024, '...', true, true).''.
								'<span class="fblbinfo">Pinned: '.date('j M Y',strtotime($v->datetime)).'</span>';
								'</li>';
								$i++;
							}
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
<!--
jQuery(document).ready(function(){	
 jQuery('#fblbPiList').lionbars();
});
-->
</script>