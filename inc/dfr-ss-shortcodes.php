<?php
function dfr_ss_doshortcode( $atts ) {
    ob_start();

    $shortcode_atts = shortcode_atts( array(
        'id' => ''
    ), $atts );

    $slider_args = array(
        'post_type' => 'slider',
        'posts_per_page' => 1,
        'p' => $shortcode_atts['id']
    );

    $slider_query = new WP_query( $slider_args );

    if( $slider_query->have_posts() ):

        while( $slider_query->have_posts() ): $slider_query->the_post();
            $slider = $slider_query->post;
            ?>
            <div class="slider">
                <?php
                $slider_content = get_post_meta( $slider->ID, 'repeater_slider_content', true );
                //echo '<pre>';
                //var_dump( $slider_content );
                //echo '</pre>';
                ?>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php 
                        foreach( $slider_content as $slide ):
                            $slide_img = wp_get_attachment_image_src($slide['img']);
                            //var_dump($slide_img);
                            ?>
                            <div class="swiper-slide" style="background-color: <?php echo $slide['bg-color']; ?>;">
                                <?php 
                                if( isset( $slide_img ) && $slide_img !== false ){
                                    ?>
                                    <img src="<?php echo $slide_img[0]; ?>" alt="">    
                                    <?php
                                }
                                switch ( $slide['align'] ) {
                                    case 'left':
                                        echo '<div class="slide-content content-left">';
                                        break;
                                    case 'center':
                                        echo '<div class="slide-content content-center">';
                                        break;
                                    case 'right':
                                        echo '<div class="slide-content content-right">';
                                        break;
                                    case '':
                                        echo '<div class="slide-content content-left">';
                                        break;
                                }
                                ?>
                                    <h2>Title Slide</h2>
                                    <p>Slide content text width more words than a title.</p>
                                    <a class="#">Link button</a>
                                </div>
                                <!--<h2><?php //echo $slide['title'] ?></h2>-->
                            </div>
                            <?php    
                        endforeach;
                        ?>
                        
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <?php
        endwhile;
    
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'slider', 'dfr_ss_doshortcode' );

function enqueue_swiper() {
    $css_url = plugin_dir_url(__FILE__) . 'swiper/swiper-bundle.min.css';
    wp_enqueue_style( 'swiper',  $css_url, array(), '8.4.5', 'all');

    $js_url = plugin_dir_url(__FILE__) . 'swiper/swiper-bundle.min.js';
    wp_enqueue_script( 'swiper-js',  $js_url, array(), '8.4.5', 'all', true );
    //wp_enqueue_script( 'swiper-config',  plugin_dir_url(__FILE__) . '../js/main.js', array( 'swiper-js' ), 'all', false );
    wp_enqueue_script( 'swiper-config',  plugin_dir_url(__FILE__) . '../js/main.js', array(), 'all', true );

}
add_action( 'wp_enqueue_scripts', 'enqueue_swiper' );