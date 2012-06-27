(function($){
	"use strict";
	/*
	 * helper functions
	 */

	// abbreviate at last blank before length and add "\u2026" (horizontal ellipsis)
	function abbreviateText(text, length) {
		var abbreviated = decodeURIComponent(text);

		if(abbreviated.length <= length) {
			return text;
		}

		var lastWhitespaceIndex = abbreviated.substring(0, length - 1).lastIndexOf(' ');
		abbreviated = encodeURIComponent(abbreviated.substring(0, lastWhitespaceIndex)) + "\u2026";

		return abbreviated;
	}

	// returns content of <meta name="" content=""> tags or '' if empty/non existant
	function getMeta(name) {
		var metaContent = $('meta[name="' + name + '"]').attr('content');

		return metaContent || '';
	}

	// create tweet text from content of <meta name="DC.title"> and <meta name="DC.creator">
	// fallback to content of <title> tag
	function getTweetText() {
		var title = getMeta('DC.title');
		var creator = getMeta('DC.creator');

		if((title.length > 0) && (creator.length > 0)) {
			title += ' - ' + creator;
		} else {
			title = $('title').text();
		}

		return encodeURIComponent(title);
	}

	// build URI from rel="canonical" or document.location
	function getURI() {
		var uri = document.location.href;
		var canonical = $("link[rel=canonical]").attr("href");

		if(canonical && (canonical.length > 0)) {
			if(canonical.indexOf("http") < 0) {
				canonical = document.location.protocol + "//" + document.location.host + canonical;
			}

			uri = canonical;
		}

		return uri;
	}

	function cookieSet(name, value, days, path, domain) {
		var expires = new Date();

		expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
		document.cookie = name + '=' + value + '; expires=' + expires.toUTCString() + '; path=' + path + '; domain=' + domain;
	}

	function cookieDel(name, value, path, domain) {
		var expires = new Date();

		expires.setTime(expires.getTime() - 100);
		document.cookie = name + '=' + value + '; expires=' + expires.toUTCString() + '; path=' + path + '; domain=' + domain;
	}

	$.fn.socialSharePrivacy = function(options){
		var defaults = {
			'services' : {
				'facebook' : {
					'status'			: 'on',
					'dummy_img'			: '',
					'dummy_img_width'	: '',
					'dummy_img_height'	: '',
					'txt_info'			: '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Facebook senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.',
					'txt_fb_off'		: 'nicht mit Facebook verbunden',
					'txt_fb_on'			: 'mit Facebook verbunden',
					'perma_option'		: 'on',
					'display_name'		: 'Facebook',
					'referrer_track'	: '',
					'language'			: 'de_DE',
					'action'			: 'recommend'
				},
				'twitter' : {
					'status'			: 'on',
					'dummy_img'			: '',
					'dummy_img_width'	: '',
					'dummy_img_height'	: '',
					'txt_info'			: '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Twitter senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.',
					'txt_twitter_off'	: 'nicht mit Twitter verbunden',
					'txt_twitter_on'	: 'mit Twitter verbunden',
					'perma_option'		: 'on',
					'display_name'		: 'Twitter',
					'reply_to'			: '',
					'tweet_text'		: '',
					'referrer_track'	: '',
					'language'			: 'de'
				},
				'gplus' : {
					'status'			: 'on',
					'dummy_img'			: '',
					'dummy_img_width'	: '',
					'dummy_img_height'	: '',
					'txt_info'			: '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Google+ senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.',
					'txt_gplus_off'		: 'nicht mit Google+ verbunden',
					'txt_plus_on'		: 'mit Google+ verbunden',
					'perma_option'		: 'on',
					'display_name'		: 'Google+',
					'referrer_track'	: '',
					'plusone_lib'		: ''
				},
				'flattr' : {
					'status'			: 'on',
					'uid'				: '',
					'dummy_img'			: '',
					'dummy_img_width'	: '',
					'dummy_img_height'	: '',
					'txt_info'			: '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Flattr senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.',
					'txt_flattr_off'	: 'nicht mit Flattr verbunden',
					'txt_flattr_on'		: 'mit Flattr verbunden',
					'perma_option'		: 'on',
					'display_name'		: 'Flattr',
					'the_title'			: '',
					'referrer_track'	: '',
					'the_excerpt'		: ''
				},
				'xing' : {
					'status'			: 'on',
					'dummy_img'			: '',
					'dummy_img_width'	: '',
					'dummy_img_height'	: '',
					'txt_info'			: '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Xing senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.',
					'txt_xing_off'		: 'nicht mit Xing verbunden',
					'txt_xing_on'		: 'mit Xing verbunden',
					'perma_option'		: 'on',
					'display_name'		: 'Xing',
					'referrer_track'	: '',
					'language'			: 'de',
					'xing_lib'			: ''
				},
				'pinterest' : {
					'status'			: 'on',
					'the_excerpt'		: '',
					'dummy_img'			: '',
					'dummy_img_width'	: '',
					'dummy_img_height'	: '',
					'txt_info'			: '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Pinterest senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.',
					'txt_pinterest_off'	: 'nicht mit Pinterest verbunden',
					'txt_pinterest_on'	: 'mit Pinterest verbunden',
					'perma_option'		: 'on',
					'display_name'		: 'Pinterest',
					'referrer_track'	: '',
					'pinterest_lib'		: '',
					'media'				: ''
				}
			},
			'info_link'			: 'http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html',
			'txt_help'  		: 'Wenn Sie diese Felder durch einen Klick aktivieren, werden Informationen an Facebook, Twitter, Flattr oder Google ins Ausland übertragen und unter Umständen auch dort gespeichert. Näheres erfahren Sie durch einen Klick auf das <em>i</em>.',
			'settings_perma'	: 'Dauerhaft aktivieren und Datenüber-tragung zustimmen:',
			'cookie_path'		: '/',
			'cookie_domain'		: document.location.host,
			'cookie_expires'	: '365',
			'css_path'			: '',
			'uri'				: getURI
		};

		var options = $.extend(true, defaults, options);

		var facebook_on 	= (options.services.facebook.status === 'on');
		var twitter_on  	= (options.services.twitter.status  === 'on');
		var gplus_on		= (options.services.gplus.status === 'on');
		var flattr_on		= (options.services.flattr.status === 'on');
		var xing_on			= (options.services.xing.status === 'on');
		var pinterest_on	= (options.services.pinterest.status === 'on');

		// check if at least one service is "on"
		if(!facebook_on && !twitter_on && !gplus_on && !flattr_on && !xing_on && !pinterest_on) {
			return;
		}

		// insert stylesheet into document and prepend target element
		if(options.css_path.length > 0) {
			$('head').append('<link rel="stylesheet" type="text/css" href="' + options.css_path + '" />');
		}

		$(this).prepend('<ul class="social_share_privacy_area"></ul>');
		var context = $('.social_share_privacy_area', this);

		// canonical uri that will be shared
		var uri = options.uri;

		if(typeof uri === 'function') {
			uri = uri();
		}

		return this.each(function(){
			//
			// Facebook
			//
			if(facebook_on) {
				var fb_enc_uri = encodeURIComponent(uri+options.services.facebook.referrer_track);
				var fb_code = '<iframe src="http://www.facebook.com/plugins/like.php?locale=' + options.services.facebook.language + '&amp;href=' + fb_enc_uri + '&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=' + options.services.facebook.action + '&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:145px; height:21px;" allowTransparency="true"></iframe>';
				var fb_dummy_btn = '<img src="' + options.services.facebook.dummy_img + '" width="' + options.services.facebook.dummy_img_width + '" height="' + options.services.facebook.dummy_img_height + '" alt="Facebook &quot;Like&quot;-Dummy" class="fb_like_privacy_dummy" />';

				context.append('<li class="facebook help_info"><span class="info">' + options.services.facebook.txt_info + '</span><span class="switch off">' + options.services.facebook.txt_fb_off + '</span><div class="fb_like dummy_btn">' + fb_dummy_btn + '</div></li>');

				var $container_fb = $('li.facebook', context);

				$('li.facebook div.fb_like img.fb_like_privacy_dummy,li.facebook span.switch', context).live('click', function () {
					if ($container_fb.find('span.switch').hasClass('off')) {
						$container_fb.addClass('info_off');
						$container_fb.find('span.switch').addClass('on').removeClass('off').html(options.services.facebook.txt_fb_on);
						$container_fb.find('img.fb_like_privacy_dummy').replaceWith(fb_code);
					} else {
						$container_fb.removeClass('info_off');
						$container_fb.find('span.switch').addClass('off').removeClass('on').html(options.services.facebook.txt_fb_off);
						$container_fb.find('.fb_like').html(fb_dummy_btn);
					}
				});
			}

			//
			// Twitter
			//
			if(twitter_on) {
				var text = options.services.twitter.tweet_text;
//				var text = getTweetText();

				if(typeof text === 'function') {
					text = text();
				}

				// 120 is the max character count left after twitters automatic url shortening with t.co
				text = abbreviateText(text, '120');

				var twitter_enc_uri = encodeURIComponent(uri+options.services.twitter.referrer_track);
				var twitter_count_url = encodeURIComponent(uri);
				var twitter_code = '<iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url=' + twitter_enc_uri + '&amp;counturl=' + twitter_count_url + '&amp;text=' + text + '&amp;via='+options.services.twitter.reply_to+'&amp;count=horizontal&amp;lang=' + options.services.twitter.language + '" style="width:130px; height:25px;"></iframe>';
				var twitter_dummy_btn = '<img src="' + options.services.twitter.dummy_img + '" width="' + options.services.twitter.dummy_img_width + '" height="' + options.services.twitter.dummy_img_height + '" alt="&quot;Tweet this&quot;-Dummy" class="twitter_dummy" />';

				context.append('<li class="twitter help_info"><span class="info">' + options.services.twitter.txt_info + '</span><span class="switch off">' + options.services.twitter.txt_twitter_off + '</span><div class="tweet dummy_btn">' + twitter_dummy_btn + '</div></li>');

				var $container_tw = $('li.twitter', context);

				$('li.twitter div.tweet img,li.twitter span.switch', context).live('click', function () {
					if($container_tw.find('span.switch').hasClass('off')) {
						$container_tw.addClass('info_off');
						$container_tw.find('span.switch').addClass('on').removeClass('off').html(options.services.twitter.txt_twitter_on);
						$container_tw.find('img.twitter_dummy').replaceWith(twitter_code);
					} else {
						$container_tw.removeClass('info_off');
						$container_tw.find('span.switch').addClass('off').removeClass('on').html(options.services.twitter.txt_twitter_off);
						$container_tw.find('.tweet').html(twitter_dummy_btn);
					}
				});
			}

			//
			// Google+
			//
			if(gplus_on) {
				// fuer G+ wird die URL nicht encoded, da das zu einem Fehler fuehrt
				var gplus_uri = uri + options.services.gplus.referrer_track;

				// we use the Google+ "asynchronous" code, standard code is flaky if inserted into dom after load
				var gplus_code = '<div class="g-plusone" data-size="medium" data-href="' + gplus_uri + '"></div><script type="text/javascript">window.___gcfg = {lang: "' + options.services.gplus.language + '"}; (function() { var po = document.createElement("script"); po.type = "text/javascript"; po.async = true; po.src = "https://apis.google.com/js/plusone.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s); })(); </script>';
				var gplus_dummy_btn = '<img src="' + options.services.gplus.dummy_img + '" width="' + options.services.gplus.dummy_img_width + '" height="' + options.services.gplus.dummy_img_height + '" alt="&quot;Google+1&quot;-Dummy" class="gplus_one_dummy" />';

				context.append('<li class="gplus help_info"><span class="info">' + options.services.gplus.txt_info + '</span><span class="switch off">' + options.services.gplus.txt_gplus_off + '</span><div class="gplusone dummy_btn">' + gplus_dummy_btn + '</div></li>');

				var $container_gplus = $('li.gplus', context);

				$('li.gplus div.gplusone img,li.gplus span.switch', context).live('click', function () {
					if($container_gplus.find('span.switch').hasClass('off')) {
						$container_gplus.addClass('info_off');
						$container_gplus.find('span.switch').addClass('on').removeClass('off').html(options.services.gplus.txt_gplus_on);
						$container_gplus.find('img.gplus_one_dummy').replaceWith(gplus_code);
					} else {
						$container_gplus.removeClass('info_off');
						$container_gplus.find('span.switch').addClass('off').removeClass('on').html(options.services.gplus.txt_gplus_off);
						$container_gplus.find('.gplusone').html(gplus_dummy_btn);
					}
				});
			}

			//
			// Flattr
			//
			if(flattr_on) {
				var flattr_title = options.services.flattr.the_title;
				var flattr_uri = encodeURIComponent(uri);
				var flattr_excerpt = options.services.flattr.the_excerpt;
				var flattr_code = '<iframe src="http://api.flattr.com/button/view/?uid=' + options.services.flattr.uid + '&amp;url=' + flattr_uri + '&amp;title=' + flattr_title + '&amp;description=' + flattr_excerpt + '&amp;category=text&amp;language=de_DE&amp;button=compact" style="width:110px; height:22px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>';
				var flattr_dummy_btn = '<img src="' + options.services.flattr.dummy_img + '" width="' + options.services.flattr.dummy_img_width + '" height="' + options.services.flattr.dummy_img_height + '" alt="&quot;Flattr&quot;-Dummy" class="flattr_dummy" />';

				context.append('<li class="flattr help_info"><span class="info">' + options.services.flattr.txt_info + '</span><span class="switch off">' + options.services.flattr.txt_flattr_off + '</span><div class="flattrbtn dummy_btn">' + flattr_dummy_btn + '</div></li>');

				var $container_flattr = $('li.flattr', context);

				$('li.flattr div.flattrbtn img,li.flattr span.switch', context).live('click', function () {
					if($container_flattr.find('span.switch').hasClass('off')) {
						$container_flattr.addClass('info_off');
						$container_flattr.find('span.switch').addClass('on').removeClass('off').html(options.services.flattr.txt_flattr_on);
						$container_flattr.find('img.flattr_dummy').replaceWith(flattr_code);
					} else {
						$container_flattr.removeClass('info_off');
						$container_flattr.find('span.switch').addClass('off').removeClass('on').html(options.services.flattr.txt_flattr_off);
						$container_flattr.find('.flattrbtn').html(flattr_dummy_btn);
					}
				});
			}

			//
			// Xing
			//
			if(xing_on) {
				var xing_lib = options.services.xing.xing_lib;
				var xing_uri = uri + options.services.xing.referrer_track;

				var xing_code = '<iframe allowtransparency="true" src="' + xing_lib + '?xing-url=' + xing_uri + '" scrolling="no" frameborder="0" style="border:none; width:110px; height:65px;" align="left"></iframe>';
				var xing_dummy_btn = '<img src="' + options.services.xing.dummy_img + '" width="' + options.services.xing.dummy_img_width + '" height="' + options.services.xing.dummy_img_height + '" alt="&quot;Xing&quot;-Dummy" class="xing_dummy" />';

				context.append('<li class="xing help_info"><span class="info">' + options.services.xing.txt_info + '</span><span class="switch off">' + options.services.xing.txt_xing_off + '</span><div class="xingbtn dummy_btn">' + xing_dummy_btn + '</div></li>');

				var $container_xing = $('li.xing', context);

				$('li.xing div.xingbtn img,li.xing span.switch', context).live('click', function () {
					if($container_xing.find('span.switch').hasClass('off')) {
						$container_xing.addClass('info_off');
						$container_xing.find('span.switch').addClass('on').removeClass('off').html(options.services.xing.txt_xing_on);
						$container_xing.find('img.xing_dummy').replaceWith(xing_code);
					} else {
						$container_xing.removeClass('info_off');
						$container_xing.find('span.switch').addClass('off').removeClass('on').html(options.services.xing.txt_xing_off);
						$container_xing.find('.xingbtn').html(xing_dummy_btn);
					}
				});
			}

			//
			// Pinterest
			//
			if(pinterest_on) {
				var pinterest_lib = options.services.pinterest.pinterest_lib;
				var pinterest_uri = uri + options.services.pinterest.referrer_track;
				var pinterest_excerpt = encodeURIComponent(options.services.pinterest.the_excerpt);
				var pinterest_media = options.services.pinterest.media;

				var pinterest_code = '<iframe allowtransparency="true" src="' + pinterest_lib + '?pinterest-url=' + pinterest_uri + '&pinterest-description=' + pinterest_excerpt + '&pinterest-media=' + pinterest_media + '" scrolling="no" frameborder="0" style="border:none; width:110px; height:65px;" align="left"></iframe>';
//				var pinterest_code = '<a href="http://pinterest.com/pin/create/button/?url=' + pinterest_uri + '&media=' + pinterest_media + '&description=' + pinterest_excerpt + '" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a><script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
				var pinterest_dummy_btn = '<img src="' + options.services.pinterest.dummy_img + '" width="' + options.services.pinterest.dummy_img_width + '" height="' + options.services.pinterest.dummy_img_height + '" alt="&quot;Pinterest&quot;-Dummy" class="pinterest_dummy" />';

				context.append('<li class="pinterest help_info"><span class="info">' + options.services.pinterest.txt_info + '</span><span class="switch off">' + options.services.pinterest.txt_pinterest_off + '</span><div class="pinterestbtn dummy_btn">' + pinterest_dummy_btn + '</div></li>');

				var $container_pinterest = $('li.pinterest', context);

				$('li.pinterest div.pinterestbtn img,li.pinterest span.switch', context).live('click', function () {
					if($container_pinterest.find('span.switch').hasClass('off')) {
						$container_pinterest.addClass('info_off');
						$container_pinterest.find('span.switch').addClass('on').removeClass('off').html(options.services.pinterest.txt_pinterest_on);
						$container_pinterest.find('img.pinterest_dummy').replaceWith(pinterest_code);
					} else {
						$container_pinterest.removeClass('info_off');
						$container_pinterest.find('span.switch').addClass('off').removeClass('on').html(options.services.pinterest.txt_pinterest_off);
						$container_pinterest.find('.pinterestbtn').html(pinterest_dummy_btn);
					}
				});
			}

			//
			// Der Info/Settings-Bereich wird eingebunden
			//
			context.append('<li class="settings_info"><div class="settings_info_menu off perma_option_off"><a href="' + options.info_link + '"><span class="help_info icon"><span class="info">' + options.txt_help + '</span></span></a></div></li>');

			// Info-Overlays mit leichter Verzoegerung einblenden
			$('.help_info:not(.info_off)', context).live('mouseenter', function () {
				var $info_wrapper = $(this);
				var timeout_id = window.setTimeout(function () { $($info_wrapper).addClass('display'); }, 500);
				$(this).data('timeout_id', timeout_id);
			});
			$('.help_info', context).live('mouseleave', function () {
				var timeout_id = $(this).data('timeout_id');
				window.clearTimeout(timeout_id);

				if($(this).hasClass('display')) {
					$(this).removeClass('display');
				}
			});

			var facebook_perma		= (options.services.facebook.perma_option	=== 'on');
			var twitter_perma		= (options.services.twitter.perma_option	=== 'on');
			var gplus_perma			= (options.services.gplus.perma_option		=== 'on');
			var flattr_perma		= (options.services.flattr.perma_option		=== 'on');
			var xing_perma			= (options.services.xing.perma_option		=== 'on');
			var pinterest_perma		= (options.services.pinterest.perma_option	=== 'on');

			// Menue zum dauerhaften Einblenden der aktiven Dienste via Cookie einbinden
			// Die IE7 wird hier ausgenommen, da er kein JSON kann und die Cookies hier ueber JSON-Struktur abgebildet werden
			if(((facebook_on && facebook_perma)
				|| (twitter_on && twitter_perma)
				|| (gplus_on && gplus_perma)
				|| (flattr_on && flattr_perma)
				|| (xing_on && xing_perma)
				|| (pinterest_on && pinterest_perma))
				&& (!$.browser.msie || ($.browser.msie && ($.browser.version > 7.0)))) {

				// Cookies abrufen
				var cookie_list = document.cookie.split(';');
				var cookies = '{';
				var i = 0;

				for(; i < cookie_list.length; i += 1) {
					var foo = cookie_list[i].split('=');
					cookies += '"' + $.trim(foo[0]) + '":"' + $.trim(foo[1]) + '"';

					if(i < cookie_list.length - 1) {
						cookies += ',';
					}
				}

				cookies += '}';
				cookies = JSON.parse(cookies);

				// Container definieren
				var $container_settings_info = $('li.settings_info', context);

				// Klasse entfernen, die das i-Icon alleine formatiert, da Perma-Optionen eingeblendet werden
				$container_settings_info.find('.settings_info_menu').removeClass('perma_option_off');

				// Perma-Optionen-Icon (.settings) und Formular (noch versteckt) einbinden
				$container_settings_info.find('.settings_info_menu').append('<span class="settings">Einstellungen</span><form><fieldset><legend>' + options.settings_perma + '</legend></fieldset></form>');


				// Die Dienste mit <input> und <label>, sowie checked-Status laut Cookie, schreiben
				var checked = ' checked="checked"';
				if(facebook_on && facebook_perma) {
					var perma_status_facebook = cookies.socialSharePrivacy_facebook === 'perma_on' ? checked : '';
					$container_settings_info.find('form fieldset').append(
						'<input type="checkbox" name="perma_status_facebook" id="perma_status_facebook"'
							+ perma_status_facebook + ' /><label for="perma_status_facebook">'
							+ options.services.facebook.display_name + '</label>'
					);
				}

				if(twitter_on && twitter_perma) {
					var perma_status_twitter = cookies.socialSharePrivacy_twitter === 'perma_on' ? checked : '';
					$container_settings_info.find('form fieldset').append(
						'<input type="checkbox" name="perma_status_twitter" id="perma_status_twitter"'
							+ perma_status_twitter + ' /><label for="perma_status_twitter">'
							+ options.services.twitter.display_name + '</label>'
					);
				}

				if(gplus_on && gplus_perma) {
					var perma_status_gplus = cookies.socialSharePrivacy_gplus === 'perma_on' ? checked : '';
					$container_settings_info.find('form fieldset').append(
							'<input type="checkbox" name="perma_status_gplus" id="perma_status_gplus"'
							+ perma_status_gplus + ' /><label for="perma_status_gplus">'
							+ options.services.gplus.display_name + '</label>'
					);
				}

				if(flattr_on && flattr_perma) {
					var perma_status_flattr = cookies.socialSharePrivacy_flattr === 'perma_on' ? checked : '';
					$container_settings_info.find('form fieldset').append(
							'<input type="checkbox" name="perma_status_flattr" id="perma_status_flattr"'
							+ perma_status_flattr + ' /><label for="perma_status_flattr">'
							+ options.services.flattr.display_name + '</label>'
					);
				}

				if(xing_on && xing_perma) {
					var perma_status_xing = cookies.socialSharePrivacy_xing === 'perma_on' ? checked : '';
					$container_settings_info.find('form fieldset').append(
						'<input type="checkbox" name="perma_status_xing" id="perma_status_xing"'
							+ perma_status_xing + ' /><label for="perma_status_xing">'
							+ options.services.xing.display_name + '</label>'
					);
				}

				if(pinterest_on && pinterest_perma) {
					var perma_status_pinterest = cookies.socialSharePrivacy_pinterest === 'perma_on' ? checked : '';
					$container_settings_info.find('form fieldset').append(
						'<input type="checkbox" name="perma_status_pinterest" id="perma_status_pinterest"'
							+ perma_status_pinterest + ' /><label for="perma_status_pinterest">'
							+ options.services.pinterest.display_name + '</label>'
					);
				}

				// Cursor auf Pointer setzen fuer das Zahnrad
				$container_settings_info.find('span.settings').css('cursor', 'pointer');

				// Einstellungs-Menue bei mouseover ein-/ausblenden
				$($container_settings_info.find('span.settings'), context).live('mouseenter', function () {
					var timeout_id = window.setTimeout(function () { $container_settings_info.find('.settings_info_menu').removeClass('off').addClass('on'); }, 500);
					$(this).data('timeout_id', timeout_id);
				});
				$($container_settings_info, context).live('mouseleave', function () {
					var timeout_id = $(this).data('timeout_id');
					window.clearTimeout(timeout_id);
					$container_settings_info.find('.settings_info_menu').removeClass('on').addClass('off');
				});

				// Klick-Interaktion auf <input> um Dienste dauerhaft ein- oder auszuschalten (Cookie wird gesetzt oder geloescht)
				$($container_settings_info.find('fieldset input')).live('click', function (event) {
					var click = event.target.id;
					var service = click.substr(click.lastIndexOf('_') + 1, click.length);
					var cookie_name = 'socialSharePrivacy_' + service;

					if($('#' + event.target.id + ':checked').length) {
						cookieSet(cookie_name, 'perma_on', options.cookie_expires, options.cookie_path, options.cookie_domain);
						$('form fieldset label[for=' + click + ']', context).addClass('checked');
					} else {
						cookieDel(cookie_name, 'perma_on', options.cookie_path, options.cookie_domain);
						$('form fieldset label[for=' + click + ']', context).removeClass('checked');
					}
				});

				// Dienste automatisch einbinden, wenn entsprechendes Cookie vorhanden ist
				// Facebook
				if(facebook_on && facebook_perma && cookies.socialSharePrivacy_facebook === 'perma_on') {
//					$('li.facebook span.switch', context).click();
					$('li.facebook div.fb_like img', context).click();
				}

				// Twitter
				if(twitter_on && twitter_perma && cookies.socialSharePrivacy_twitter === 'perma_on') {
//					$('li.twitter span.switch', context).click();
					$('li.twitter div.tweet img', context).click();
				}

				// Googleplus
				if(gplus_on && gplus_perma && cookies.socialSharePrivacy_gplus === 'perma_on') {
//					$('li.gplus span.switch', context).click();
					$('li.gplus div.gplusone img', context).click();
				}

				// Flattr
				if(flattr_on && flattr_perma && cookies.socialSharePrivacy_flattr === 'perma_on') {
//					$('li.flattr span.switch', context).click();
					$('li.flattr div.flattrbtn img', context).click();
				}

				// Xing
				if(xing_on && xing_perma && cookies.socialSharePrivacy_xing === 'perma_on') {
//					$('li.xing span.switch', context).click();
					$('li.xing div.xingbtn img', context).click();
				}

				// Pinterest
				if(pinterest_on && pinterest_perma && cookies.socialSharePrivacy_pinterest === 'perma_on') {
//					$('li.pinterest span.switch', context).click();
					$('li.pinterest div.pinterestbtn img', context).click();
				}
			}
		});
	};
})(jQuery);