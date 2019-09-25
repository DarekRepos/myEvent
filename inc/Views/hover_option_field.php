<div class="container">
    <ul>
        <li>
            <label for="none">
				<?php _e( 'none' ); ?>
                <input type="radio"
                       id="myevents_admin_page-hover-option"
                       value="none"
                       name="myevent_option[myevents_admin_page-hover-option]"
					<?php
					if ( empty( $this->options['myevents_admin_page-hover-option'] ) ) {
						echo 'checked="checked"';
					} else {
						checked( esc_attr( $this->options['myevents_admin_page-hover-option'] ), 'none' );
					};
					?>
                />
            </label>
            <div class="check"></div>
        </li>
        <li>
            <label for="border">
				<?php _e( 'border' ); ?>
                <input type="radio"
                       id="myevents_admin_page-hover-option"
                       value="border"
                       name="myevent_option[myevents_admin_page-hover-option]"
					<?php
					if ( empty( $this->options['myevents_admin_page-hover-option'] ) ) {
						echo '';
					} else {
						checked( esc_attr( $this->options['myevents_admin_page-hover-option'] ), 'border' );
					};

					?>
                >
            </label>
            <div class="check"></div>
        </li>
    </ul>
</div>