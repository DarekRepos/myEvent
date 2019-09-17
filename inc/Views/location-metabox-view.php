<?php


if ( empty( $post ) && isset( $GLOBALS['post'] ) ) {
	$post = $GLOBALS['post'];
}
$value=get_post_meta($post->ID,'_location',true);

echo '<input type="text" name="_location" value="' . $value. '" class="wide"/>';