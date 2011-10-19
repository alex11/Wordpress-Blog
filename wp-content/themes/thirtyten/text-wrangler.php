<?php

class Thirty_Ten_Text_Wrangler {
  function site_generator($translation, $text, $domain) {
  $translations = &get_translations_for_domain( $domain );
  if ( $text == 'Proudly powered by %s.' ) {
   return $translations->translate( 'Proudly powered by %s</a>, <span id="jorbin-link"><a href="http://aaron.jorb.in">Aaron Jorbin\'s Idea</a></span>, and <apan id="hockley-link"><a href="http://www.flickr.com/photos/ahockley">Aaron Hockley / Hockley Photography</apan>' );
  }
  return $translation;
 }
 function single_meta($translation, $text, $domain) {
  $translations = &get_translations_for_domain( $domain );
  // With Tags
  if ( $text == 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.' ) {
   return $translations->translate( 'This entry was posted in %1$s and tagged %2$s. It can always be found at <a href="%3$s" title="Permalink to %4$s" rel="bookmark">it\'s permalink</a>. Follow any comments left here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.' );
  }
  //Without
  elseif( $text == 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.' ) {
   return $translations->translate( 'This entry was posted in %1$s. It can always be found at <a href="%3$s" title="Permalink to %4$s" rel="bookmark">it\'s permalink</a>. Follow any comments left here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.' );
  }

  return $translation;
 }

}



?>
