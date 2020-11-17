<?php
/**
 * @package JET Footnotes
 * @version 1.0.0
 */
/*
Plugin Name: JET Footnotes
Plugin URI: 
Description: Easy footnote markup in posts
Author: Jonathan Tweedy
Version: 1.0.0
Author URI: https://jonathantweedy.com
*/

add_filter( 'the_title', 'do_shortcode' );

$GLOBALS['jet_footnote_count'] = 0;
$GLOBALS['jet_footnotes'] = [];

function jet_footnote( $atts, $templatecontent ){
    $GLOBALS['jet_footnote_count']++;
    $x = new stdClass();
    $x->num = $GLOBALS['jet_footnote_count'];
    $x->slug = sanitize_title($atts['slug']);
    $x->text = html_entity_decode($templatecontent);
    $GLOBALS['jet_footnotes'][] = $x;
    return "<sup class='jet-footnote'><a class='jet-footnote' href='#jet-footnote-".$x->slug."'>".$GLOBALS['jet_footnote_count']."</a></sup>";
}
add_shortcode( 'jet-footnote', 'jet_footnote' );

function jet_footnotes( $atts, $templatecontent ){
    $html = "<div class='jet-footnotes'>";
    foreach($GLOBALS['jet_footnotes'] as $jetfn) {
        $html .= "<a id='jet-footnote-".$jetfn->slug."'></a><p><sup>".$jetfn->num."</sup>" . $jetfn->text . "</p>";
    }
    $html .= "</div>";
    return $html;
}
add_shortcode( 'jet-footnotes', 'jet_footnotes' );
