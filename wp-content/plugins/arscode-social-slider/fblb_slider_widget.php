<div class="fblbReset">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $options['Locale']?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box" data-colorscheme="<?php echo $options['ColorScheme']?>"  data-border-color="<?php echo  $options['BorderColor'] ?>" data-href="<?php echo  $options['FacebookPageURL'] ?>" data-width="<?php echo $options['Width']?>" data-height="<?php echo $options['Height']?>" data-show-faces="<?php echo ($options['ShowFaces'] ? 'true' : 'false')?>" data-stream="<?php echo ($options['ShowStream'] ? 'true' : 'false')?>" data-header="<?php echo ($options['ShowHeader'] ? 'true' : 'false')?>"></div>
</div>