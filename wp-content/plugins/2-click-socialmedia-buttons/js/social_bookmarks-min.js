(function(a){function g(a,b,c,d){var e=new Date;e.setTime(e.getTime()-100);document.cookie=a+"="+b+"; expires="+e.toUTCString()+"; path="+c+"; domain="+d}function f(a,b,c,d,e){var f=new Date;f.setTime(f.getTime()+c*24*60*60*1e3);document.cookie=a+"="+b+"; expires="+f.toUTCString()+"; path="+d+"; domain="+e}function e(){var b=document.location.href;var c=a("link[rel=canonical]").attr("href");if(c&&(c.length>0)){if(c.indexOf("http")<0){c=document.location.protocol+"//"+document.location.host+c}b=c}return b}function d(){var b=c("DC.title");var d=c("DC.creator");if((b.length>0)&&(d.length>0)){b+=" - "+d}else{b=a("title").text()}return encodeURIComponent(b)}function c(b){var c=a('meta[name="'+b+'"]').attr("content");return c||""}function b(a,b){var c=decodeURIComponent(a);if(c.length<=b){return a}var d=c.substring(0,b-1).lastIndexOf(" ");c=encodeURIComponent(c.substring(0,d))+"…";return c}"use strict";a.fn.socialSharePrivacy=function(c){var d={services:{facebook:{status:"on",dummy_img:"",txt_info:"2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Facebook senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.",txt_fb_off:"nicht mit Facebook verbunden",txt_fb_on:"mit Facebook verbunden",perma_option:"on",display_name:"Facebook",referrer_track:"",language:"de_DE",action:"recommend"},twitter:{status:"on",dummy_img:"",txt_info:"2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Twitter senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.",txt_twitter_off:"nicht mit Twitter verbunden",txt_twitter_on:"mit Twitter verbunden",perma_option:"on",display_name:"Twitter",reply_to:"",tweet_text:"",referrer_track:"",language:"de"},gplus:{status:"on",dummy_img:"",txt_info:"2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Google+ senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.",txt_gplus_off:"nicht mit Google+ verbunden",txt_plus_on:"mit Google+ verbunden",perma_option:"on",display_name:"Google+",referrer_track:"",plusone_lib:""},flattr:{status:"on",uid:"",dummy_img:"",txt_info:"2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Flattr senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.",txt_flattr_off:"nicht mit Flattr verbunden",txt_flattr_on:"mit Flattr verbunden",perma_option:"on",display_name:"Flattr",the_title:"",referrer_track:"",the_excerpt:""},xing:{status:"on",dummy_img:"",txt_info:"2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Xing senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.",txt_gplus_off:"nicht mit Xing verbunden",txt_plus_on:"mit Xing verbunden",perma_option:"on",display_name:"Xing",referrer_track:"",language:"de",xing_lib:""}},info_link:"http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html",txt_help:"Wenn Sie diese Felder durch einen Klick aktivieren, werden Informationen an Facebook, Twitter, Flattr oder Google ins Ausland übertragen und unter Umständen auch dort gespeichert. Näheres erfahren Sie durch einen Klick auf das <em>i</em>.",settings_perma:"Dauerhaft aktivieren und Datenüber-tragung zustimmen:",cookie_path:"/",cookie_domain:document.location.host,cookie_expires:"365",css_path:"",uri:e};var c=a.extend(true,d,c);var h=c.services.facebook.status==="on";var i=c.services.twitter.status==="on";var j=c.services.gplus.status==="on";var k=c.services.flattr.status==="on";var l=c.services.xing.status==="on";if(!h&&!i&&!j&&!k&&!l){return}if(c.css_path.length>0){a("head").append('<link rel="stylesheet" type="text/css" href="'+c.css_path+'" />')}a(this).prepend('<ul class="social_share_privacy_area"></ul>');var m=a(".social_share_privacy_area",this);var n=c.uri;if(typeof n==="function"){n=n()}return this.each(function(){if(h){var d=encodeURIComponent(n+c.services.facebook.referrer_track);var e='<iframe src="http://www.facebook.com/plugins/like.php?locale='+c.services.facebook.language+"&href="+d+"&send=false&layout=button_count&width=120&show_faces=false&action="+c.services.facebook.action+'&colorscheme=light&font&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:145px; height:21px;" allowTransparency="true"></iframe>';var o='<img src="'+c.services.facebook.dummy_img+'" alt="Facebook "Like"-Dummy" class="fb_like_privacy_dummy" />';m.append('<li class="facebook help_info"><span class="info">'+c.services.facebook.txt_info+'</span><span class="switch off">'+c.services.facebook.txt_fb_off+'</span><div class="fb_like dummy_btn">'+o+"</div></li>");var p=a("li.facebook",m);a("li.facebook div.fb_like img.fb_like_privacy_dummy,li.facebook span.switch",m).live("click",function(){if(p.find("span.switch").hasClass("off")){p.addClass("info_off");p.find("span.switch").addClass("on").removeClass("off").html(c.services.facebook.txt_fb_on);p.find("img.fb_like_privacy_dummy").replaceWith(e)}else{p.removeClass("info_off");p.find("span.switch").addClass("off").removeClass("on").html(c.services.facebook.txt_fb_off);p.find(".fb_like").html(o)}})}if(i){var q=c.services.twitter.tweet_text;if(typeof q==="function"){q=q()}q=b(q,"120");var r=encodeURIComponent(n+c.services.twitter.referrer_track);var s=encodeURIComponent(n);var t='<iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url='+r+"&counturl="+s+"&text="+q+"&via="+c.services.twitter.reply_to+"&count=horizontal&lang="+c.services.twitter.language+'" style="width:130px; height:25px;"></iframe>';var u='<img src="'+c.services.twitter.dummy_img+'" alt=""Tweet this"-Dummy" class="tweet_this_dummy" />';m.append('<li class="twitter help_info"><span class="info">'+c.services.twitter.txt_info+'</span><span class="switch off">'+c.services.twitter.txt_twitter_off+'</span><div class="tweet dummy_btn">'+u+"</div></li>");var v=a("li.twitter",m);a("li.twitter div.tweet img,li.twitter span.switch",m).live("click",function(){if(v.find("span.switch").hasClass("off")){v.addClass("info_off");v.find("span.switch").addClass("on").removeClass("off").html(c.services.twitter.txt_twitter_on);v.find("img.tweet_this_dummy").replaceWith(t)}else{v.removeClass("info_off");v.find("span.switch").addClass("off").removeClass("on").html(c.services.twitter.txt_twitter_off);v.find(".tweet").html(u)}})}if(j){var w=n+c.services.gplus.referrer_track;var x='<div class="g-plusone" data-size="medium" data-href="'+w+'"></div><script type="text/javascript">window.___gcfg = {lang: "'+c.services.gplus.language+'"}; (function() { var po = document.createElement("script"); po.type = "text/javascript"; po.async = true; po.src = "https://apis.google.com/js/plusone.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s); })(); </script>';var y='<img src="'+c.services.gplus.dummy_img+'" alt=""Google+1"-Dummy" class="gplus_one_dummy" />';m.append('<li class="gplus help_info"><span class="info">'+c.services.gplus.txt_info+'</span><span class="switch off">'+c.services.gplus.txt_gplus_off+'</span><div class="gplusone dummy_btn">'+y+"</div></li>");var z=a("li.gplus",m);a("li.gplus div.gplusone img,li.gplus span.switch",m).live("click",function(){if(z.find("span.switch").hasClass("off")){z.addClass("info_off");z.find("span.switch").addClass("on").removeClass("off").html(c.services.gplus.txt_gplus_on);z.find("img.gplus_one_dummy").replaceWith(x)}else{z.removeClass("info_off");z.find("span.switch").addClass("off").removeClass("on").html(c.services.gplus.txt_gplus_off);z.find(".gplusone").html(y)}})}if(k){var A=c.services.flattr.the_title;var B=encodeURIComponent(n);var C=c.services.flattr.the_excerpt;var D='<iframe src="http://api.flattr.com/button/view/?uid='+c.services.flattr.uid+"&url="+B+"&title="+A+"&description="+C+'&category=text&language=de_DE&button=compact" style="width:110px; height:22px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>';var E='<img src="'+c.services.flattr.dummy_img+'" alt=""Flattr"-Dummy" class="flattr_dummy" />';m.append('<li class="flattr help_info"><span class="info">'+c.services.flattr.txt_info+'</span><span class="switch off">'+c.services.flattr.txt_flattr_off+'</span><div class="flattrbtn dummy_btn">'+E+"</div></li>");var F=a("li.flattr",m);a("li.flattr div.flattrbtn img,li.flattr span.switch",m).live("click",function(){if(F.find("span.switch").hasClass("off")){F.addClass("info_off");F.find("span.switch").addClass("on").removeClass("off").html(c.services.flattr.txt_flattr_on);F.find("img.flattr_dummy").replaceWith(D)}else{F.removeClass("info_off");F.find("span.switch").addClass("off").removeClass("on").html(c.services.flattr.txt_flattr_off);F.find(".flattrbtn").html(E)}})}if(l){var G=c.services.xing.xing_lib;var H=n+c.services.xing.referrer_track;var I='<iframe allowtransparency="true" src="'+G+"?xing-url="+H+'&size=medium&count=true&lang=de" scrolling="no" frameborder="0" style="border:none; width:110px; height:65px;" align="left"></iframe>';var J='<img src="'+c.services.xing.dummy_img+'" alt=""Xing1"-Dummy" class="xing_dummy" />';m.append('<li class="xing help_info"><span class="info">'+c.services.xing.txt_info+'</span><span class="switch off">'+c.services.xing.txt_gplus_off+'</span><div class="xingbtn dummy_btn">'+J+"</div></li>");var K=a("li.xing",m);a("li.xing div.xingbtn img,li.xing span.switch",m).live("click",function(){if(K.find("span.switch").hasClass("off")){K.addClass("info_off");K.find("span.switch").addClass("on").removeClass("off").html(c.services.xing.txt_xing_on);K.find("img.xing_dummy").replaceWith(I)}else{K.removeClass("info_off");K.find("span.switch").addClass("off").removeClass("on").html(c.services.xing.txt_xing_off);K.find(".xingbtn").html(J)}})}m.append('<li class="settings_info"><div class="settings_info_menu off perma_option_off"><a href="'+c.info_link+'"><span class="help_info icon"><span class="info">'+c.txt_help+"</span></span></a></div></li>");a(".help_info:not(.info_off)",m).live("mouseenter",function(){var b=a(this);var c=window.setTimeout(function(){a(b).addClass("display")},500);a(this).data("timeout_id",c)});a(".help_info",m).live("mouseleave",function(){var b=a(this).data("timeout_id");window.clearTimeout(b);if(a(this).hasClass("display")){a(this).removeClass("display")}});var L=c.services.facebook.perma_option==="on";var M=c.services.twitter.perma_option==="on";var N=c.services.gplus.perma_option==="on";var O=c.services.flattr.perma_option==="on";var P=c.services.xing.perma_option==="on";if(((h&&L)||(i&&M)||(j&&N)||(k&&O)||(l&&P))&&(!a.browser.msie||(a.browser.msie&&(a.browser.version>7)))){var Q=document.cookie.split(";");var R="{";var S=0;for(;S<Q.length;S+=1){var T=Q[S].split("=");R+='"'+a.trim(T[0])+'":"'+a.trim(T[1])+'"';if(S<Q.length-1){R+=","}}R+="}";R=JSON.parse(R);var U=a("li.settings_info",m);U.find(".settings_info_menu").removeClass("perma_option_off");U.find(".settings_info_menu").append('<span class="settings">Einstellungen</span><form><fieldset><legend>'+c.settings_perma+"</legend></fieldset></form>");var V=' checked="checked"';if(h&&L){var W=R.socialSharePrivacy_facebook==="perma_on"?V:"";U.find("form fieldset").append('<input type="checkbox" name="perma_status_facebook" id="perma_status_facebook"'+W+' /><label for="perma_status_facebook">'+c.services.facebook.display_name+"</label>")}if(i&&M){var X=R.socialSharePrivacy_twitter==="perma_on"?V:"";U.find("form fieldset").append('<input type="checkbox" name="perma_status_twitter" id="perma_status_twitter"'+X+' /><label for="perma_status_twitter">'+c.services.twitter.display_name+"</label>")}if(j&&N){var Y=R.socialSharePrivacy_gplus==="perma_on"?V:"";U.find("form fieldset").append('<input type="checkbox" name="perma_status_gplus" id="perma_status_gplus"'+Y+' /><label for="perma_status_gplus">'+c.services.gplus.display_name+"</label>")}if(k&&O){var Z=R.socialSharePrivacy_flattr==="perma_on"?V:"";U.find("form fieldset").append('<input type="checkbox" name="perma_status_flattr" id="perma_status_flattr"'+Z+' /><label for="perma_status_flattr">'+c.services.flattr.display_name+"</label>")}if(l&&P){var _=R.socialSharePrivacy_xing==="perma_on"?V:"";U.find("form fieldset").append('<input type="checkbox" name="perma_status_xing" id="perma_status_xing"'+_+' /><label for="perma_status_xing">'+c.services.xing.display_name+"</label>")}U.find("span.settings").css("cursor","pointer");a(U.find("span.settings"),m).live("mouseenter",function(){var b=window.setTimeout(function(){U.find(".settings_info_menu").removeClass("off").addClass("on")},500);a(this).data("timeout_id",b)});a(U,m).live("mouseleave",function(){var b=a(this).data("timeout_id");window.clearTimeout(b);U.find(".settings_info_menu").removeClass("on").addClass("off")});a(U.find("fieldset input")).live("click",function(b){var d=b.target.id;var e=d.substr(d.lastIndexOf("_")+1,d.length);var h="socialSharePrivacy_"+e;if(a("#"+b.target.id+":checked").length){f(h,"perma_on",c.cookie_expires,c.cookie_path,c.cookie_domain);a("form fieldset label[for="+d+"]",m).addClass("checked")}else{g(h,"perma_on",c.cookie_path,c.cookie_domain);a("form fieldset label[for="+d+"]",m).removeClass("checked")}});if(h&&L&&R.socialSharePrivacy_facebook==="perma_on"){a("li.facebook div.fb_like img",m).click()}if(i&&M&&R.socialSharePrivacy_twitter==="perma_on"){a("li.twitter div.tweet img",m).click()}if(j&&N&&R.socialSharePrivacy_gplus==="perma_on"){a("li.gplus div.gplusone img",m).click()}if(k&&O&&R.socialSharePrivacy_flattr==="perma_on"){a("li.flattr div.flattrbtn img",m).click()}if(l&&P&&R.socialSharePrivacy_xing==="perma_on"){a("li.xing div.xingbtn img",m).click()}}})}})(jQuery)