<?php
//If uninstall or delete not called from WordPress then exit
if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

//If your plugin need execute actions or task before being removed code it here