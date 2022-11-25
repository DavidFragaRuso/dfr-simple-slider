<?php
// Add metabox (id, title, callback, screen, context, priority, callback args)
add_action( 'add_meta_boxes_slider', 'register_slider_meta_boxes' );

function register_slider_meta_boxes()  {

    add_meta_box(
        'slide-content',
        __('Slider Content', 'dfr_simple_slider'),
        'slide_content_meta_box_callback',
        'slider',
        'advanced',
        'high'
    );
}

function slide_content_meta_box_callback( $post ) {

    global $post;

    $repeater_slider_content = get_post_meta( $post->ID, 'repeater_slider_content', true );

    
    if( empty( $repeater_slider_content ) ) {

        $repeater_slider_content = array();

        $repeater_slider_content[] = array(
            //'num' => '1',
            'img' => '',
            'm-img' => '',
            'bg-color' => '#dddddd',
            'align' => 'left',
            'title' => '',
            'text' => '',
            'link' => '',
            'btn-text' => ''
        );
    }
    
    // Add a nounce field to check on save.
    wp_nonce_field( basename( __FILE__ ), 'slide-content' );

    ?>
    <div id="repeatable-fieldset-one" class="wrap">
        <?php 
        $i = 0;

        foreach( $repeater_slider_content as $field ) {
            ?>
            <div class="slide-row ui-state-default">
                <div class="slide-header">
                    <h3><?php _e( 'Slide', 'dfr_simple_slider' ) ?> <?php echo $i + 1; ?></h3>
                    <a class="button button-small remove-row" href="#1"><?php _e( 'Remove Slide', 'dfr_simple_slider' ); ?></a>
                </div>
                <div class="slide-content">
                    <!-- Slide Background and images -->
                    <div class="slide-col">
                        <label><h4><?php _e( 'Slide Background Color', 'dfr_simple_slider' ); ?></h4></label>
                        <input name="slide[<?php echo $i ?>][bg-color]" type="text" value="<?php echo esc_attr( $field['bg-color'] ); ?>" class="color-field" />
                        <h4><?php _e( 'Image upload for desktop', 'dfr_simple_slider' ); ?></h4>
                        <?php 
                        if ( $field['img'] ) :
                            $slide_img_url = wp_get_attachment_image_url( $field['img'], 'thumbnail' )
                            ?>
                            <a href="#" class="dfr-img-upload button">
                                <img src="<?php echo esc_url( $slide_img_url ) ?>" />
                            </a>
                            <a href="#" class="dfr-remove"><?php _e( 'Remove image', 'dfr_simple_slider' ) ?></a>
                            <input type="hidden" name="slide[<?php echo $i ?>][img]" value="<?php echo absint( $field['img'] ) ?>">
                            <?php
                            else :
                            ?>
                            <a href="#" class="dfr-img-upload button"><?php _e( 'Upload image', 'dfr_simple_slider' ) ?></a>
                            <a href="#" class="dfr-remove" style="display:none"><?php _e( 'Remove image', 'dfr_simple_slider' ) ?></a>
                            <input type="hidden" name="slide[<?php echo $i ?>][img]" value="">
                            <?php
                        endif;
                        ?>
                        <h4><?php _e( 'Image upload for mobile', 'dfr_simple_slider' ); ?></h4>
                        <?php 
                        if ( $field['m-img'] ) :
                            $slide_m_img_url = wp_get_attachment_image_url( $field['m-img'], 'thumbnail' );
                            ?>
                            <a href="#" class="dfr-m-img-upload button">
                                <img src="<?php echo esc_url( $slide_m_img_url ) ?>" />
                            </a>
                            <a href="#" class="dfr-m-remove"><?php _e( 'Remove image', 'dfr_simple_slider' ) ?></a>
                            <input type="hidden" name="slide[<?php echo $i ?>][m-img]" value="<?php echo absint( $field['m-img'] ) ?>">
                            <?php
                            else :
                            ?>
                            <a href="#" class="dfr-m-img-upload button"><?php _e( 'Upload image', 'dfr_simple_slider' ) ?></a>
                            <a href="#" class="dfr-m-remove" style="display:none"><?php _e( 'Remove image', 'dfr_simple_slider' ) ?></a>
                            <input type="hidden" name="slide[<?php echo $i ?>][m-img]" value="">
                            <?php
                        endif;
                        ?>
                    </div>
                    <!-- Content Align -->
                    <div class="slide-col">
                        <label><h4><?php _e( 'Content Align', 'dfr_simple_slider' ); ?></h4></label>
                        <div class="content-align">
                            <div class="radio-row">
                                <input type="radio" id="align-left" name="slide[<?php echo $i ?>][align]" value="left" <?php checked(  $field['align'], 'left' ); ?> ></input>
                                <label for="align-left">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                    <rect x="11.667" y="42.938" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="56.667" height="24.667"/>
                                    <rect x="11.542" y="12.771" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="40.25" height="24.667"/>
                                    <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="6.667" y1="77.771" x2="6.667" y2="2.479"/>
                                </svg>
                                </label>
                            </div>
                            <div class="radio-row">
                                <input type="radio" id="align-center" name="slide[<?php echo $i ?>][align]" value="center" <?php checked( $field['align'], 'center' ); ?> ></input>
                                <label for="align-center">
                                    <?php //_e( 'center', 'dfr_simple_slider' ); ?>
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                        <rect x="11.667" y="42.938" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="56.667" height="24.667"/>
                                        <rect x="19.542" y="12.771" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="40.25" height="24.667"/>
                                        <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="39.667" y1="12.771" x2="39.667" y2="2.479"/>
                                        <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="39.667" y1="77.521" x2="39.667" y2="67.229"/>
                                        <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="40" y1="37.438" x2="40" y2="42.938"/>
                                    </svg>
                                </label>
                            </div>
                            <div class="radio-row">
                                <input type="radio" id="align-right" name="slide[<?php echo $i ?>][align]" value="right" <?php checked( $field['align'], 'right' ); ?> ></input>
                                <label for="align-right">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                    <rect x="11.667" y="42.938" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="56.667" height="24.667"/>
                                    <rect x="27.542" y="12.771" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="40.25" height="24.667"/>
                                    <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="73.667" y1="77.771" x2="73.667" y2="2.479"/>
                                </svg>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Slide title and content -->
                    <div class="slide-col">
                        <label><h4><?php _e( 'Slide Title', 'dfr_simple_slider' ); ?></h4></label>
                        <input type="text" name="slide[<?php echo $i ?>][title]" value="<?php  echo esc_attr( $field['title'] ); ?>" />
                        <label><h4><?php _e( 'Slide Text', 'dfr_simple_slider' ) ?></h4></label>
                        <textarea name="slide[<?php echo $i ?>][text]" rows="10" maxlength="150" /><?php echo esc_attr( $field['text'] ); ?></textarea>    
                    </div>
                    <!-- Slide button and link -->
                    <div class="slide-col">
                        <label><h4><?php _e( 'Slide Link', 'dfr_simple_slider' ) ?></h4></label>
                        <input type="url" name="slide[<?php echo $i ?>][link]" value="<?php echo esc_attr( $field['link'] ); ?>" />
                        <label><h4><?php _e( 'Slide button text', 'dfr_simple_slider' ); ?></h4></label>
                        <input type="text" name="slide[<?php echo $i ?>][btn-text]" value="<?php echo esc_attr( $field['btn-text'] ); ?>" />
                    </div>
                </div>                
            </div>
            <?php
            $i++;
        }
        ?>
        <!-- empty hidden one for jQuery -->
        <div class="slide-row empty-row screen-reader-text"">
            <div class="slide-header">
                <h3><?php _e( 'New Slide','dfr_simple_slider' ); ?></h3>
                <a class="button remove-row" href="#1"><?php _e( 'Remove Slide', 'dfr_simple_slider' ); ?></a>
            </div>
            <div class="slide-content">
                <!-- Slide Background and images -->
                <div class="slide-col">
                    <label><h4><?php _e( 'Slide Backgorund Color', 'dfr_simple_slider' ); ?></h4></label>
                    <!--<input name="slide[%s][bg-color]" type="text" value="#dddddd" class="color-field" />-->
                    <input name="slide[%s][bg-color]" type="text" value="" class="color-field" />
                    <h4><?php _e( 'Image upload for desktop', 'dfr_simple_slider' ); ?></h4>
                    <a href="#" class="dfr-img-upload button"><?php _e( 'Upload image', 'dfr_simple_slider' ) ?></a>
                    <a href="#" class="dfr-remove" style="display:none"><?php _e( 'Remove image', 'dfr_simple_slider' ) ?></a>
                    <input type="hidden" name="slide[%s][img]" value="">
                    <h4><?php _e( 'Image upload for mobile', 'dfr_simple_slider' ); ?></h4>
                    <a href="#" class="dfr-m-img-upload button"><?php _e( 'Upload image', 'dfr_simple_slider' ) ?></a>
                    <a href="#" class="dfr-m-remove" style="display:none"><?php _e( 'Remove image', 'dfr_simple_slider' ) ?></a>
                    <input type="hidden" name="slide[%s][m-img]" value="">
                </div>
                <!-- Content Align -->
                <div class="slide-col">
                    <label><h4><?php _e( 'Content Align', 'dfr_simple_slider' ); ?></h4></label>
                    <div class="content-align">
                        <div class="radio-row">
                            <input type="radio" id="align-left" name="slide[%s][align]" value="left" ></input>
                            <label for="align-left">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <rect x="11.667" y="42.938" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="56.667" height="24.667"/>
                                <rect x="11.542" y="12.771" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="40.25" height="24.667"/>
                                <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="6.667" y1="77.771" x2="6.667" y2="2.479"/>
                            </svg>
                            </label>
                        </div>
                        <div class="radio-row">
                            <input type="radio" id="align-center" name="slide[%s][align]" value="center" ></input>
                            <label for="align-center">
                                <?php //_e( 'center', 'dfr_simple_slider' ); ?>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                    <rect x="11.667" y="42.938" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="56.667" height="24.667"/>
                                    <rect x="19.542" y="12.771" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="40.25" height="24.667"/>
                                    <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="39.667" y1="12.771" x2="39.667" y2="2.479"/>
                                    <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="39.667" y1="77.521" x2="39.667" y2="67.229"/>
                                    <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="40" y1="37.438" x2="40" y2="42.938"/>
                                </svg>
                            </label>
                        </div>
                        <div class="radio-row">
                            <input type="radio" id="align-right" name="slide[%s][align]" value="right" ></input>
                            <label for="align-right">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <rect x="11.667" y="42.938" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="56.667" height="24.667"/>
                                <rect x="27.542" y="12.771" fill="none" stroke="#8C8C8C" stroke-width="2" stroke-miterlimit="10" width="40.25" height="24.667"/>
                                <line fill="none" stroke="#8C8C8C" stroke-width="4" stroke-miterlimit="10" x1="73.667" y1="77.771" x2="73.667" y2="2.479"/>
                            </svg>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Slide title and content -->
                <div class="slide-col">
                    <label><h4><?php _e( 'Slide Title', 'dfr_simple_slider' ); ?></h4></label>
                    <input type="text" name="slide[%s][title]" value="" />
                    <label><h4><?php _e( 'Slide Text', 'dfr_simple_slider' ) ?></h4></label>
                    <textarea name="slide[%s][text]" cols="50" rows="10" maxlength="150" /></textarea>    
                </div>
                <!-- Slide button and link -->
                <div class="slide-col">
                    <label><h4><?php _e( 'Slide Link', 'dfr_simple_slider' ) ?></h4></label>
                    <input type="url" name="slide[%s][link]" value="" />
                    <label><h4><?php _e( 'Slide button text', 'dfr_simple_slider' ); ?></h4></label>
                    <input type="text" name="slide[%s][btn-text]" value="" />    
                </div>
            </div>
            
        </div>
        <p id="add-row-p-holder"><a id="add-row" class="button" href="#">Insert Another Row</a></p>
    </div> 
    <?php

}

add_action( 'save_post_slider', 'dfr_slider_save_post', 10, 2 );

function dfr_slider_save_post( $post_id ) {

    // Verify the nonce before proceeding.
    if ( ! isset( $_POST[ 'slide-content' ] ) || ! wp_verify_nonce( $_POST[ 'slide-content' ], basename( __FILE__ ) ) ) {
        return;
    }
    // Bail if user doesn't have permission to edit the post.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    // Bail if this is an Ajax request, autosave, or revision.
    if ( wp_doing_ajax() || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }
    
    $old = get_post_meta($post_id, 'repeater_slider_content', true);
    
    $new = array();

    
    if( is_array( $_POST['slide'] ) ):
        $count = count( $_POST['slide'] );
    /* Just for DEV
    else:
        wp_die( var_export( $_POST, true ) );
    */
    endif;    

    if( isset( $_POST['slide'] ) && is_array( $_POST['slide'] ) ) {

        foreach ( $_POST['slide'] as $i => $slide ) {

            if( $i == '%s' ) {
                continue;
            }

            $new[] = array(
                'bg-color' => isset( $slide['bg-color'] ) ? sanitize_text_field( $slide['bg-color'] ) : '',
                'img' => isset( $slide['img'] ) ? intval( $slide['img'] ) : '',
                'm-img' => isset( $slide['m-img'] ) ? intval( $slide['m-img'] ) : '',
                'align' => isset( $slide['align'] ) ? sanitize_text_field( $slide['align'] ) : '',
                'title' =>  isset( $slide['title'] ) ? wp_strip_all_tags( $slide['title'] ) : '',
                'text' => isset( $slide['text'] ) ? allowed_html_chars( $slide['text'] ) : '',
                'link' => isset( $slide['link'] ) ? valid_url( $slide['link'] ) : '',
                'btn-text' => isset( $slide['btn-text'] ) ? wp_strip_all_tags( $slide['btn-text'] ) : ''
            );

        }

    }

	if ( !empty( $new ) && $new != $old ){

		update_post_meta( $post_id, 'repeater_slider_content', $new );

	} elseif ( empty($new) && $old ) {

		delete_post_meta( $post_id, 'repeater_slider_content', $old );

	}
    if( array_key_exists( 'repeter_status', $_REQUEST ) ) {

        $repeter_status = $_REQUEST['repeter_status'];
        update_post_meta( $post_id, 'repeter_status', $repeter_status );

    }
}

function allowed_html_chars ( $value ) {
    $allowed = [
        'strong' => [ 'class' => [] ],
        'em' => [ 'class' => [] ]
    ];
    return wp_kses( $value, $allowed );
}

function valid_url ( $value ) {
    return esc_url( $value );   
}