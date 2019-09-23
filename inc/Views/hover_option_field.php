<div class="container">
    <ul>
        <li>
            <label for="none">
				<?php _e( 'none' ); ?>
                <input type="radio"
                       id="myevents_admin_page-hover-option"
                       value="none"
                       name="myevent_option[myevents_admin_page-hover-option]"
					<?php checked( 'none', esc_attr( $this->options['myevents_admin_page-hover-option'] ) ); ?>
                >
            </label>
            <div class="check"></div>
        </li>
        <li>
            <label for="border">
				<?php _e( 'frame' ); ?>
                <input type="radio"
                       id="myevents_admin_page-hover-option"
                       value="border"
                       name="myevent_option[myevents_admin_page-hover-option]"
					<?php checked( 'border', esc_attr( $this->options['myevents_admin_page-hover-option'] ) ); ?>
                >
            </label>
            <div class="check"></div>
        </li>
    </ul>
</div>