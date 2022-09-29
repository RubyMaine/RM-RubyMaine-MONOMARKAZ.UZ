<?php
/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004-2022 SoftNews Media Group
=====================================================
 This code is protected by copyright
=====================================================
 File: main.php
=====================================================
*/

if( !defined('DATALIFEENGINE') ) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}

$home_url = clean_url($config['http_home_url']);

if ($home_url AND clean_url( $_SERVER['HTTP_HOST'] ) != $home_url ) {

	$replace_url = array ();
	$replace_url[0] = $home_url;
	$replace_url[1] = clean_url ( $_SERVER['HTTP_HOST'] );

} else $replace_url = false;

$tpl->load_template ( 'main.tpl' );

$tpl->set ( '{calendar}', $tpl->result['calendar'] );
$tpl->set ( '{archives}', $tpl->result['archive'] );
$tpl->set ( '{tags}', $tpl->result['tags_cloud'] );
$tpl->set ( '{vote}', $tpl->result['vote'] );
$tpl->set ( '{login}', $tpl->result['login_panel'] );
$tpl->set ( '{speedbar}', $tpl->result['speedbar'] );

if ( $dle_module == "showfull" AND $news_found ) {
	
	if( strpos( $tpl->copy_template, "related-news" ) !== false ) {
		$tpl->set( '[related-news]', "" );
		$tpl->set( '[/related-news]', "" );
		$tpl->set( '{related-news}', $related_buffer );
	}
	
	if( strpos( $tpl->copy_template, "[xf" ) !== false OR strpos( $tpl->copy_template, "[ifxf" ) !== false ) {

		$xfieldsdata = xfieldsdataload( $xfieldsdata );
		
		foreach ( $xfields as $value ) {
			$preg_safe_name = preg_quote( $value[0], "'" );
			
			$xfieldsdata[$value[0]] = isset( $xfieldsdata[$value[0]] ) ? stripslashes( $xfieldsdata[$value[0]] ) : '';
			
			if( $value[20] ) {
				  
				$value[20] = explode( ',', $value[20] );
				  
				if( $value[20][0] AND !in_array( $member_id['user_group'], $value[20] ) ) {
					$xfieldsdata[$value[0]] = "";
				}

			}
	
			if ( $value[3] == "yesorno" ) {
				
			    if( intval($xfieldsdata[$value[0]]) ) {
					$xfgiven = true;
					$xfieldsdata[$value[0]] = $lang['xfield_xyes'];
				} else {
					$xfgiven = false;
					$xfieldsdata[$value[0]] = $lang['xfield_xno'];
				}
				
			} else {
				
				if($xfieldsdata[$value[0]] == "") $xfgiven = false; else $xfgiven = true;
				
			}
			
			if( !$xfgiven ) {
				$tpl->copy_template = preg_replace( "'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is", "", $tpl->copy_template );
				$tpl->copy_template = str_replace( "[xfnotgiven_{$value[0]}]", "", $tpl->copy_template );
				$tpl->copy_template = str_replace( "[/xfnotgiven_{$value[0]}]", "", $tpl->copy_template );
			} else {
				$tpl->copy_template = preg_replace( "'\\[xfnotgiven_{$preg_safe_name}\\](.*?)\\[/xfnotgiven_{$preg_safe_name}\\]'is", "", $tpl->copy_template );
				$tpl->copy_template = str_replace( "[xfgiven_{$value[0]}]", "", $tpl->copy_template );
				$tpl->copy_template = str_replace( "[/xfgiven_{$value[0]}]", "", $tpl->copy_template );
			}
			
			if(strpos( $tpl->copy_template, "[ifxfvalue {$value[0]}" ) !== false ) {
				$tpl->copy_template = preg_replace_callback ( "#\\[ifxfvalue(.+?)\\](.+?)\\[/ifxfvalue\\]#is", "check_xfvalue", $tpl->copy_template );
			}
				
			if ( $value[6] AND !empty( $xfieldsdata[$value[0]] ) ) {
				$temp_array = explode( ",", $xfieldsdata[$value[0]] );
				$value3 = array();

				foreach ($temp_array as $value2) {

					$value2 = trim($value2);
					
					if($value2) {
						$value2 = str_replace(array("&#039;", "&quot;", "&amp;"), array("'", '"', "&"), $value2);
	
						if( $config['allow_alt_url'] ) $value3[] = "<a href=\"" . $config['http_home_url'] . "xfsearch/" .$value[0]."/". rawurlencode( dle_strtolower($value2) ) . "/\">" . $value2 . "</a>";
						else $value3[] = "<a href=\"$PHP_SELF?do=xfsearch&amp;xfname=".$value[0]."&amp;xf=" . rawurlencode( dle_strtolower($value2) ) . "\">" . $value2 . "</a>";
					}
				}
				
				if( empty($value[21]) ) $value[21] = ", ";
				
				$xfieldsdata[$value[0]] = implode($value[21], $value3);

				unset($temp_array);
				unset($value2);
				unset($value3);

			}
			
			if ($config['allow_links'] AND $value[3] == "textarea" AND function_exists('replace_links') AND isset($replace_links['news']) ) $xfieldsdata[$value[0]] = replace_links ( $xfieldsdata[$value[0]], $replace_links['news'] );

			if($value[3] == "image" AND isset($xfieldsdata[$value[0]]) AND $xfieldsdata[$value[0]] ) {
				
				$temp_array = explode('|', $xfieldsdata[$value[0]]);
					
				if (count($temp_array) == 1 OR count($temp_array) == 5 ){
						
					$temp_alt = '';
					$temp_value = implode('|', $temp_array );
						
				} else {
						
					$temp_alt = $temp_array[0];
					$temp_alt = str_replace( "&amp;#44;", "&#44;", $temp_alt );
					$temp_alt = str_replace( "&amp;#124;", "&#124;", $temp_alt );
					
					unset($temp_array[0]);
					$temp_value =  implode('|', $temp_array );
						
				}

				$path_parts = get_uploaded_image_info($temp_value);
				
				if( $value[12] AND $path_parts->thumb ) {
					
					$tpl->set( "[xfvalue_thumb_url_{$value[0]}]", $path_parts->thumb);
					$xfieldsdata[$value[0]] = "<a href=\"{$path_parts->url}\" class=\"highslide\" target=\"_blank\"><img class=\"xfieldimage {$value[0]}\" src=\"{$path_parts->thumb}\" alt=\"{$temp_alt}\"></a>";

				} else {
					
					$tpl->set( "[xfvalue_thumb_url_{$value[0]}]", $path_parts->url);
					$xfieldsdata[$value[0]] = "<img class=\"xfieldimage {$value[0]}\" src=\"{$path_parts->url}\" alt=\"{$temp_alt}\">";

				}
				
				$tpl->set( "[xfvalue_image_url_{$value[0]}]", $path_parts->url);
				$tpl->set( "[xfvalue_image_description_{$value[0]}]", $temp_alt);

			}
			
			$xfieldsdata[$value[0]] = isset($xfieldsdata[$value[0]]) ? $xfieldsdata[$value[0]] : '';
			
			if($value[3] == "image" AND !$xfieldsdata[$value[0]]) {
				$tpl->set( "[xfvalue_thumb_url_{$value[0]}]", "");
				$tpl->set( "[xfvalue_image_url_{$value[0]}]", "");
				$tpl->set( "[xfvalue_image_description_{$value[0]}]", "");
			}
			
			if($value[3] == "imagegalery" AND $xfieldsdata[$value[0]] AND stripos ( $tpl->copy_template, "[xfvalue_{$value[0]}" ) !== false) {
				
				$fieldvalue_arr = explode(',', $xfieldsdata[$value[0]]);
				$gallery_image = array();
				$gallery_single_image = array();
				$xf_image_count = 0;
				
				foreach ($fieldvalue_arr as $temp_value) {
					
					$xf_image_count ++;
					
					$temp_value = trim($temp_value);
			
					if($temp_value == "") continue;
					
					$temp_array = explode('|', $temp_value);
					
					if (count($temp_array) == 1 OR count($temp_array) == 5 ){
							
						$temp_alt = '';
						$temp_value = implode('|', $temp_array );
							
					} else {
							
						$temp_alt = $temp_array[0];
						$temp_alt = str_replace( "&amp;#44;", "&#44;", $temp_alt );
						$temp_alt = str_replace( "&amp;#124;", "&#124;", $temp_alt );
						
						unset($temp_array[0]);
						$temp_value =  implode('|', $temp_array );
							
					}

					$path_parts = get_uploaded_image_info($temp_value);
				
					if($value[12] AND $path_parts->thumb) {
						
						$gallery_image[] = "<li><a href=\"{$path_parts->url}\" onclick=\"return hs.expand(this, { slideshowGroup: 'xf_{$row['id']}_{$value[0]}' })\" target=\"_blank\"><img src=\"{$path_parts->thumb}\" alt=\"{$temp_alt}\"></a></li>";
						$gallery_single_image['[xfvalue_'.$value[0].' image="'.$xf_image_count.'"]'] = "<a href=\"{$path_parts->url}\" class=\"highslide\" target=\"_blank\"><img class=\"xfieldimage {$value[0]}\" src=\"{$path_parts->thumb}\" alt=\"{$temp_alt}\"></a>";
						
					} else {
						$gallery_image[] = "<li><img src=\"{$path_parts->url}\" alt=\"{$temp_alt}\"></li>";
						$gallery_single_image['[xfvalue_'.$value[0].' image="'.$xf_image_count.'"]'] = "<img class=\"xfieldimage {$value[0]}\" src=\"{$path_parts->url}\" alt=\"{$temp_alt}\">";
					}
				
				}
				
				if( !$path_parts->thumb ) $path_parts->thumb = $path_parts->url;
				
				$gallery_single_image['[xfvalue_'.$value[0].' image-description="'.$xf_image_count.'"]'] = $temp_alt;
				$gallery_single_image['[xfvalue_'.$value[0].' image-thumb-url="'.$xf_image_count.'"]'] = $path_parts->thumb;
				$gallery_single_image['[xfvalue_'.$value[0].' image-url="'.$xf_image_count.'"]'] = $path_parts->url;
				
				$tpl->copy_template = str_ireplace( '[xfgiven_'.$value[0].' image="'.$xf_image_count.'"]', "", $tpl->copy_template );
				$tpl->copy_template = str_ireplace( '[/xfgiven_'.$value[0].' image="'.$xf_image_count.'"]', "", $tpl->copy_template );
				$tpl->copy_template = preg_replace( "'\\[xfnotgiven_{$preg_safe_name} image=\"{$xf_image_count}\"\\](.*?)\\[/xfnotgiven_{$preg_safe_name} image=\"{$xf_image_count}\"\\]'is", "", $tpl->copy_template );
		
				if(count($gallery_single_image) ) {
					foreach($gallery_single_image as $temp_key => $temp_value) $tpl->set( $temp_key, $temp_value);
				}
				
				$xfieldsdata[$value[0]] = "<ul class=\"xfieldimagegallery {$value[0]}\">".implode($gallery_image)."</ul>";
				
			}
			
			$tpl->copy_template = preg_replace( "'\\[xfgiven_{$preg_safe_name} image=\"(\d+)\"\\](.*?)\\[/xfgiven_{$preg_safe_name} image=\"(\d+)\"\\]'is", "", $tpl->copy_template );
			$tpl->copy_template = preg_replace( "'\\[xfnotgiven_{$preg_safe_name} image=\"(\d+)\"\\]'i", "", $tpl->copy_template );
			$tpl->copy_template = preg_replace( "'\\[/xfnotgiven_{$preg_safe_name} image=\"(\d+)\"\\]'i", "", $tpl->copy_template );
			
			if ($config['image_lazy']) $xfieldsdata[$value[0]] = preg_replace_callback ( "#<(img|iframe)(.+?)>#i", "enable_lazyload", $xfieldsdata[$value[0]] );
			
			$tpl->set( "[xfvalue_{$value[0]}]", $xfieldsdata[$value[0]]);

			if ( preg_match( "#\\[xfvalue_{$preg_safe_name} limit=['\"](.+?)['\"]\\]#i", $tpl->copy_template, $matches ) ) {
				$tpl->set( $matches[0], clear_content($xfieldsdata[$value[0]], $matches[1]) );
			}
			
			if (stripos ( $tpl->copy_template, "[hide" ) !== false ) {
				
				$tpl->copy_template = preg_replace_callback ( "#\[hide(.*?)\](.+?)\[/hide\]#is", 
					function ($matches) use ($member_id, $user_group, $lang) {
						
						$matches[1] = str_replace(array("=", " "), "", $matches[1]);
						$matches[2] = $matches[2];
		
						if( $matches[1] ) {
							
							$groups = explode( ',', $matches[1] );
		
							if( in_array( $member_id['user_group'], $groups ) OR $member_id['user_group'] == "1") {
								return $matches[2];
							} else return "<div class=\"quote dlehidden\">" . $lang['news_regus'] . "</div>";
							
						} else {
							
							if( $user_group[$member_id['user_group']]['allow_hide'] ) return $matches[2]; else return "<div class=\"quote dlehidden\">" . $lang['news_regus'] . "</div>";
							
						}
		
				}, $tpl->copy_template );
			}


			if( $config['files_allow'] ) if( strpos( $tpl->copy_template, "[attachment=" ) !== false ) {
				$tpl->copy_template = show_attach( $tpl->copy_template, NEWS_ID );
			}
	
		}
	}
		
} else {
	
	if( strpos( $tpl->copy_template, "related-news" ) !== false ) {
		$tpl->set( '{related-news}', "" );
		$tpl->set_block( "'\\[related-news\\](.*?)\\[/related-news\\]'si", "" );
	}
	
	if( strpos( $tpl->copy_template, "[xf" ) !== false ) {
		$tpl->copy_template = preg_replace( "'\\[xfnotgiven_(.*?)\\](.*?)\\[/xfnotgiven_(.*?)\\]'is", "", $tpl->copy_template );
		$tpl->copy_template = preg_replace( "'\\[xfgiven_(.*?)\\](.*?)\\[/xfgiven_(.*?)\\]'is", "", $tpl->copy_template );
		$tpl->copy_template = preg_replace( "'\\[xfvalue_(.*?)\\]'i", "", $tpl->copy_template );
	}
	
	if( strpos( $tpl->copy_template, "[ifxfvalue" ) !== false ) {
		$tpl->copy_template = preg_replace( "#\\[ifxfvalue(.+?)\\](.+?)\\[/ifxfvalue\\]#is", "", $tpl->copy_template );
	}

}

if ($config['allow_skin_change']) $tpl->set ( '{changeskin}', ChangeSkin ( $config['skin'] ) );

if (count ( $banners ) and $config['allow_banner']) {

	foreach ( $banners as $name => $value ) {
		$tpl->copy_template = str_replace ( "{banner_" . $name . "}", $value, $tpl->copy_template );
		if ( $value ) {
			$tpl->copy_template = str_replace ( "[banner_" . $name . "]", "", $tpl->copy_template );
			$tpl->copy_template = str_replace ( "[/banner_" . $name . "]", "", $tpl->copy_template );
		}
	}

}

$tpl->set_block ( "'{banner_(.*?)}'si", "" );
$tpl->set_block ( "'\\[banner_(.*?)\\](.*?)\\[/banner_(.*?)\\]'si", "" );

if ($config['rss_informer'] AND count ($informers) ) {
	foreach ( $informers as $name => $value ) {
		$tpl->copy_template = str_replace ( "{inform_" . $name . "}", $value, $tpl->copy_template );
	}
}

if (stripos ( $tpl->copy_template, "[category=" ) !== false) {
	$tpl->copy_template = preg_replace_callback ( "#\\[(category)=(.+?)\\](.*?)\\[/category\\]#is", "check_category", $tpl->copy_template );
}

if (stripos ( $tpl->copy_template, "[not-category=" ) !== false) {
	$tpl->copy_template = preg_replace_callback ( "#\\[(not-category)=(.+?)\\](.*?)\\[/not-category\\]#is", "check_category", $tpl->copy_template );
}

if (stripos ( $tpl->copy_template, "[static=" ) !== false) {
	$tpl->copy_template = preg_replace_callback ( "#\\[(static)=(.+?)\\](.*?)\\[/static\\]#is", "check_static", $tpl->copy_template );
}

if (stripos ( $tpl->copy_template, "[not-static=" ) !== false) {
	$tpl->copy_template = preg_replace_callback ( "#\\[(not-static)=(.+?)\\](.*?)\\[/not-static\\]#is", "check_static", $tpl->copy_template );
}

if (stripos ( $tpl->copy_template, "{customcomments" ) !== false) {
	$tpl->copy_template = preg_replace_callback ( "#\\{customcomments(.+?)\\}#i", "custom_comments", $tpl->copy_template );
}

if (stripos ( $tpl->copy_template, "{custom" ) !== false) {
	$tpl->copy_template = preg_replace_callback ( "#\\{custom(.+?)\\}#i", "custom_print", $tpl->copy_template );
}

if ( ($allow_active_news AND $news_found AND $config['allow_change_sort'] AND $dle_module != "userinfo") OR defined('CUSTOMSORT')) {

	$tpl->set ( '[sort]', "" );
	$tpl->set ( '{sort}', news_sort ( $do ) );
	$tpl->set ( '[/sort]', "" );

} else {

	$tpl->set_block ( "'\\[sort\\](.*?)\\[/sort\\]'si", "" );

}

$tpl->copy_template = str_replace ( "{topnews}", $tpl->result['topnews'], $tpl->copy_template );

if( $vk_url ) {
	$tpl->set( '[vk]', "" );
	$tpl->set( '[/vk]', "" );
	$tpl->set( '{vk_url}', $vk_url );	
} else {
	$tpl->set_block( "'\\[vk\\](.*?)\\[/vk\\]'si", "" );
	$tpl->set( '{vk_url}', '' );	
}
if( $odnoklassniki_url ) {
	$tpl->set( '[odnoklassniki]', "" );
	$tpl->set( '[/odnoklassniki]', "" );
	$tpl->set( '{odnoklassniki_url}', $odnoklassniki_url );
} else {
	$tpl->set_block( "'\\[odnoklassniki\\](.*?)\\[/odnoklassniki\\]'si", "" );
	$tpl->set( '{odnoklassniki_url}', '' );	
}
if( $facebook_url ) {
	$tpl->set( '[facebook]', "" );
	$tpl->set( '[/facebook]', "" );
	$tpl->set( '{facebook_url}', $facebook_url );	
} else {
	$tpl->set_block( "'\\[facebook\\](.*?)\\[/facebook\\]'si", "" );
	$tpl->set( '{facebook_url}', '' );	
}
if( $google_url ) {
	$tpl->set( '[google]', "" );
	$tpl->set( '[/google]', "" );
	$tpl->set( '{google_url}', $google_url );
} else {
	$tpl->set_block( "'\\[google\\](.*?)\\[/google\\]'si", "" );
	$tpl->set( '{google_url}', '' );	
}
if( $mailru_url ) {
	$tpl->set( '[mailru]', "" );
	$tpl->set( '[/mailru]', "" );
	$tpl->set( '{mailru_url}', $mailru_url );	
} else {
	$tpl->set_block( "'\\[mailru\\](.*?)\\[/mailru\\]'si", "" );
	$tpl->set( '{mailru_url}', '' );	
}
if( $yandex_url ) {
	$tpl->set( '[yandex]', "" );
	$tpl->set( '[/yandex]', "" );
	$tpl->set( '{yandex_url}', $yandex_url );
} else {
	$tpl->set_block( "'\\[yandex\\](.*?)\\[/yandex\\]'si", "" );
	$tpl->set( '{yandex_url}', '' );
}

$config['http_home_url'] = explode ( "index.php", strtolower ( $_SERVER['PHP_SELF'] ) );
$config['http_home_url'] = reset ( $config['http_home_url'] );

if ( !$user_group[$member_id['user_group']]['allow_admin'] ) $config['admin_path'] = "";

$ajax .= <<<HTML
{$pm_alert}{$twofactor_alert}

HTML;


if (strpos ( $tpl->result['content'], "<pre" ) !== false OR strpos ( $tpl->copy_template, "<pre" ) !== false) {

	$js_array[] = "engine/classes/highlight/highlight.code.js";

}

if ( (strpos ( $tpl->result['content'], "hs.expand" ) !== false OR strpos ( $tpl->copy_template, "hs.expand" ) !== false OR strpos ( $tpl->result['content'], "highslide" ) !== false OR strpos ( $tpl->copy_template, "highslide" ) !== false) AND $dle_module != "addnews") {

	$js_array[] = "engine/classes/highslide/highslide.js";

	if ($config['thumb_dimming']) $dimming = "hs.dimmingOpacity = 0.60;"; else $dimming = "";

	if ($config['thumb_gallery'] AND ($dle_module == "showfull" OR $dle_module == "static") ) {

	  $gallery = "hs.slideshowGroup='fullnews'; hs.addSlideshow({slideshowGroup: 'fullnews', interval: 4000, repeat: false, useControls: true, fixedControls: 'fit', overlayOptions: { opacity: .75, position: 'bottom center', hideOnMouseOut: true } });";

	} else $gallery = "";

	switch ( $config['outlinetype'] ) {

		case 1 :
			$type = "hs.wrapperClassName = 'wide-border';";
			break;

		case 2 :
			$type = "hs.wrapperClassName = 'borderless';";
			break;

		case 3 :
			$type = "hs.wrapperClassName = 'less';\nhs.outlineType = null;";
			break;

		default :
			$type = "hs.wrapperClassName = 'rounded-white';\nhs.outlineType = 'rounded-white';";
			break;


	}

	$onload_scripts[] = <<<HTML

hs.graphicsDir = '{$config['http_home_url']}engine/classes/highslide/graphics/';
{$type}
hs.numberOfImagesToPreload = 0;
hs.captionEval = 'this.thumb.alt';
hs.showCredits = false;
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
{$dimming}
hs.lang = { loadingText : '{$lang['loading']}', playTitle : '{$lang['thumb_playtitle']}', pauseTitle:'{$lang['thumb_pausetitle']}', previousTitle : '{$lang['thumb_previoustitle']}', nextTitle :'{$lang['thumb_nexttitle']}',moveTitle :'{$lang['thumb_movetitle']}', closeTitle :'{$lang['thumb_closetitle']}',fullExpandTitle:'{$lang['thumb_expandtitle']}',restoreTitle:'{$lang['thumb_restore']}',focusTitle:'{$lang['thumb_focustitle']}',loadingTitle:'{$lang['thumb_cancel']}'
};
{$gallery}

HTML;

	$tpl->result['content'] = preg_replace_callback ( "#slideshowGroup\: '(.+?)'#",
		function ($matches) {
			global $onload_scripts;
			$matches[1] = totranslit(trim($matches[1]));
			$onload_scripts[$matches[1]] = "hs.addSlideshow({slideshowGroup: '{$matches[1]}', interval: 4000, repeat: false, useControls: true, fixedControls: 'fit', overlayOptions: { opacity: .75, position: 'bottom center', hideOnMouseOut: true } });";

			return $matches[0];
		},		
	$tpl->result['content'] );

	$tpl->copy_template = preg_replace_callback ( "#slideshowGroup\: '(.+?)'#",
		function ($matches) {
			global $onload_scripts;
			$matches[1] = totranslit(trim($matches[1]));
			$onload_scripts[$matches[1]] = "hs.addSlideshow({slideshowGroup: '{$matches[1]}', interval: 4000, repeat: false, useControls: true, fixedControls: 'fit', overlayOptions: { opacity: .75, position: 'bottom center', hideOnMouseOut: true } });";

			return $matches[0];
		},		
	$tpl->copy_template );
}

if ($config['image_lazy']) {
	$js_array[] = "engine/classes/js/lazyload.js";
}

if ( strpos ( $tpl->result['content'], "share-content" ) !== false OR strpos ( $tpl->copy_template, "share-content" ) !== false ) {
	
	$js_array[] = "engine/classes/masha/masha.js";
	
}

if (strpos ( $tpl->result['content'], "dleplyrplayer" ) !== false OR strpos ( $tpl->copy_template, "dleplyrplayer" ) !== false) {
  if ( strpos ( $tpl->result['content'], ".m3u8" ) !== false OR strpos ( $tpl->copy_template, ".m3u8" ) !== false ) {
	 $js_array[] = "engine/classes/html5player/hls.js";
  }
  $css_array[] = "engine/classes/html5player/plyr.css";
  $js_array[] = "engine/classes/html5player/plyr.js";
  
} elseif (strpos ( $tpl->result['content'], "dleaudioplayer" ) !== false OR strpos ( $tpl->result['content'], "dlevideoplayer" ) !== false OR strpos ( $tpl->copy_template, "dlevideoplayer" ) !== false OR strpos ( $tpl->copy_template, "dleaudioplayer" ) !== false) {
	
  $css_array[] = "engine/classes/html5player/player.css";
  $js_array[] = "engine/classes/html5player/player.js";
  
}

if( $user_group[$member_id['user_group']]['allow_pm'] ) {
	$allow_comments_ajax = true;
}

if ($allow_comments_ajax AND ($config['allow_quick_wysiwyg'] == "2" OR $config['allow_comments_wysiwyg'] == "2") AND $dle_module != "addnews") {

    $js_array[] = "engine/editor/jscripts/tiny_mce/tinymce.min.js";

}

if ($allow_comments_ajax AND ($config['allow_quick_wysiwyg'] == "1" OR $config['allow_comments_wysiwyg'] == "1") AND $dle_module != "addnews" ) {
	
	$js_array[] = "engine/skins/codemirror/js/code.js";
	$js_array[] = "engine/editor/jscripts/froala/editor.js";
	$js_array[] = "engine/editor/jscripts/froala/languages/{$lang['wysiwyg_language']}.js";
	$css_array[] = "engine/editor/jscripts/froala/fonts/font-awesome.css";
	$css_array[] = "engine/editor/jscripts/froala/css/editor.css";

}

if ($config['allow_admin_wysiwyg'] == "1" OR $config['allow_site_wysiwyg'] == "1" OR $config['allow_static_wysiwyg'] == "1" OR $config['allow_quick_wysiwyg'] == "1" ) {
	$css_array[] = "engine/editor/css/default.css";

}

$js_array = build_css($css_array, $config)."\n".build_js($js_array, $config);

$schema = DLESEO::CompileSchema();

if($schema) {
	$js_array .= "\n<script type=\"application/ld+json\">".DLESEO::CompileSchema()."</script>";	
}

$show_error_info = false;

if( $_SERVER['QUERY_STRING'] AND !$tpl->result['content'] AND !$tpl->result['info'] AND stripos ( $tpl->copy_template, "{content}" ) !== false ) {
	$show_error_info = true;
}

if($dle_module == "main" AND $config['start_site'] == 2 ) {
	$show_error_info = false;
}

if( $show_error_info ) {

	@header( "HTTP/1.0 404 Not Found" );
	$need_404 = false;
	
	if( $config['own_404'] AND file_exists(ROOT_DIR . '/404.html') ) {
		@header("Content-type: text/html; charset=".$config['charset']);
		echo file_get_contents( ROOT_DIR . '/404.html' );
		die();
		
	} else msgbox( $lang['all_err_1'], $lang['news_err_27'] );

}

if($need_404) {
	@header( "HTTP/1.0 404 Not Found" );
}

if ( count($onload_scripts) ) {
	
	$onload_scripts =implode("\n", $onload_scripts);

	$ajax .= <<<HTML

jQuery(function($){
{$onload_scripts}
});
HTML;

} else $onload_scripts="";

$ajax .= <<<HTML

HTML;

if( ($tpl->result['content'] AND isset($tpl->result['navigation']) AND $tpl->result['navigation']) OR defined('CUSTOMNAVIGATION') ) {

	$tpl->set( '[navigation]', "" );
	$tpl->set( '[/navigation]', "" );
	$tpl->set_block( "'\\[not-navigation\\](.*?)\\[/not-navigation\\]'si", "" );
		
	if( stripos ( $tpl->copy_template, "{navigation}" ) !== false )	{

		$tpl->result['content'] = str_replace ( '{newsnavigation}', '', $tpl->result['content'] );
		$tpl->copy_template = str_replace ( '{newsnavigation}', '', $tpl->copy_template );
			
		if( $tpl->result['navigation'] AND stripos ( $tpl->copy_template, "{content}" ) !== false ) {
			
			$tpl->set( '{navigation}', $tpl->result['navigation'] );
			
		} else {
			
			$tpl->set( '{navigation}', $custom_navigation );
			
		}

	} else {
		
		$tpl->result['content'] = str_replace ( '{newsnavigation}', $tpl->result['navigation'], $tpl->result['content'] );
		$tpl->copy_template = str_replace ( '{newsnavigation}', $custom_navigation, $tpl->copy_template );

	}

} else {
	
	$tpl->set( '{navigation}', "" );
	$tpl->set( '[not-navigation]', "" );
	$tpl->set( '[/not-navigation]', "" );
	$tpl->set_block( "'\\[navigation\\](.*?)\\[/navigation\\]'si", "" );
	
}


if (stripos ( $tpl->copy_template, "{jsfiles}" ) !== false) {
	$tpl->set ( '{headers}', $metatags );
	$tpl->set ( '{jsfiles}', $js_array );
} else {
	$tpl->set ( '{headers}', $metatags."\n".$js_array );
}

$tpl->set ( '{AJAX}', $ajax );
$tpl->set ( '{info}',  $tpl->result['info'] );

$tpl->set ( '{content}', $tpl->result['content'] );

$tpl->compile ( 'main' );

if( $is_logged AND stripos ( $tpl->result['main'], "-favorites-" ) !== false) {
	
	$fav_arr = explode(',', $member_id['favorites'] );
	
	foreach( $fav_arr as $fav_id ) {
		$tpl->result['main'] = str_replace ( "{-favorites-{$fav_id}}", "<a id=\"fav-id-{$fav_id}\" class=\"favorite-link del-favorite\" href=\"{$PHP_SELF}?do=favorites&amp;doaction=del&amp;id={$fav_id}\"><img src=\"{$config['http_home_url']}templates/{$config['skin']}/dleimages/minus_fav.gif\" onclick=\"doFavorites('{$fav_id}', 'minus', 0); return false;\" title=\"{$lang['news_minfav']}\" alt=\"\"></a>", $tpl->result['main'] );
		$tpl->result['main'] = str_replace ( "[del-favorites-{$fav_id}]", "<a id=\"fav-id-{$fav_id}\" onclick=\"doFavorites('{$fav_id}', 'minus', 1); return false;\" href=\"{$PHP_SELF}?do=favorites&amp;doaction=del&amp;id={$fav_id}\">", $tpl->result['main'] );
		$tpl->result['main'] = str_replace ( "[/del-favorites-{$fav_id}]", "</a>", $tpl->result['main'] );
		$tpl->result['main'] = preg_replace( "'\\[add-favorites-{$fav_id}\\](.*?)\\[/add-favorites-{$fav_id}\\]'is", "", $tpl->result['main'] );
	}
	
	$tpl->result['main'] = preg_replace( "'\\{-favorites-(\d+)\\}'i", "<a id=\"fav-id-\\1\" class=\"favorite-link add-favorite\" href=\"{$PHP_SELF}?do=favorites&amp;doaction=add&amp;id=\\1\"><img src=\"{$config['http_home_url']}templates/{$config['skin']}/dleimages/plus_fav.gif\" onclick=\"doFavorites('\\1', 'plus', 0); return false;\" title=\"{$lang['news_addfav']}\" alt=\"\"></a>", $tpl->result['main'] );
	$tpl->result['main'] = preg_replace( "'\\[add-favorites-(\d+)\\]'i", "<a id=\"fav-id-\\1\" onclick=\"doFavorites('\\1', 'plus', 1); return false;\" href=\"{$PHP_SELF}?do=favorites&amp;doaction=add&amp;id=\\1\">", $tpl->result['main'] );
	$tpl->result['main'] = preg_replace( "'\\[/add-favorites-(\d+)\\]'i", "</a>", $tpl->result['main'] );
	$tpl->result['main'] = preg_replace( "'\\[del-favorites-(\d+)\\](.*?)\\[/del-favorites-(\d+)\\]'si", "", $tpl->result['main'] );

}

if ($config['allow_links'] and isset($replace_links['all']) ) $tpl->result['main'] = replace_links ( $tpl->result['main'], $replace_links['all'] );

$tpl->result['main'] = str_ireplace( '{THEME}', $config['http_home_url'] . 'templates/' . $config['skin'], $tpl->result['main'] );

if ($replace_url) $tpl->result['main'] = str_replace ( $replace_url[0]."/", $replace_url[1]."/", $tpl->result['main'] );

if($remove_canonical) {
	$tpl->result['main'] = preg_replace( "#<link rel=['\"]canonical['\"](.+?)>#i", "", $tpl->result['main'] );
}

$tpl->result['main'] = str_replace ( 'src="http://'.$_SERVER['HTTP_HOST'].'/', 'src="/', $tpl->result['main'] );
$tpl->result['main'] = str_replace ( 'srcset="http://'.$_SERVER['HTTP_HOST'].'/', 'srcset="/', $tpl->result['main'] );
$tpl->result['main'] = str_replace ( 'src="https://'.$_SERVER['HTTP_HOST'].'/', 'src="/', $tpl->result['main'] );
$tpl->result['main'] = str_replace ( 'srcset="https://'.$_SERVER['HTTP_HOST'].'/', 'srcset="/', $tpl->result['main'] );

echo $tpl->result['main'];

$tpl->global_clear();

$db->close();

GzipOut();

?>