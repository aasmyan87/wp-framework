<?php
/**
 * Theme Functions
 */

/**
 * Global Variables
 */

$site_title = get_bloginfo('name');


/**
 * Adds custom classes to the array of body classes.
 */
function fw_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'fw_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fw_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'fw_pingback_header' );



/**
 * Get Favicon (ACF)
 */
function fw_favicon(){
    $favicon = get_field('favicon', 'option');
        if( empty( $favicon ) ){
            $favicon = get_stylesheet_directory_uri().'/images/favicon.png';
        }
    ?>
    <link rel="icon" href="<?php echo $favicon; ?>" type="image/png">
    <link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/png">
    <?php
}
add_action('wp_head', 'fw_favicon', 3);


/**
 * Get Mobile Menu Logo
 */
function fw_get_mobile_menu_logo(){
    global $site_title;
    $header_mobile_menu_logo_1x = get_field('header_mobile_logo_1x', 'option');
    $header_mobile_menu_logo_2x = get_field('header_mobile_logo_2x', 'option');
    $header_mobile_logo_width = get_field('header_mobile_logo_width', 'option');
    ?>
    <?php if( !empty( $header_mobile_menu_logo_1x ) ): ?>
         <div class="fw-menu--head-logo" style="max-width: <?php echo $header_mobile_logo_width; ?>px; flex: 0 0 <?php echo $header_mobile_logo_width; ?>px">
            <a title="<?php echo $site_title; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php fw_get_picture( array( $header_mobile_menu_logo_1x, '' ), array( $header_mobile_menu_logo_2x, '' ), '', '', true, $site_title, '' ); ?>
            </a>
         </div>
    <?php else: ?>
        <div class="fw-menu--head-logo">
            <a title="<?php echo $site_title; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php echo  $site_title; ?>
            </a>
        </div>
    <?php endif; ?>
    <?php
}

/**
 * Get Header Desktop Logo
 */
function fw_get_desktop_header_logo(){

    global $site_title;
    $header_logo_1x = get_field('header_logo_1x', 'option');
    $header_logo_2x = get_field('header_logo_2x', 'option');
    $header_logo_width = get_field('header_logo_width', 'option');
    ?>
    <?php if( !empty( $header_logo_1x ) ): ?>
        <a title="<?php echo $site_title; ?>" class="fw-logo d-none d-lg-block" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="max-width: <?php echo $header_logo_width; ?>px; flex: 0 0 <?php echo $header_logo_width; ?>px">
            <?php fw_get_picture( array( $header_logo_1x, '', '1x' ), array( $header_logo_2x, '', '2x' ), '', true, '', $site_title, '' ); ?>
        </a>
    <?php else: ?>
        <a title="<?php echo $site_title; ?>" class="fw-logo d-none d-lg-block" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php echo  $site_title; ?>
        </a>
    <?php endif; ?>
    <?php
}

/**
 * Get Header Mobile Logo
 */
function fw_get_mobile_header_logo(){
    global $site_title;
    $header_logo_mobile_1x = get_field('header_logo_mobile_1x', 'option');
    $header_logo_mobile_2x = get_field('header_logo_mobile_2x', 'option');
    $header_logo_width_mobile = get_field('header_logo_width_mobile', 'option');
    ?>
    <?php if( !empty( $header_logo_mobile_1x ) ): ?>
        <a title="<?php echo $site_title; ?>" class="fw-logo d-lg-none" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="max-width: <?php echo $header_logo_width_mobile; ?>px; flex: 0 0 <?php echo $header_logo_width_mobile; ?>px">
            <?php fw_get_picture( array( $header_logo_mobile_1x, '' ), array( $header_logo_mobile_2x, '' ), '', true, '', $site_title, '' ); ?>
        </a>
    <?php else: ?>
        <a title="<?php echo $site_title; ?>" class="fw-logo d-lg-none text-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php echo  $site_title; ?>
        </a>
    <?php endif; ?>
    <?php
}

/**
 * Menu Navigation (ACF)
 */
function fw_navigation(){
    ?>
    <nav id="site-navigation" class="mobile-nav_js fw-menu">
        <div class="fw-menu--mobile-head">
            <div class="fw-menu--head-logo">
                <?php fw_get_mobile_menu_logo(); ?>
            </div>
            <button aria-label="Close Mobile Menu" class="menu-close-btn menu-close-btn_js">
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="fw-menu--mobile-body">
            <?php
            if( has_nav_menu('header_menu') ){
                wp_nav_menu(
                    array(
                        'theme_location' => 'header_menu',
                        'menu_id'              => '',
                        'container'            => '',
                        'container_class'      => '',
                        'menu_class'           => 'general-menu_js fw-menu--nav',
                        'walker' => new New_Theme_Menu()
                    )
                );
            }
            ?>
        </div>
    </nav>
    <?php
}

/**
 * Menu Navigation (Mobile Flipping) (ACF)
 */
function fw_flipping_navigation(){

    ?>
    <nav id="site-navigation" class="mobile-nav_js fw-menu">
        <div class="fw-menu--mobile-head">
            <?php fw_get_mobile_menu_logo(); ?>
            <button aria-label="Close Mobile Menu" class="menu-close-btn menu-close-btn_js">
                <span></span>
                <span></span>
            </button>
            <button aria-label="Close Mobile Sub Menu"  class="menu-close-sub-btn menu-close-sub-btn_js">
                <i class="icon-angle-left"></i>
            </button>
        </div>
        <div class="fw-menu--mobile-body">
            <?php
            if( has_nav_menu('header_menu') ){
                wp_nav_menu(
                    array(
                        'theme_location' => 'header_menu',
                        'menu_id'              => '',
                        'container'            => '',
                        'container_class'      => '',
                        'menu_class'           => 'general-menu_js fw-menu--nav',
                        'walker' => new New_Theme_Menu_Flipping()
                    )
                );
            }
            ?>
        </div>
    </nav>
    <?php
}


/**
 * Get Company Address (ACF)
 */
function fw_company_address(){
    $address = get_field('address', 'option');
    if( !empty( $address ) ){
        ?>
        <div class="fw-contact--address">
            <i class="fw-contact--icon icon-location"></i>
            <?php echo $address ?>
        </div>
        <?php
    }
}

/**
 * Get Company Email (ACF)
 */
function fw_company_email( $list_class = '' ){
    $emails = get_field('emails', 'option');
    $emails_count = '';
    if( !empty( $emails ) ){
        $emails_count = count ( $emails );
    }
    if( have_rows('emails', 'option') ): ?>
        <?php if( $emails_count > 1 ) : ?>
            <nav class="fw-contact <?php if( $list_class ) { echo $list_class; } ?>">
                <ul class="fw-contact--list list-reset <?php if( $list_class ) { echo $list_class; } ?>">
                    <?php while( have_rows('emails', 'option') ): the_row();
                        $email_label = get_sub_field('email_label', 'option');
                        $email_address = get_sub_field('email_address', 'option');
                        if( empty( $email_label ) ){
                            $email_label = $email_address;
                        }
                        ?>
                        <?php if( !empty( $email_address ) ) :?>
                            <li>
                                <a class="fw-contact--link" title="<?php echo esc_attr( $email_label ) ?>" href="mailto:<?php echo $email_address; ?>">
                                    <i class="fw-contact--icon icon-mail-alt"></i>
                                    <?php echo $email_label; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            </nav>

            <?php else: ?>
            <?php
                $first_em_value = $emails[0]["email_label"];
                $second_em_value = $emails[0]["email_address"];
                    if( empty( $first_em_value ) ){
                        $first_em_value = $second_em_value;
                    }
                ?>
                <?php if( !empty( $first_em_value )) :  ?>
                    <a class="fw-contact--link" title="<?php echo esc_attr( $first_em_value ) ?>" href="mailto:<?php echo $second_em_value; ?>">
                        <i class="fw-contact--icon icon-mail-alt"></i>
                        <?php echo $first_em_value; ?>
                    </a>
                <?php endif; ?>
        <?php endif; ?>
    <?php endif;
}

/**
 * Get Company Phone Number (ACF)
 */
function fw_company_phone( $list_class = '' ){
    $phones = get_field('phone_numbers', 'option');
    $phones_count = '';
    if( !empty( $phones ) ){
        $phones_count = count ( $phones );
    }
    if( have_rows('phone_numbers', 'option') ): ?>
        <?php if( $phones_count > 1 ) : ?>
            <nav class="fw-contact <?php if( $list_class ) { echo $list_class; } ?>">
                <ul class="fw-contact--list list-reset <?php if( $list_class ) { echo $list_class; } ?>">
                    <?php while( have_rows('phone_numbers', 'option') ): the_row();
                        $phone_label = get_sub_field('phone_label', 'option');
                        $phone_number = get_sub_field('phone_number', 'option');
                        $no_space_phone = preg_replace('/[()\s]/', '', $phone_number);
                        if( empty( $phone_label ) ){
                            $phone_label = $no_space_phone;
                        }
                        ?>
                        <?php if( !empty( $phone_number ) ) :?>
                            <li>
                                <a class="fw-contact--link" title="<?php echo esc_attr( $phone_label ) ?>" href="tel:<?php echo $no_space_phone; ?>">
                                    <i class="fw-contact--icon icon-phone"></i>
                                    <?php echo $phone_label; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            </nav>
        <?php else: ?>
            <?php
            $first_em_value = $phones[0]["phone_label"];
            $second_em_value = $phones[0]["phone_number"];
            $no_space_phone = preg_replace('/[()\s]/', '', $second_em_value);
            if( empty( $first_em_value ) ){
                $first_em_value = $second_em_value;
            }
            ?>
            <?php if( !empty( $first_em_value )) :  ?>
                <a class="fw-contact--link" title="<?php echo esc_attr( $first_em_value ) ?>" href="tel:<?php echo $no_space_phone; ?>">
                    <i class="fw-contact--icon icon-phone"></i>
                    <?php echo $first_em_value; ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif;
}

/**
 * Get Social Icons (ACF)
 */
function fw_get_socials( $list_class = '' ){
    if( have_rows('socials', 'option') ) : ?>
        <nav class="fw-social <?php if( $list_class ) { echo $list_class; } ?>">
            <ul class="list-reset fw-social--list">
                <?php while( have_rows('socials', 'option') ) : the_row(); ?>
                    <?php if( get_row_layout() == 'facebook' ) : $url = get_sub_field('url'); ?>
                        <?php if( !empty( $url ) ) : ?>
                            <li>
                                <a target="_blank" title="Facebook" href="<?php echo esc_url( $url ) ?>">
                                    <i class="icon-facebook"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php elseif( get_row_layout() == 'instagram' ) : $url = get_sub_field('url'); ?>
                        <?php if( !empty( $url ) ) : ?>
                            <li>
                                <a target="_blank" title="Instagram" href="<?php echo esc_url( $url ) ?>">
                                    <i class="icon-instagram"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php elseif( get_row_layout() == 'linkedin' ) : $url = get_sub_field('url'); ?>
                        <?php if( !empty( $url ) ) : ?>
                            <li>
                                <a target="_blank" title="Linkedin" href="<?php echo esc_url( $url ) ?>">
                                    <i class="icon-linkedin"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php elseif( get_row_layout() == 'youtube' ) : $url = get_sub_field('url'); ?>
                        <?php if( !empty( $url ) ) : ?>
                            <li>
                                <a target="_blank" title="Youtube" href="<?php echo esc_url( $url ) ?>">
                                    <i class="icon-youtube-play"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php elseif( get_row_layout() == 'twitter' ) : $url = get_sub_field('url'); ?>
                        <?php if( !empty( $url ) ) : ?>
                            <li>
                                <a target="_blank" title="Twitter" href="<?php echo esc_url( $url ) ?>">
                                    <i class="icon-twitter"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        </nav>
    <?php endif;
}


/**
 * Get Footer Text (ACF)
 */
function fw_footer_text(){
    global $site_title;
    $footer_text = get_field('footer_text', 'option');
    if( !empty( $footer_text ) ){
        echo $footer_text;
    }else{
        ?>
        <a title="<?php echo $site_title; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            Wordpress Framework
        </a>
        <?php
    }
}
