<?php

if ( empty( $post ) && isset( $GLOBALS['post'] ) ) {
	$post = $GLOBALS['post'];
}

$value = get_post_meta( $post->ID, '_time', true);
//TODO: type time is not supported with firefox - need fix
echo '<input type="time" name="_time" value="' . $value . '" class="wide" />';

wp_nonce_field( plugin_basename( __FILE__ ), 'eventmeta_field' );
