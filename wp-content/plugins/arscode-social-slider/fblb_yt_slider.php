<?php
global $wpdb;
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(3,6)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -30px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -78px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(7,8)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -45px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(9)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -18px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(11,13)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -54px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(12,14)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -39px;';
}
if($options['YT_TabPosition']=='Top')
{
	$fblbHead_YT_position='top: 5px;';
}
if($options['YT_TabPosition']=='Bottom')
{	
	$fblbHead_YT_position='bottom: 5px;';
}
if($options['YT_TabPosition']=='Fixed')
{	
	$fblbHead_YT_position='top: '.$options['YT_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterYt <?php echo ($options['YT_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['YT_Position'] ?>" style="<?php echo ($options['YT_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['YT_VPositionPx'] ? $options['YT_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo ($options['YT_Position'] == 'Left' ? 'left: -' . ($options['YT_Width'] + $options['YT_Border']) . 'px;' : 'right: -' . ($options['YT_Width'] + $options['YT_Border']) . 'px;') ?><?php echo ($options['YT_ZIndex'] ? 'z-index: ' . $options['YT_ZIndex'] . ';' : '') ?>;">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['YT_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['YT_BorderColor'] ?>; height: <?php echo $options['YT_Height'] ?>px; width: <?php echo $options['YT_Width'] ?>px; padding: <?php echo ($options['YT_Position'] == 'Left' ? $options['YT_Border'] . 'px ' . $options['YT_Border'] . 'px ' . $options['YT_Border'] . 'px 0' : $options['YT_Border'] . 'px 0 ' . $options['YT_Border'] . 'px ' . $options['YT_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_YT_position; ?> <?php echo ($options['YT_Position'] == 'Left' ? 'left: ' . ($options['YT_Width'] + $options['YT_Border']) . 'px;' : 'right: ' . ($options['YT_Width'] + $options['YT_Border']) . 'px;') ?>">YouTube</h2>
				<div id="fblbInnerYt" class="fblbInner fblbInnerLoading" style="background-color: <?php echo $options['YT_BackgroundColor'] ?>; height: <?php echo $options['YT_Height'] ?>px;">				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
<!--
var fblbYtLoaded=0;
function __fblb_YTGet(data) 
{
	if(!data.feed.entry)
	{
		return false;
	}
	var MonthNames=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	jQuery.each(data.feed.entry, function(i,e) {
		if(!e.published)
		{
			added=new Date(e.updated.$t);
		}
		else
		{
			added=new Date(e.published.$t);
		}
		jQuery('#fblbYtList').append('<li>' +
		'<a href="' + e.link[0].href +'" class="fblbthumb-link"><img src="' + e.media$group.media$thumbnail[1].url + '" alt="" width="61" height="45" class="fblbthumb" /></a>' +
		'<div class="fblbbd">' +
		'<a href="' + e.link[0].href +'" class="fblbtitle">' + e.title.$t + '</a>' +
		'<span class="fblbinfo">' + (!e.yt$statistics ? '' : 'views: ' + e.yt$statistics.viewCount + ' |' ) + ' added: ' + (added.getDate()) + ' ' + MonthNames[added.getMonth()] + ' ' + added.getFullYear() + '</span>' +
		'</div>' +
		'</li>');
	});
	jQuery('#fblbYtList').lionbars();
}
function fblb_YtLoad()
{
	if(fblbYtLoaded==1)
	{
		return true;
	}
	<?php
	if($options['YT_ShowBadge']==1)
	{
	?>
	jQuery('#fblbInnerYt').append('<div style="overflow: hidden; height: 104px;"><iframe id="fblbYTS" src="//www.youtube.com/subscribe_widget?p=<?php echo $options['YT_Channel']; ?>" style="overflow: hidden; height: 104px; width:100%; border: 0;" scrolling="no" frameBorder="0"></iframe></div>');
	<?php
	}
	?>
	<?php
	if($options['YT_ShowVideos']==1)
	{
		?>
		jQuery('#fblbInnerYt').append('<div style="overflow-y: auto; overflow-x: hidden; height: <?php echo ($options['YT_ShowBadge'] ? $options['YT_Height']-104 : $options['YT_Height']);?>px;"><ul id="fblbYtList" class="fblbList" style="height: <?php echo ($options['YT_ShowBadge'] ? $options['YT_Height']-104 : $options['YT_Height']);?>px"></ul></div>');
		<?php
		if($options['YT_Stream'] == 'playlist')
		{
		?>
			jQuery.getScript("//gdata.youtube.com/feeds/api/playlists/<?php echo $options['YT_StreamID']; ?>?alt=json-in-script&max-results=<?php echo $options['YT_NumberofVideos']; ?>&callback=__fblb_YTGet");
		<?php
		}
		else
		{
		?>
			jQuery.getScript("//gdata.youtube.com/feeds/users/<?php echo $options['YT_Channel']; ?>/<?php echo $options['YT_Stream']; ?>?alt=json-in-script&max-results=<?php echo $options['YT_NumberofVideos']; ?>&callback=__fblb_YTGet");
		<?php
		}
		?>
	<?php
	}
	?>
	jQuery('#fblbInnerYt').removeClass('fblbInnerLoading');
   fblbYtLoaded=1;
}
jQuery(document).ready(function(){	
<?php
if($options['YT_Load']==1)
{	
	echo 'fblb_YtLoad();';
}
?>
});
-->
</script>