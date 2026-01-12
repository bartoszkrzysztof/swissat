<?php

include_once 'ContactForm/ContactForm.php';
add_filter('cf_field_source_type', function($source) {
    return 'acf';
});
