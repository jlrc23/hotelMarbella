jQuery(document).ready(function(){	
	var fblbFbOrgRight=jQuery('.fblbCenterOuterFb').css('right');
	var fblbFbOrgLeft=jQuery('.fblbCenterOuterFb').css('left');
	var fblbFbOrgzIndex=jQuery('.fblbCenterOuterFb').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterFb').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterFb').stop(true,false).animate({
				right: -3
			},function (){fblb_FbLoad();});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterFb').stop(true,false).animate({
				right: fblbFbOrgRight
			},function (){ jQuery(this).css('z-index',fblbFbOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterFb').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterFb').stop(true,false).animate({
				left: -3
			},function (){fblb_FbLoad();});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterFb').stop(true,false).animate({
				left: fblbFbOrgLeft
			},function (){ jQuery(this).css('z-index',fblbFbOrgzIndex);});
	});	
	var fblbTwOrgRight=jQuery('.fblbCenterOuterTw').css('right');
	var fblbTwOrgLeft=jQuery('.fblbCenterOuterTw').css('left');
	var fblbTwOrgzIndex=jQuery('.fblbCenterOuterTw').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterTw').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterTw').stop(true,false).animate({
				right: -3
			});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterTw').stop(true,false).animate({
				right: fblbTwOrgRight
			},function (){ jQuery(this).css('z-index',fblbTwOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterTw').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterTw').stop(true,false).animate({
				left: -3
			});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterTw').stop(true,false).animate({
				left: fblbTwOrgLeft
			},function (){ jQuery(this).css('z-index',fblbTwOrgzIndex);});
	});	
	var fblbGpOrgRight=jQuery('.fblbCenterOuterGp').css('right');
	var fblbGpOrgLeft=jQuery('.fblbCenterOuterGp').css('left');
	var fblbGpOrgzIndex=jQuery('.fblbCenterOuterGp').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterGp').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterGp').stop(true,false).animate({
				right: -3
			},function (){fblb_GpLoad();});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterGp').stop(true,false).animate({
				right: fblbGpOrgRight
			},function (){ jQuery(this).css('z-index',fblbGpOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterGp').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterGp').stop(true,false).animate({
				left: -3
			},function (){fblb_GpLoad();});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterGp').stop(true,false).animate({
				left: fblbGpOrgLeft
			},function (){ jQuery(this).css('z-index',fblbGpOrgzIndex);});
	});	
	var fblbYtOrgRight=jQuery('.fblbCenterOuterYt').css('right');
	var fblbYtOrgLeft=jQuery('.fblbCenterOuterYt').css('left');
	var fblbYtOrgzIndex=jQuery('.fblbCenterOuterYt').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterYt').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterYt').stop(true,false).animate({
				right: -3
			},function (){ fblb_YtLoad();jQuery('#fblbInnerYt').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterYt').stop(true,false).animate({
				right: fblbYtOrgRight
			},function (){ jQuery(this).css('z-index',fblbYtOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterYt').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterYt').stop(true,false).animate({
				left: -3
			},function (){ fblb_YtLoad();jQuery('#fblbInnerYt').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterYt').stop(true,false).animate({
				left: fblbYtOrgLeft
			},function (){ jQuery(this).css('z-index',fblbYtOrgzIndex);});
	});
	var fblbViOrgRight=jQuery('.fblbCenterOuterVi').css('right');
	var fblbViOrgLeft=jQuery('.fblbCenterOuterVi').css('left');
	var fblbViOrgzIndex=jQuery('.fblbCenterOuterVi').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterVi').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterVi').stop(true,false).animate({
				right: -3
			},function (){/*fblb_ViLoad();*/jQuery('#fblbInnerVi').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterVi').stop(true,false).animate({
				right: fblbViOrgRight
			},function (){ jQuery(this).css('z-index',fblbViOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterVi').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterVi').stop(true,false).animate({
				left: -3
			},function (){/*fblb_ViLoad();*/jQuery('#fblbInnerVi').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterVi').stop(true,false).animate({
				left: fblbViOrgLeft
			},function (){ jQuery(this).css('z-index',fblbViOrgzIndex);});
	});
	var fblbLiOrgRight=jQuery('.fblbCenterOuterLi').css('right');
	var fblbLiOrgLeft=jQuery('.fblbCenterOuterLi').css('left');
	var fblbLiOrgzIndex=jQuery('.fblbCenterOuterLi').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterLi').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterLi').stop(true,false).animate({
				right: -3
			},function (){ fblb_LiLoad();jQuery('#fblbInnerLi').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterLi').stop(true,false).animate({
				right: fblbLiOrgRight
			},function (){ jQuery(this).css('z-index',fblbLiOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterLi').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterLi').stop(true,false).animate({
				left: -3
			},function (){ fblb_LiLoad();jQuery('#fblbInnerLi').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterLi').stop(true,false).animate({
				left: fblbLiOrgLeft
			},function (){ jQuery(this).css('z-index',fblbLiOrgzIndex);});
	});
	
	var fblbPiOrgRight=jQuery('.fblbCenterOuterPi').css('right');
	var fblbPiOrgLeft=jQuery('.fblbCenterOuterPi').css('left');
	var fblbPiOrgzIndex=jQuery('.fblbCenterOuterPi').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterPi').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterPi').stop(true,false).animate({
				right: -3
			},function (){ jQuery('#fblbInnerPi').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterPi').stop(true,false).animate({
				right: fblbPiOrgRight
			},function (){ jQuery(this).css('z-index',fblbPiOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterPi').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterPi').stop(true,false).animate({
				left: -3
			},function (){ jQuery('#fblbInnerPi').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterPi').stop(true,false).animate({
				left: fblbPiOrgLeft
			},function (){ jQuery(this).css('z-index',fblbPiOrgzIndex);});
	});
	
    
    var fblbInstOrgRight=jQuery('.fblbCenterOuterInst').css('right');
	var fblbInstOrgLeft=jQuery('.fblbCenterOuterInst').css('left');
	var fblbInstOrgzIndex=jQuery('.fblbCenterOuterInst').css('z-index');
	jQuery('.fblbRight.fblbCenterOuterInst').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterInst').stop(true,false).animate({
				right: -3
			},function (){ jQuery('#fblbInnerInst').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterInst').stop(true,false).animate({
				right: fblbInstOrgRight
			},function (){ jQuery(this).css('z-index',fblbInstOrgzIndex);});
	});
	jQuery('.fblbLeft.fblbCenterOuterInst').find('.fblbForm').hover(
		function(){
			jQuery(this).parents('.fblbCenterOuter').css('z-index',9999999);
			jQuery(this).parents('.fblbCenterOuterInst').stop(true,false).animate({
				left: -3
			},function (){ jQuery('#fblbInnerInst').removeClass('fblbInnerLoading');});
		},
		function(){
			jQuery(this).parents('.fblbCenterOuterInst').stop(true,false).animate({
				left: fblbInstOrgLeft
			},function (){ jQuery(this).css('z-index',fblbInstOrgzIndex);});
	});
});