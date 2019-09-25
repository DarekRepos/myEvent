<?php


printf(
'<input type="number"
        id="myevents_admin_page-amount"
        name="myevent_option[myevents_admin_page-amount]"
        value="%s"
        min="1" />',
isset($this->options['myevents_admin_page-amount']) ?
	esc_attr($this->options['myevents_admin_page-amount']) : '1'
);
