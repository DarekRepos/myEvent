<?php


printf(
	'<input type="color"
        id="myevents_admin_page-text-color-option"
        name="myevent_option[myevents_admin_page-text-color-option]"
        value="%s"/>',
	isset($this->options['myevents_admin_page-text-color-option']) ?
        esc_attr($this->options['myevents_admin_page-text-color-option']) : '#23282d'
);