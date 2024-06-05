<?php

/**
 * Template Name: Contacts Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
wp_enqueue_style('mapbox-gl', get_template_directory_uri() . '/assets/css/mapbox-gl.css');
wp_enqueue_script('mapbox-gl', get_template_directory_uri() . '/assets/js/mapbox-gl.js');

get_header();

$fields = get_field( 'contacts_fields' );

$main_number = $fields[ 'main_number' ];
$main_number_clear = preg_replace( '/\D/', '', $main_number );
$number_text = $fields[ 'text_under_number' ];
$email_title = $fields[ 'email_title' ];
$emails = $fields[ 'emails' ];
$locations = $fields[ 'locations' ];

if ( is_array( $locations ) && ! empty( $locations ) ) {
    $locations_chunks = array_chunk( $locations, ceil( count( $locations ) / 2 ) );
    $locations_first_half = $locations_chunks[ 0 ];
    $locations_second_half = $locations_chunks[ 1 ];
}

// map
$map_points = $fields[ 'map_points' ];

// contact form
$form_title = $fields[ 'from_title' ];
$shortcode_form = $fields[ 'shortcode_form' ];

// dillers
$dillers_title_section = $fields[ 'dillers_title' ];
$dillers = $fields[ 'dillers' ];

// subscribe form
$title_subscription = $fields[ 'title_subscription' ];
$subtitle_subscription = $fields[ 'subtitle_subscription' ];
$shortcode_subscribe_form = $fields[ 'shortcode_subscribe_form' ];
?>
    <!-- contacts -->
    <section class="contacts">
        <div class="contacts__wrapper">
            <div class="container">
                <div class="contacts__inner">
                    <ul class="contacts__list">
                        <li class="contacts__item">
                            <div class="contacts__item_block">
                                <div class="contacts__item_case">
                                    <img src="<?= home_url(); ?>/images/icons/icon-viber.svg" alt="icon">
                                    <a href="tel:<?php echo $main_number_clear; ?>"><?php echo $main_number; ?></a>
                                </div>
                                <p><?php echo $number_text; ?></p>
                            </div>
                            <div class="contacts__item_block">
                                <div class="contacts__item_case">
                                    <img src="<?= home_url(); ?>/images/icons/Icon-email.svg" alt="icon">
                                    <p><?php echo $email_title; ?></p>
                                </div>
                                <?php
                                if ( is_array( $emails ) && ! empty( $emails ) ) {
                                    foreach ( $emails as $email ) {
                                        $email_text = $email[ 'email_info' ];
                                        $email_address = $email[ 'email' ];
                                        ?>
                                        <div class="contacts__item_wrap">
                                            <p><?php echo $email_text; ?></p>
                                            <a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </li>
                        <li class="contacts__item">
                            <?php
                            if ( is_array( $locations_first_half ) && ! empty( $locations_first_half ) ) {
                                foreach ( $locations_first_half as $location ) {
                                    $location_name = $location[ 'location_name' ];
                                    $location_adress = $location[ 'location_adress' ];
                                    if ( is_array( $location_adress ) && ! empty( $location_adress ) ) {
                                        $location_map_adress = $location_adress[ 'url' ];
                                        $location_text_adress = $location_adress[ 'title' ];
                                    }
                                    $location_work_schedule = $location[ 'work_schedule' ];
                                    $location_phone = $location[ 'phone' ];
                                    $location_phone_clear = preg_replace( '/\D/', '', $location_phone );
                                    ?>
                                    <div class="contacts__item_block">
                                        <div class="contacts__item_case">
                                            <img src="<?= home_url(); ?>/images/icons/Icon-location.svg" alt="icon">
                                            <p><?php echo $location_name; ?></p>
                                        </div>
                                        <a href="<?php echo $location_map_adress; ?>" class="underline" target="_blank"><?php echo $location_text_adress; ?></a>
                                        <p><?php echo $location_work_schedule; ?></p>
                                        <?php
                                        if ( ! empty( $location_phone ) && ! empty( $location_phone_clear ) ) {
                                        ?>
                                            <a href="tel:<?php echo $location_phone_clear; ?>"><?php echo $location_phone; ?></a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </li>
                        <li class="contacts__item">
                            <?php
                            if ( is_array( $locations_second_half ) && ! empty( $locations_second_half ) ) {
                                foreach ( $locations_second_half as $location ) {
                                    $location_name = $location[ 'location_name' ];
                                    $location_adress = $location[ 'location_adress' ];
                                    if ( is_array( $location_adress ) && ! empty( $location_adress ) ) {
                                        $location_map_adress = $location_adress[ 'url' ];
                                        $location_text_adress = $location_adress[ 'title' ];
                                    }
                                    $location_work_schedule = $location[ 'work_schedule' ];
                                    $location_phone = $location[ 'phone' ];
                                    $location_phone_clear = preg_replace( '/\D/', '', $location_phone );
                                    ?>
                                    <div class="contacts__item_block">
                                        <div class="contacts__item_case">
                                            <img src="<?= home_url(); ?>/images/icons/Icon-location.svg" alt="icon">
                                            <p><?php echo $location_name; ?></p>
                                        </div>
                                        <a href="<?php echo $location_map_adress; ?>" class="underline" target="_blank"><?php echo $location_text_adress; ?></a>
                                        <p><?php echo $location_work_schedule; ?></p>
                                        <?php
                                        if ( ! empty( $location_phone ) && ! empty( $location_phone_clear ) ) {
                                            ?>
                                            <a href="tel:<?php echo $location_phone_clear; ?>"><?php echo $location_phone; ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- map -->
            <style>
                #map {
                    width: 100%;
                    height: 68.2rem;
                }

                @media (max-width: 767px) {
                    #map {
                        height: 40rem;
                    }
                }
                @media (max-width: 575px) {
                    #map {
                        height: 22rem;
                    }
                }
            </style>
            <div class="contacts__map" id='map' class="apelsun-mapbox-wrap idf0d275f0">
            </div>
            <script>
                var mapPoints = [];

                <?php
                if ( is_array( $map_points ) && ! empty( $map_points ) ) {
                    foreach ( $map_points as $map_point ) {
                        $point_info = json_encode( $map_point[ 'point_info' ], JSON_UNESCAPED_UNICODE );
                        $point_coordinates = $map_point[ 'point' ];
                        $explode_coordinates = explode( ',', $point_coordinates );

                        //set data from php to js
                        ?>

                mapPoints.push({
                        pointInfo: <?php echo $point_info; ?>,
                        pointCoordinates: [ <?php echo $explode_coordinates[ 1 ]; ?>, <?php echo $explode_coordinates[ 0 ]; ?> ],
                        htmlPoint: document.createElement('div')
                    })

                mapPoints[mapPoints.length - 1]['htmlPoint'].className = 'marker';

                <?php
                    }
                }
                ?>

                mapboxgl.accessToken = 'pk.eyJ1IjoibWF0dGlzc3MiLCJhIjoiY2p3a2hqMnlnMHR5cTQ4cGJhejQ2ZWVobyJ9.bbN8M-syJjv2MvuLP9qHtw';

                const screenWidth = window.screen.width;
                let zoomNumber;
                screenWidth >= 768 ? zoomNumber = 10 : zoomNumber = 9;

                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/smu24/cjogxz9le005f2sqz9nxvfysz',
                    center: [30.55, 50.45],
                    zoom: zoomNumber
                });

                // add point to map
                mapPoints.forEach(function (item){
                    new mapboxgl.Marker(item.htmlPoint)
                        .setLngLat(item.pointCoordinates)
                        .setPopup(new mapboxgl.Popup({ offset: 25 })
                            .setHTML(item.pointInfo))
                        .addTo(map);
                })

                // disable map zoom when using scroll
                map.scrollZoom.disable();
                map.addControl(new mapboxgl.NavigationControl());
            </script>
        </div>
    </section>

    <!-- contact-form -->
    <section class="contact-form">
        <div class="contact-form__wrapper">
            <div class="container">
                <div class="contact-form__inner">
                    <h4 class="contact-form__title"><?php echo $form_title; ?></h4>
                    <div class="hidden_cf7_form">
                        <?php
                        echo do_shortcode( $shortcode_form );
                        ?>
                    </div>
                    <form class="contact-form_mask">
                        <div class="contact-form__case">
                            <div class="contact-form__field contact-form__field--required">
                                <input type="text" name="name" placeholder="<?php echo __('Імʼя*', 'twentytwenty'); ?>" id="name">
                                <label for="name"><?php echo __('Імʼя*', 'twentytwenty'); ?></label>
                                <p class="contact-form__error"><?php echo __('Будь-ласка, введіть імʼя', 'twentytwenty'); ?></p>
                            </div>
                            <div class="contact-form__field contact-form__field--required">
                                <input type="text" name="phone" placeholder="<?php echo __('Телефон*', 'twentytwenty'); ?>" id="phone">
                                <label for="phone"><?php echo __('Телефон*', 'twentytwenty'); ?></label>
                                <p class="contact-form__error"><?php echo __('Будь-ласка, введіть номер телефону', 'twentytwenty'); ?></p>
                            </div>
                        </div>
                        <div class="contact-form__field">
                            <input type="text" name="email" placeholder="<?php echo __('Email', 'twentytwenty'); ?>" id="email">
                            <label for="email"><?php echo __('Email', 'twentytwenty'); ?></label>
                            <p class="contact-form__error"><?php echo __( 'Будь-ласка, введіть правильний Email', 'twentytwenty' ); ?></p>
                        </div>
                        <div class="contact-form__field">
                            <textarea placeholder="<?php echo __('Повідомлення', 'twentytwenty'); ?>" name="message" id="message"></textarea>
                            <label for="message"><?php echo __('Повідомлення', 'twentytwenty'); ?></label>
                        </div>
                        <input class="contact-form__button button__primary disabled" value="<?php echo __('надіслати', 'twentytwenty'); ?>" type="submit">
                        <div class="contact-form-response"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- dealers -->
    <section class="dealers">
        <div class="dealers__wrapper bg-gray">
            <div class="container">
                <div class="dealers__inner">
                    <h3 class="dealers__title"><?php echo $dillers_title_section; ?></h3>
                    <ul class="dealers__list">
                        <?php
                        if ( is_array( $dillers ) && ! empty( $dillers ) ) {
                            foreach ( $dillers as $diller ) {
                                $diller_name = $diller[ 'name' ];
                                $site_url = $diller[ 'site_url' ];
                                $address = $diller[ 'address' ];
                                $phone_numbers = $diller[ 'pnone_numbers' ];
                                $work_schedule = $diller[ 'work_schedule' ];
                                ?>
                                <li class="dealers__item">
                                    <h4 class="dealers__item_title"><?php echo $diller_name; ?></h4>
                                    <a href="<?php echo $site_url; ?>" class="dealers__item_link" target="_blank"><?php echo $site_url; ?></a>
                                    <div class="dealers__item_address"><?php echo $address; ?></div>
                                    <?php
                                    // array phone numbers
                                    if ( is_array( $phone_numbers ) && ! empty( $phone_numbers ) ) {
                                        foreach ( $phone_numbers as $phone_number ) {
                                            $diller_phone = $phone_number[ 'pnone' ];
                                            $diller_phone_clear = preg_replace( '/\D/', '', $diller_phone );
                                            ?>
                                            <a href="tel:<?php echo $diller_phone_clear; ?>" class="dealers__item_tel"><?php echo __( 'тел.:', 'twentytwenty' ) . ' ' . $diller_phone; ?></a>
                                            <?php
                                        }
                                    }
                                    if ( ! empty( $work_schedule ) ) {
                                    ?>
                                    <div class="dealers__item_work-schedule"><?php echo $work_schedule; ?></div>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- newsletter -->
    <section class="newsletter">
        <div class="newsletter__wrapper">
            <div class="container">
                <div class="newsletter__inner">
                    <h4 class="newsletter__title text-center fw-500"><?php echo $title_subscription; ?></h4>
                    <p class="newsletter__text text-center fz-18"><?php echo $subtitle_subscription; ?></p>
                    <div class="newsletter__form">
                        <div class="hidden_cf7_form">
                            <?php
                            echo do_shortcode( $shortcode_subscribe_form );
                            ?>
                        </div>
                        <form class="newsletter_form_mask" method="post">
                            <div class="newsletter__form_field">
                                <input class="newsletter__form_input" placeholder="<?php echo __( 'Email', 'twentytwenty' ); ?>" id="POST-name" type="text" name="name">
                                <label class="newsletter__form_label" for="POST-name"><?php echo __( 'Email', 'twentytwenty' ); ?></label>
                            </div>
                            <input class="button__primary newsletter__form_button" type="submit" value="<?php echo __( 'Підписатися', 'twentytwenty' ); ?>">

                        </form>
                        <p class="contact-form__error"><?php echo __( 'Будь-ласка, введіть правильний Email', 'twentytwenty' ); ?></p>
                        <div class="subscribe-form-response"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
