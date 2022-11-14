<?php
add_action( 'init', 'register_slider_post_meta' );

function register_slider_post_meta() {

    register_post_meta( 'slider', 'repeater_slider_content', [
        'type' => 'object',
        'single' => false,
        'show_in_rest' => false
    ] );    

}