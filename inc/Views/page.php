<div class="wrap" id="myplugin-admin">
    <div id="icon-tools" class="icon32"><br></div>
    <h2><?php echo esc_html( $this->getPageTitle() ); ?></h2>
	<?php settings_errors(); ?>
	<?php	$this->options = get_option( 'myevent_option');	?>
    <form action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>" method="POST">
		<?php settings_fields( $this->getSlug() . '-group' ); ?>
		<?php do_settings_sections( $this->getSlug() ); ?>
		<?php submit_button( __( 'Save' ) ); ?>
    </form>
</div>
