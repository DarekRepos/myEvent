<?php


namespace MyEvent\Core;


class MyEventPostTypeHooks {

	public function addSaveMetaHook( $post_id, $post ) {
		if ( ! isset( $_POST['eventmeta_field'] ) ) {
			return $post->ID;
		}

		if ( wp_verify_nonce( $_POST['eventmeta_field'], plugin_basename( __FILE__ ) ) ) {
			return $post->ID;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return $post->ID;
		}

		if ( wp_is_post_autosave( $post_id ) ) {
			return $post->ID;
		}
		if ( wp_is_post_revision( $post_id ) ) {
			return $post->ID;
		}

		$events_meta['_location'] = $_POST['_location'];
		$events_meta['_date']     = $_POST['_date'];
		$events_meta['_time']     = $_POST['_time'];

		foreach ( $events_meta as $key => $value ) {

			if ( get_post_meta( $post->ID, $key, false ) ) {
				update_post_meta( $post->ID, $key, $value );


			} else {
				add_post_meta( $post->ID, $key, $value );
			}

			if ( ! $value ) {
				delete_post_meta( $post->ID, $key );
			}
		}
	}

	public function init() {
		add_action( 'save_post', [ $this, 'addSaveMetaHook' ], 1, 2 );
	}
}

