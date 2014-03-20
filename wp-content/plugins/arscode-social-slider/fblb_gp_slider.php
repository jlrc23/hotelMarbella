<?php
global $wpdb;
if($options['GP_TabPosition']=='Middle' && in_array($options['GP_TabDesign'],array(3,6)))
{
	$fblbHead_GP_position='top: 50%; margin-top: -30px;';
}
if($options['GP_TabPosition']=='Middle' && in_array($options['GP_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_GP_position='top: 50%; margin-top: -78px;';
}
if($options['GP_TabPosition']=='Middle' && in_array($options['GP_TabDesign'],array(7,8)))
{
	$fblbHead_GP_position='top: 50%; margin-top: -45px;';
}
if($options['GP_TabPosition']=='Middle' && in_array($options['GP_TabDesign'],array(9)))
{
	$fblbHead_GP_position='top: 50%; margin-top: -18px;';
}
if($options['GP_TabPosition']=='Middle' && in_array($options['GP_TabDesign'],array(11,13)))
{
	$fblbHead_GP_position='top: 50%; margin-top: -54px;';
}
if($options['GP_TabPosition']=='Middle' && in_array($options['GP_TabDesign'],array(12,14)))
{
	$fblbHead_GP_position='top: 50%; margin-top: -39px;';
}
if($options['GP_TabPosition']=='Top')
{
	$fblbHead_GP_position='top: 5px;';
}
if($options['GP_TabPosition']=='Bottom')
{	
	$fblbHead_GP_position='bottom: 5px;';
}
if($options['GP_TabPosition']=='Fixed')
{	
	$fblbHead_GP_position='top: '.$options['GP_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterGp <?php echo ($options['GP_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['GP_Position'] ?>" style="<?php echo  ($options['GP_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['GP_VPositionPx'] ? $options['GP_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo  ($options['GP_Position'] == 'Left' ? 'left: -' . ($options['GP_Width'] + $options['GP_Border']) . 'px;' : 'right: -' . ($options['GP_Width'] + $options['GP_Border']) . 'px;') ?><?php echo  ($options['GP_ZIndex'] ? 'z-index: ' . $options['GP_ZIndex'] . ';' : '') ?>">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['GP_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['GP_BorderColor'] ?>; height: <?php echo  $options['GP_Height'] ?>px; width: <?php echo  $options['GP_Width'] ?>px; padding: <?php echo  ($options['GP_Position'] == 'Left' ? $options['GP_Border'] . 'px ' . $options['GP_Border'] . 'px ' . $options['GP_Border'] . 'px 0' : $options['GP_Border'] . 'px 0 ' . $options['GP_Border'] . 'px ' . $options['GP_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_GP_position; ?> <?php echo  ($options['GP_Position'] == 'Left' ? 'left: ' . ($options['GP_Width'] + $options['GP_Border']) . 'px;' : 'right: ' . ($options['GP_Width'] + $options['GP_Border']) . 'px;') ?>">Google Plus</h2>
				<div class="fblbInner" style="background: <?php echo $options['GP_BackgroundColor']?>; height: <?php echo  $options['GP_Height'] ?>px;">
					<?php
					if($options['GP_ShowBadge'])
					{
					?>
					<div id="fblbGpBadge" class="fblbInnerLoading" style="overflow: hidden; height: 131px;">
						<link href="https://plus.google.com/<?php echo  $options['GP_PageID'] ?>" rel="publisher" />
						<div class="g-plus" data-href="https://plus.google.com/<?php echo  $options['GP_PageID'] ?>" data-size="badge"></div>
					</div>
					<?php
					}
					if($options['GP_ShowFeed'])
					{
					?>
					<div style="overflow-y: auto; overflow-x: hidden; height: <?php echo ($options['GP_ShowBadge'] ? $options['GP_Height']-131 : $options['GP_Height']);?>px;">
						<ul id="fblbGpList" class="fblbList" style="height: <?php echo ($options['GP_ShowBadge'] ? $options['GP_Height']-131 : $options['GP_Height']);?>px">
						<?php
							$posts = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."arscodess_gp` ORDER By datetime DESC LIMIT ".($options['GP_NumberofPosts'] ? $options['GP_NumberofPosts'] : 10));
							$i=0;
							foreach($posts as $v)
							{
								echo 
								'<li>'.$v->desc.'<br style="clear: both;/>'.
								'<span class="fblbinfo2">'.date('j M Y',strtotime($v->datetime)).'</span>';
								if($v->plus)
								{
									echo '<span class="fblbinfo3">+'.$v->plus.'</span>';
								}
								'</li>';
								$i++;
							}
						?>
						</ul>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
<!--
var fblbGpLoaded=0;
function fblb_GpLoad()
{
	if(fblbGpLoaded==1)
	{
		return true;
	}
	window.___gcfg = {lang: '<?php echo  $options['GP_Language'] ?>'};
	(function() 
	{var po = document.createElement("script");
	po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";
	var s = document.getElementsByTagName("script")[0];
	s.parentNode.insertBefore(po, s);
	jQuery('#fblbGpBadge').removeClass('fblbInnerLoading');
	fblbGpLoaded=1;
	})();
}
jQuery(document).ready(function(){	
	 jQuery('#fblbGpList').lionbars();
<?php
if($options['GP_Load']==1)
{	
	echo 'fblb_GpLoad();';
}
?>
});
-->
</script>