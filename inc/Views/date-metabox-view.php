<?php


if ( empty( $post ) && isset( $GLOBALS['post'] ) ) {
	$post = $GLOBALS['post'];
}

$value = get_post_meta( $post->ID, '_date', true );
echo '<input type="date" name="_date" value="' . $value . '" class="wide" />';
