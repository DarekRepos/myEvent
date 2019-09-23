<?php


printf(
'<input type="number"
        id="myevents_admin_page-amount"
        name="myevent_option[myevents_admin_page-amount]"
        value="%s"/>',
isset($this->options['myevents_admin_page-amount']) ?
	esc_attr($this->options['myevents_admin_page-amount']) : ''
);
