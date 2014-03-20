<?php
global $wpdb;
if($options['LI_TabPosition']=='Middle' && in_array($options['LI_TabDesign'],array(3,6)))
{
	$fblbHead_LI_position='top: 50%; margin-top: -30px;';
}
if($options['LI_TabPosition']=='Middle' && in_array($options['LI_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_LI_position='top: 50%; margin-top: -78px;';
}
if($options['LI_TabPosition']=='Middle' && in_array($options['LI_TabDesign'],array(7,8)))
{
	$fblbHead_LI_position='top: 50%; margin-top: -45px;';
}
if($options['LI_TabPosition']=='Middle' && in_array($options['LI_TabDesign'],array(9,10)))
{
	$fblbHead_LI_position='top: 50%; margin-top: -18px;';
}
if($options['LI_TabPosition']=='Middle' && in_array($options['LI_TabDesign'],array(11,13)))
{
	$fblbHead_LI_position='top: 50%; margin-top: -54px;';
}
if($options['LI_TabPosition']=='Middle' && in_array($options['LI_TabDesign'],array(12,14)))
{
	$fblbHead_LI_position='top: 50%; margin-top: -39px;';
}
if($options['LI_TabPosition']=='Top')
{
	$fblbHead_LI_position='top: 5px;';
}
if($options['LI_TabPosition']=='Bottom')
{	
	$fblbHead_LI_position='bottom: 5px;';
}
if($options['LI_TabPosition']=='Fixed')
{	
	$fblbHead_LI_position='top: '.$options['LI_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterLi <?php echo ($options['LI_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['LI_Position'] ?>" style="<?php echo ($options['LI_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['LI_VPositionPx'] ? $options['LI_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo ($options['LI_Position'] == 'Left' ? 'left: -' . ($options['LI_Width'] + $options['LI_Border']) . 'px;' : 'right: -' . ($options['LI_Width'] + $options['LI_Border']) . 'px;') ?><?php echo ($options['LI_ZIndex'] ? 'z-index: ' . $options['LI_ZIndex'] . ';' : '') ?>;">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['LI_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['LI_BorderColor'] ?>; height: <?php echo $options['LI_Height'] ?>px; width: <?php echo $options['LI_Width'] ?>px; padding: <?php echo ($options['LI_Position'] == 'Left' ? $options['LI_Border'] . 'px ' . $options['LI_Border'] . 'px ' . $options['LI_Border'] . 'px 0' : $options['LI_Border'] . 'px 0 ' . $options['LI_Border'] . 'px ' . $options['LI_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_LI_position; ?> <?php echo ($options['LI_Position'] == 'Left' ? 'left: ' . ($options['LI_Width'] + $options['LI_Border']) . 'px;' : 'right: ' . ($options['LI_Width'] + $options['LI_Border']) . 'px;') ?>">LinkedId</h2>
				<div id="fblbInnerLi" class="fblbInner fblbInnerLoading" style="overflow: hidden; background-color: <?php echo $options['LI_BackgroundColor'] ?>; height: <?php echo $options['LI_Height'] ?>px;">				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
<!--
var fblbLiLoaded=0;
function fblb_LiLoad()
{
	if(fblbLiLoaded==1)
	{
		return true;
	}
	 jQuery('#fblbInnerLi').append('<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>');
	<?php if($options['LI_ShowCompanyProfile']==1 && $options['LI_Order']==2)
	{
	?>
	 jQuery('#fblbInnerLi').append('<script type="IN/CompanyProfile" data-related="false" data-width="<?php echo $options['LI_Width'] ?>" data-id="<?php echo $options['LI_CompanyID'] ?>" data-format="inline" ></script>');
	<?php 
	}
	if($options['LI_ShowPublicProfile']==1)
	{
	?>
	jQuery('#fblbInnerLi').append('<script type="IN/MemberProfile" data-related="false" data-width="<?php echo $options['LI_Width'] ?>" data-id="<?php echo $options['LI_PublicProfile'] ?>" data-format="inline"></script>');
	<?php 	
	} 
	?>
	<?php if($options['LI_ShowCompanyProfile']==1 && $options['LI_Order']==1)
	{
	?>
	jQuery('#fblbInnerLi').append('<script type="IN/CompanyProfile" data-related="false" data-width="<?php echo $options['LI_Width'] ?>" data-id="<?php echo $options['LI_CompanyID'] ?>" data-format="inline" ></script>');
	<?php 
	}
	?>
	if ( navigator.userAgent.match(/msie/i) ) {jQuery('#fblbInnerLi').removeClass('fblbInnerLoading');}
   
   fblbLiLoaded=1;
}
jQuery(document).ready(function(){	
<?php
if($options['LI_Load']==1)
{	
	echo 'fblb_LiLoad();';
}
?>
});
-->
</script>