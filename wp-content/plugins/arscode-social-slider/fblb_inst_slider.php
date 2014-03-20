<?php
global $wpdb;
if($options['INST_TabPosition']=='Middle' && in_array($options['INST_TabDesign'],array(3,6)))
{
	$fblbHead_INST_position='top: 50%; margin-top: -30px;';
}
if($options['INST_TabPosition']=='Middle' && in_array($options['INST_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_INST_position='top: 50%; margin-top: -78px;';
}
if($options['INST_TabPosition']=='Middle' && in_array($options['INST_TabDesign'],array(7,8)))
{
	$fblbHead_INST_position='top: 50%; margin-top: -45px;';
}
if($options['INST_TabPosition']=='Middle' && in_array($options['INST_TabDesign'],array(9)))
{
	$fblbHead_INST_position='top: 50%; margin-top: -18px;';
}
if($options['INST_TabPosition']=='Middle' && in_array($options['INST_TabDesign'],array(11,13)))
{
	$fblbHead_INST_position='top: 50%; margin-top: -54px;';
}
if($options['INST_TabPosition']=='Middle' && in_array($options['INST_TabDesign'],array(12,14)))
{
	$fblbHead_INST_position='top: 50%; margin-top: -39px;';
}
if($options['INST_TabPosition']=='Top')
{
	$fblbHead_INST_position='top: 5px;';
}
if($options['INST_TabPosition']=='Bottom')
{	
	$fblbHead_INST_position='bottom: 5px;';
}
if($options['INST_TabPosition']=='Fixed')
{	
	$fblbHead_INST_position='top: '.$options['INST_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterInst <?php echo ($options['INST_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['INST_Position'] ?>" style="<?php echo  ($options['INST_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['INST_VPositionPx'] ? $options['INST_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo  ($options['INST_Position'] == 'Left' ? 'left: -' . ($options['INST_Width'] + $options['INST_Border']) . 'px;' : 'right: -' . ($options['INST_Width'] + $options['INST_Border']) . 'px;') ?><?php echo  ($options['INST_ZIndex'] ? 'z-index: ' . $options['INST_ZIndex'] . ';' : '') ?>">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['INST_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['INST_BorderColor'] ?>; height: <?php echo  $options['INST_Height'] ?>px; width: <?php echo  $options['INST_Width'] ?>px; padding: <?php echo  ($options['INST_Position'] == 'Left' ? $options['INST_Border'] . 'px ' . $options['INST_Border'] . 'px ' . $options['INST_Border'] . 'px 0' : $options['INST_Border'] . 'px 0 ' . $options['INST_Border'] . 'px ' . $options['INST_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_INST_position; ?> <?php echo  ($options['INST_Position'] == 'Left' ? 'left: ' . ($options['INST_Width'] + $options['INST_Border']) . 'px;' : 'right: ' . ($options['INST_Width'] + $options['INST_Border']) . 'px;') ?>">Instagram</h2>
				<div class="fblbInner" style="background: <?php echo $options['INST_BackgroundColor']?>; height: <?php echo  $options['INST_Height'] ?>px;">
					<div style="height: 50px; background-color: #ececec;">
						<a href="http://instagram.com/<?php echo $options['INST_username'];?>/"><img style="float: <?php echo  ($options['INST_Position'] == 'Left' ? 'right' : 'left') ?>; padding: 5px;" src="<?php echo  plugins_url('/img/header_inst.png', __FILE__) ?>" width="139" height="37" alt="Follow Me on Instagram" /></a>
					</div>
					<div style="overflow-y: auto; overflow-x: hidden; height: <?php echo $options['INST_Height']-50;?>px;">
						<ul id="fblbInstList" class="fblbList" style="height: <?php echo $options['INST_Height']-50;?>px">
						<?php
                            $images = wp_cache_get('instagram', 'arscode_social_slider_cache');
                			if (false == $images)
                            {
                				$images = fblb_instagram_get_latest();
                				wp_cache_set('instagram', $images, 'arscode_social_slider_cache', 3600);
                			}
                            
                            switch($options['INST_size']) {
        						case 'large':
        							$imagetype = "image_large";
        							$imagesize = 612;
        							break;
        						case 'middle':
        							$imagetype = "image_middle";
        							$imagesize = 306;
        							break;
        						case 'small':
        						default:
        							$imagetype = "image_small";
        							$imagesize = 150;
       							break;
        					}
                            
							$i=0;
							foreach((array)$images as $v)
							{
							    $imagesrc = $v[$imagetype];
            					echo '<li>';
                                echo '<div class="instTitle">'.fblb_truncate($v['text'], 1024, '...', true, true).'</div><br>';
                                echo '<div class="instImage"><a href="'.$v['link'].'" title="'.$v['title'].'" target="_blank">';
            					echo '<img src="'.$imagesrc.'" alt="'.$v['title'].'" width="'.$imagesize.'" height="'.$imagesize.'" />';
            					echo '</a>';
								echo '<div class="instImageInfo" style="text-align: center;">';
								echo '<div><span class="star"></span>'.$v['likes_count'].'</div><div><span class="comment"></span>'.$v['comments_count'].'</div>';
								echo '</div></div>';
								echo '</li>';
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
 jQuery('#fblbInstList').lionbars();
});
-->
</script>