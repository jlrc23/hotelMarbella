(function(e){e.justifiedImageGrid=function(k,a){var l=this,i=e(k),j=e.browser.msie;l.init=function(){a.minHeight=a.targetHeight-a.heightDeviation;a.maxHeight=a.targetHeight+a.heightDeviation;a.defaultHeightRatio=a.targetHeight/a.maxHeight;if("no"!=a.lightbox&&"links-off"!=a.lightbox)switch(a.linkClass=""!=a.linkClass?' class="'+a.linkClass+'" ':"",a.linkRel){case "auto":switch(a.lightbox){case "prettyphoto":a.linkRel=' rel="prettyPhoto['+a.instance+']" ';break;case "colorbox":a.linkRel=' rel="colorBox['+ a.instance+']" ';break;case "custom":a.linkRel=' rel="gallery['+a.instance+']" '}break;case "0":a.linkRel="";break;default:a.linkRel=' rel="'+a.linkRel+'" '}else a.linkClass="",a.linkRel="";a.allItems=a.items.slice();a.hiddenOpacity=!j?0:0.01;l.createGallery();e("img",i).load(function(){e(this).closest("a").fadeIn(a.animSpeed);if("off"!=a.desaturate){var b=e(this).clone().addClass("jig-desaturated").insertAfter(e(this));e.browser.opera&&(e(this).next().pixastic("desaturate",{average:!1}),"hovered"== a.desaturate&&e(this).next().css("display","none").css("opacity",1));b.load(function(){var b=e(this).parent();Pixastic.process(this,"desaturate",{average:false});a.desaturate=="hovered"&&(j?b.find(".jig-desaturated").css("opacity",a.hiddenOpacity):b.find(".jig-desaturated").css("display","none").css("opacity",1))})}});var b=h=g=d=o=m=function(){return!1},c=function(b,c,d){b.find(c).hoverFlow(d,{opacity:"show"},a.animSpeed)},f=function(b,c,d){b.find(c).hoverFlow(d,{opacity:"hide"},a.animSpeed)};switch(a.overlay){case "hovered":var b= function(a){c(a,"div.jig-overlay-wrapper","mouseenter")},d=function(a){f(a,"div.jig-overlay-wrapper","mouseleave")};break;case "others":b=function(a){f(a,"div.jig-overlay-wrapper","mouseenter")},d=function(a){c(a,"div.jig-overlay-wrapper","mouseleave")}}if(j)switch(a.desaturate){case "others":h=function(b){b.find(".jig-desaturated").hoverFlow("mouseenter",{opacity:0.01},a.animSpeed)};o=function(b){b.find(".jig-desaturated").hoverFlow("mouseleave",{opacity:1},a.animSpeed)};break;case "hovered":h=function(b){b.find(".jig-desaturated").hoverFlow("mouseenter", {opacity:1},a.animSpeed)},o=function(b){b.find(".jig-desaturated").hoverFlow("mouseleave",{opacity:0.01},a.animSpeed)}}else switch(a.desaturate){case "others":var h=function(a){f(a,".jig-desaturated","mouseenter")},o=function(a){c(a,".jig-desaturated","mouseleave")};break;case "hovered":h=function(a){c(a,".jig-desaturated","mouseenter")},o=function(a){f(a,".jig-desaturated","mouseleave")}}switch(a.caption){case "fade":var g=function(a){c(a,"div.jig-caption","mouseenter")},m=function(a){f(a,"div.jig-caption", "mouseleave")};break;case "slide":j?(g=function(a){c(a,"div.jig-caption","mouseenter")},m=function(a){f(a,"div.jig-caption","mouseleave")}):(g=function(b){b.find("div.jig-caption").hoverFlow("mouseenter",{height:"show"},a.animSpeed)},m=function(b){b.find("div.jig-caption").hoverFlow("mouseleave",{height:"hide"},a.animSpeed)});break;case "mixed":g=function(b){b.find("div.jig-caption-description-wrapper").hoverFlow("mouseenter",{height:"show"},a.animSpeed)},m=function(b){b.find("div.jig-caption-description-wrapper").hoverFlow("mouseleave", {height:"hide"},a.animSpeed)}}i.on("mouseenter mouseleave","a",function(a){var c=e(this);a.stopImmediatePropagation();"mouseenter"===a.type?(b(c),h(c),g(c),c.data("title",c.attr("title")),c.removeAttr("title")):(d(c),o(c),m(c),c.attr("title",c.data("title")))});e.browser.msie&&(8>e.browser.version&&"off"!=a.overlay)&&e(".jig-overlay").css({position:"absolute",bottom:0,left:0,right:0,top:0});"links-off"==a.lightbox&&(i.find("a").css("cursor","default"),i.on("click","a",function(a){a.preventDefault()})); i.on("mousedown","a",function(){e(this).attr("title",e(this).data("title"))})};l.createGallery=function(){i.css("width","").css("width",i.width());var b=i.width()-1;if(!(a.areaWidth&&a.areaWidth==b)){a.areaWidth=b;a.row=[];a.fullWidth=a.extra=0;b=[];for(a.items=a.allItems.slice();0<a.items.length;)b.push(n());for(var c in b)for(var f in b[c]){var d=b[c][f];if(d.container){f==b[c].length-1?d.container.css("margin-right",0):d.container.css("margin-right","");var h=d.overflow;h.css("width",(d.containerWidth? d.containerWidth:d.newWidth)+"px");h.css("height",(d.containerHeight?d.containerHeight:d.newHeight)+"px");h=d.img;h.css("width",d.newWidth+"px");h.css("height",d.newHeight+"px");d.marLeft?h.css("margin-left",-d.marLeft+"px"):h.css("margin-left","");"off"!=a.desaturate&&q(h.next(),h)}else{var g=b[c].length,k=f,h=e('<div class="jig-imageContainer"/>'),m=e('<div class="jig-overflow"/>'),j=d.url;linkClass=a.linkClass;linkRel=a.linkRel;d.link&&(j=d.link,linkClass=' class="jig-customLink" ',linkRel=""); link=e("<a"+linkClass+linkRel+' title="'+d[a.linkTitleField]+'" href="'+("links-off"!=a.lightbox?j:"#")+'"/>');img=e("<img/>");link.hide();k==g-1&&h.css("margin-right",0);m.css("width",(d.containerWidth?d.containerWidth:d.newWidth)+"px");m.css("height",(d.containerHeight?d.containerHeight:d.newHeight)+"px");ext="";2<d.url.lastIndexOf(".")&&(ext="&ext="+d.url.substring(d.url.lastIndexOf(".")));img.attr("src",a.timthumb+"?src="+d.url+"&h="+a.maxHeight+"&q="+a.quality+ext);img.attr("alt",d[a.imgAltField]); img.css("width",d.newWidth+"px");img.css("height",d.newHeight+"px");d.marLeft&&img.css("margin-left",-d.marLeft+"px");img.css("margin-top",0);link.append(img);"off"!=a.overlay&&link.append('<div class="jig-overlay-wrapper"><div class="jig-overlay"></div></div>');"off"!=a.caption&&(g="",d.description&&(g='<div class="jig-caption-description-wrapper"><div class="jig-caption-description">'+d[a.captionField]+"</div></div>"),link.append('<div class="jig-caption-wrapper"><div class="jig-caption"><div class="jig-caption-title">'+ d.title+"</div>"+g+"</div></div>"));m.append(link);h.append(m);i.find(".jig-clearfix").before(h);d.container=h;d.overflow=m;d.img=img}}i.css("width","").css("width",i.width());a.areaWidth!=i.width()-1&&l.createGallery()}};var n=function(){a.row=[];a.fullWidth=0;for(a.extra=0;0<a.items.length&&a.extra<a.areaWidth;){var b=a.items.shift();b.newHeight=b.newWidth=b.containerHeight=b.containerWidth=b.marLeft=void 0;b.ratio=b.width/a.maxHeight;a.row.push(b);a.fullWidth+=Math.round(b.width*a.defaultHeightRatio)+ a.margins;a.extra=a.fullWidth-a.margins}a.extra-=a.areaWidth;if(0<a.row.length&&0<a.extra){var b=0,c;for(c in a.row)b+=a.row[c].ratio;if(1<b/a.row.length)a:{a.marginsTotal=(a.row.length-1)*a.margins;a.rowlen=0;a.heights=[];for(var f in a.row){c=Math.round(a.row[f].width*a.defaultHeightRatio);b=Math.round((c+a.marginsTotal/a.row.length)/a.fullWidth*a.extra);a.row[f].newWidth=c-b;a.heights[f]=a.row[f].newWidth/a.row[f].ratio;if(a.heights[f]<a.minHeight){p();break a}a.row[f].newHeight=a.heights[f];a.rowlen+= a.row[f].newWidth}a.remaining=a.rowlen+a.marginsTotal-a.areaWidth;g()}else p()}else for(c in a.row)b=a.row[c],b.marLeft=0,b.newHeight=a.targetHeight,b.newWidth=Math.round(b.newHeight*b.ratio);return a.row},p=function(){if(1!=a.row.length){var b=a.row.pop();a.fullWidth-=Math.round(b.width*a.defaultHeightRatio)+a.margins;a.items.unshift(b);a.extra=a.fullWidth-a.margins;a.extra-=a.areaWidth}a.marginsTotal=(a.row.length-1)*a.margins;a.rowlen=0;a.heights=[];for(var c in a.row){var b=Math.round(a.row[c].width* a.defaultHeightRatio),f=Math.round((b+a.marginsTotal/a.row.length)/a.fullWidth*a.extra);a.row[c].newWidth=b-f;a.heights[c]=a.row[c].newWidth/a.row[c].ratio;if(a.heights[c]>a.maxHeight){c=a.items.shift();a.row.push(c);a.fullWidth+=Math.round(c.width*a.defaultHeightRatio)+a.margins;a.extra=a.fullWidth-a.margins;a.extra-=a.areaWidth;r();return}if(a.heights[c]<a.minHeight){r();return}a.row[c].newHeight=a.heights[c];a.rowlen+=a.row[c].newWidth}a.remaining=a.rowlen+a.marginsTotal-a.areaWidth;g()},g=function(){if(0!= a.remaining)if(0<a.remaining)for(;0<a.remaining;)for(var b in a.row){if(a.row[b].newWidth--,a.row[b].newHeight=a.heights[b]=a.row[b].newWidth/a.row[b].ratio,a.remaining--,0==a.remaining)break}else for(;0>a.remaining;)for(b in a.row)if(a.row[b].newWidth++,a.row[b].newHeight=a.heights[b]=a.row[b].newWidth/a.row[b].ratio,a.remaining++,0==a.remaining)break;a.heights.sort(function(a,b){return a-b});var c=Math.floor(a.heights[0]);for(b in a.row)a.row[b].containerHeight=c,a.row[b].newHeight=Math.round(a.row[b].newHeight)}, r=function(){var b=[],c=0;a.marginsTotal=(a.row.length-1)*a.margins;for(var f in a.row){var d=a.row[f],e=Math.round(a.row[f].width*a.defaultHeightRatio);d.newHeight=a.targetHeight;d.newWidth=e;b[f]=Math.round((e+a.marginsTotal/a.row.length)/a.fullWidth*a.extra);c+=b[f]}c=a.extra-c;if(0!=c)if(0<c)for(;0<c;)for(f in b){if(b[f]++,c--,0==c)break}else for(;0>c;)for(f in b)if(b[f]--,c++,0==c)break;for(var g in a.row)f=b[g],c=a.row[g],c.marLeft=Math.round(f/2),c.containerWidth=c.newWidth-f},q=function(b, c){if(b.hasClass("jig-desaturated")){b.remove();var f=c.clone().addClass("jig-desaturated").insertAfter(c);e.browser.opera&&(c.next().pixastic("desaturate",{average:!1}),"hovered"==a.desaturate?c.next().css("display","none").css("opacity",1):c.next().css("opacity",1));f.load(function(){Pixastic.process(this,"desaturate",{average:false});a.desaturate=="hovered"?j?c.next().css("opacity",a.hiddenOpacity):c.next().css("display","none").css("opacity",1):c.next().css("opacity",1)})}else c.load(function(){q(b, c)})};l.init()};e.fn.justifiedImageGrid=function(k){return this.each(function(){if(void 0==e(this).data("justifiedImageGrid")){var a=new e.justifiedImageGrid(this,k);e(this).data("justifiedImageGrid",a)}})}})(jQuery); (function(e){e.fn.hoverFlow=function(k,a,l,i,j){if(-1==e.inArray(k,["mouseover","mouseenter","mouseout","mouseleave"]))return this;var n="object"===typeof l?l:{complete:j||!j&&i||e.isFunction(l)&&l,duration:l,easing:j&&i||i&&!e.isFunction(i)&&i};n.queue=!1;var p=n.complete;n.complete=function(){e(this).dequeue();e.isFunction(p)&&p.call(this)};return this.each(function(){var g=e(this);"mouseover"==k||"mouseenter"==k?g.data("jQuery.hoverFlow",!0):g.removeData("jQuery.hoverFlow");g.queue(function(){("mouseover"== k||"mouseenter"==k?void 0!==g.data("jQuery.hoverFlow"):void 0===g.data("jQuery.hoverFlow"))?g.animate(a,n):g.queue([])})})}})(jQuery);