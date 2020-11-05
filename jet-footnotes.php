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

$jet_footnote_count = 0;
$jet_footnotes = [];

function jet_footnote( $atts, $templatecontent ){
    global $jet_footnote_count;
    global $jet_footnotes;
    $jet_footnote_count++;
    $x = new stdClass();
    $x->num = $jet_footnote_count;
    $x->slug = sanitize_title($atts['slug']);
    $x->text = $templatecontent;
    $jet_footnotes[] = $x;
    return "<sup class='jet-footnote'><a class='jet-footnote' href='#jet-footnote-".$x->slug."'>".$jet_footnote_count."</a></sup>";
}
add_shortcode( 'jet-footnote', 'jet_footnote' );

function jet_footnotes( $atts, $templatecontent ){
    global $jet_footnote_count;
    global $jet_footnotes;
    $html = "<div class='jet-footnotes'>";
    foreach($jet_footnotes as $jetfn) {
        $html .= "<a id='jet-footnote-".$jetfn->slug."'></a><p><sup>".$jetfn->num."</sup>" . $jetfn->text . "</p>";
    }
    $html .= "</div>";
    return $html;
}
add_shortcode( 'jet-footnotes', 'jet_footnotes' );
