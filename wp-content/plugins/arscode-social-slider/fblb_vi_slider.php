<?php
global $wpdb;
if($options['VI_TabPosition']=='Middle' && in_array($options['VI_TabDesign'],array(3,6)))
{
	$fblbHead_VI_position='top: 50%; margin-top: -30px;';
}
if($options['VI_TabPosition']=='Middle' && in_array($options['VI_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_VI_position='top: 50%; margin-top: -78px;';
}
if($options['VI_TabPosition']=='Middle' && in_array($options['VI_TabDesign'],array(7,8)))
{
	$fblbHead_VI_position='top: 50%; margin-top: -45px;';
}
if($options['VI_TabPosition']=='Middle' && in_array($options['VI_TabDesign'],array(9)))
{
	$fblbHead_VI_position='top: 50%; margin-top: -18px;';
}
if($options['VI_TabPosition']=='Middle' && in_array($options['VI_TabDesign'],array(11,13)))
{
	$fblbHead_VI_position='top: 50%; margin-top: -54px;';
}
if($options['VI_TabPosition']=='Middle' && in_array($options['VI_TabDesign'],array(12,14)))
{
	$fblbHead_VI_position='top: 50%; margin-top: -39px;';
}
if($options['VI_TabPosition']=='Top')
{
	$fblbHead_VI_position='top: 5px;';
}
if($options['VI_TabPosition']=='Bottom')
{	
	$fblbHead_VI_position='bottom: 5px;';
}
if($options['VI_TabPosition']=='Fixed')
{	
	$fblbHead_VI_position='top: '.$options['VI_TabPositionPx'].'px;';
}
?>
<style type="text/css">
<!-- 
/* You can modify these CSS styles */
.vimeoBadge { margin: 0; padding: 0; width: <?php echo $options['VI_Width'];?>px; font: normal 11px verdana,sans-serif; }
.vimeoBadge img { border: 0; }
.vimeoBadge a, .vimeoBadge a:link, .vimeoBadge a:visited, .vimeoBadge a:active { color: <?php echo $options['VI_TitlesColor'];?>; text-decoration: none; cursor: pointer; }
.vimeoBadge a:hover { color: <?php echo $options['VI_TitlesColorHover'];?>; }
.vimeoBadge #vimeo_badge_logo { margin-top:10px; width: 57px; height: 16px; }
.vimeoBadge .credit { font: normal 11px verdana,sans-serif; }
.vimeoBadge .clip { padding:0; float:left; margin: 5px 5px 0px 5px; width: <?php echo $options['VI_ThumbnailSize'];?>px; line-height:0; }
.vimeoBadge .caption { font: normal 11px verdana,sans-serif; overflow: hidden; width: <?php echo $options['VI_ThumbnailSize'];?>px; height: <?php echo $options['VI_TitlesHeight'];?>px; }
.vimeoBadge .clear { display: block; clear: both; visibility: hidden; } 
-->
</style>
<div class="fblbCenterOuter fblbCenterOuterVi <?php echo ($options['VI_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['VI_Position'] ?>" style="<?php echo ($options['VI_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['VI_VPositionPx'] ? $options['VI_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo ($options['VI_Position'] == 'Left' ? 'left: -' . ($options['VI_Width'] + $options['VI_Border']) . 'px;' : 'right: -' . ($options['VI_Width'] + $options['VI_Border']) . 'px;') ?><?php echo ($options['VI_ZIndex'] ? 'z-index: ' . $options['VI_ZIndex'] . ';' : '') ?>;">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['VI_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['VI_BorderColor'] ?>; height: <?php echo $options['VI_Height'] ?>px; width: <?php echo $options['VI_Width'] ?>px; padding: <?php echo ($options['VI_Position'] == 'Left' ? $options['VI_Border'] . 'px ' . $options['VI_Border'] . 'px ' . $options['VI_Border'] . 'px 0' : $options['VI_Border'] . 'px 0 ' . $options['VI_Border'] . 'px ' . $options['VI_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_VI_position; ?> <?php echo ($options['VI_Position'] == 'Left' ? 'left: ' . ($options['VI_Width'] + $options['VI_Border']) . 'px;' : 'right: ' . ($options['VI_Width'] + $options['VI_Border']) . 'px;') ?>">Vimeo</h2>
				<div class="fblbInner" style="overflow: hidden; background: <?php echo $options['VI_BackgroundColor'] ?>; height: <?php echo $options['VI_Height'] ?>px;">				
					<div id="fblbInnerVi" class="vimeoBadge" style="overflow-y: auto; overflow-x: hidden; height: <?php echo $options['VI_Height']?>px;">
						<script	type="text/javascript" src="//vimeo.com/<?php echo $options['VI_Profile'];?>/badgeo/?stream=<?php echo $options['VI_Stream'];?>&amp;stream_id=<?php echo $options['VI_StreamID'];?>&amp;count=<?php echo $options['VI_NumberofVideos'];?>&amp;thumbnail_width=<?php echo $options['VI_ThumbnailSize'];?>&amp;show_titles=<?php echo  ($options['VI_ShowTitles'] ? 'yes' : 'no' ) ?>"></script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
<!--
jQuery(document).ready(function(){	
 jQuery('#fblbInnerVi').lionbars();
});
-->
</script>