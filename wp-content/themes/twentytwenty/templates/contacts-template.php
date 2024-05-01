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
                var eldata0 = document.createElement('div');
                eldata0.className = 'marker';

                new mapboxgl.Marker(eldata0)
                    .setLngLat([30.484446, 50.430784])
                    .setPopup(new mapboxgl.Popup({ offset: 25 })
                        .setHTML("<p>\u041c\u0430\u0439\u0441\u0442\u0435\u0440\u043d\u044f Matiss<\/p>\r\n<p>\u0432\u0443\u043b. \u0428\u0430\u043f\u043e\u0432\u0430\u043b\u0430 2, \u043e\u0444 555<\/p>" + '</p>'))
                    .addTo(map);

                var eldata1 = document.createElement('div');
                eldata1.className = 'marker';

                new mapboxgl.Marker(eldata1)
                    .setLngLat([30.358381, 50.438213])
                    .setPopup(new mapboxgl.Popup({ offset: 25 })
                        .setHTML("<p>\u0421\u0430\u043b\u043e\u043d \u043a\u0430\u0440\u0442\u0438\u043d Matiss<\/p>\r\n<p>\u0422\u0426 4Room<\/p>\r\n<p>\u041f\u0435\u0442\u0440\u043e\u043f\u0430\u0432\u043b\u0456\u0432\u0441\u044c\u043a\u0430 \u0411\u043e\u0440\u0449\u0430\u0433\u0456\u0432\u043a\u0430, \u0432\u0443\u043b.\u041f\u0435\u0442\u0440\u043e\u043f\u0430\u0432\u043b\u0456\u0432\u0441\u044c\u043a\u0430 6<\/p>" + '</p>'))
                    .addTo(map);

                var eldata2 = document.createElement('div');
                eldata2.className = 'marker';

                new mapboxgl.Marker(eldata2)
                    .setLngLat([30.441198, 50.381854])
                    .setPopup(new mapboxgl.Popup({ offset: 25 })
                        .setHTML("<p>\u0421\u0430\u043b\u043e\u043d \u043a\u0430\u0440\u0442\u0438\u043d Matiss<\/p>\r\n<p>\u0422\u0426 \u0410\u0440\u0430\u043a\u0441<\/p>\r\n<p>\u0412\u0435\u043b\u0438\u043a\u0430 \u043a\u0456\u043b\u044c\u0446\u0435\u0432\u0430 \u0434\u043e\u0440\u043e\u0433\u0430 110<\/p>" + '</p>'))
                    .addTo(map);

                var eldata3 = document.createElement('div');
                eldata3.className = 'marker';

                new mapboxgl.Marker(eldata3)
                    .setLngLat([23.907950, 49.830623])
                    .setPopup(new mapboxgl.Popup({ offset: 25 })
                        .setHTML("<p>\u0421\u0430\u043b\u043e\u043d \u043a\u0430\u0440\u0442\u0438\u043d Matiss<\/p>\r\n<p>\u0422\u0426&nbsp;\u0422\u0440\u0438 \u0441\u043b\u043e\u043d\u0438<\/p>\r\n<p>\u041b\u044c\u0432\u0456\u0432, \u0417\u0438\u043c\u043d\u0430 \u0432\u043e\u0434\u0430, \u042f\u0432\u0430\u0440\u044b\u0432\u0441\u044c\u043a\u0430 22<\/p>" + '</p>'))
                    .addTo(map);

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
                    <h4 class="contact-form__title">Замовити зворотній звʼязок</h4>
                    <form>
                        <div class="contact-form__case">
                            <div class="contact-form__field contact-form__field--required">
                                <input type="text" name="name" placeholder="Імʼя*" id="name">
                                <label for="name">Імʼя*</label>
                                <p class="contact-form__error">Будь-ласка, введіть імʼя</p>
                            </div>
                            <div class="contact-form__field contact-form__field--required">
                                <input type="text" name="name" placeholder="Телефон*" id="phone">
                                <label for="phone">Телефон*</label>
                                <p class="contact-form__error">Будь-ласка, введіть номер телефону</p>
                            </div>
                        </div>
                        <div class="contact-form__field">
                            <input type="text" name="name" placeholder="Email" id="email">
                            <label for="email">Email</label>
                        </div>
                        <div class="contact-form__field">
                            <textarea placeholder="Повідомлення" name="message" id="message"></textarea>
                            <label for="message">Повідомлення</label>
                        </div>
                        <input class="contact-form__button button__primary disabled" value="надіслати" type="submit">
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
                    <h3 class="dealers__title">Наші дилери</h3>
                    <ul class="dealers__list">
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">ОАЕ. Дубаї. Салон Iconic home. Showroom Baker</h4>
                            <a href="#" class="dealers__item_link">www.iconichomeuae.com</a>
                            <p>Dubai Design District (d3)</p>
                            <p>Building 8,</p>
                            <p>1st Floor, Dubai,</p>
                            <a href="#" class="dealers__item_tel">+971 4 55 22 920</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон меблів "Sophie Decor"</h4>
                            <a href="#" class="dealers__item_link">sophie-decor.com.ua</a>
                            <p>ТЦ "4Room", -1 поверх</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 6</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (050) 355-2285</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон італійських меблів "Rim"</h4>
                            <a href="#" class="dealers__item_link">www.rim.ua</a>
                            <p>ТЦ "4Room", 1 поверх (ліве крило)</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 6</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (067) 500-4701</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон бельгійських меблів "ROM"</h4>
                            <a href="#" class="dealers__item_link">https://rom-ua.com</a>
                            <p>ТЦ "4Room", салон "ROM". 1 поверх.</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 12</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (066) 467-0226</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон меблів "WELOVEMEBEL"</h4>
                            <a href="#" class="dealers__item_link">https://welovemebel.com.ua/ua/</a>
                            <p>ТЦ "4Room", 2 поверх</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 6</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (063) 841-0335</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон меблів "WELOVEMEBEL"</h4>
                            <a href="#" class="dealers__item_link">welovemebel.com.ua</a>
                            <p>"Центральний Дім Меблів", -1 поверх</p>
                            <p>бул. Дружби Народів, 23</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (067) 402-8216</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон бельгійських меблів "ROM"</h4>
                            <a href="#" class="dealers__item_link">www.rom-ua.com</a>
                            <p>ТЦ "Аракс", салон "ROM".</p>
                            <p>1 поверх.</p>
                            <p>вул. Велика Окружна, 110</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (095) 617-0525</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон італійських меблів "CARVELLI"</h4>
                            <a href="#" class="dealers__item_link">www.tango.ua</a>
                            <p>ТЦ "4Room",</p>
                            <p>2 поверх</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 6</p>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон м'яких меблів та інтер'єру "Interios"</h4>
                            <a href="#" class="dealers__item_link">www.millini.com.ua</a>
                            <p>пр-т. Григоренка, 22/20, 2 поверх</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (044) 229-2902</a>
                            <p>пн-пт 10.00 - 19.00,</p>
                            <p>сб-нд 10.00 - 19.00</p>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон "Giorgio Concept"</h4>
                            <a href="#" class="dealers__item_link">www.giorgioconcept.com</a>
                            <p>ТЦ "Домосфера", 2 поверх</p>
                            <p>Столичне шосе, 101</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (044) 252-7203</a>
                            <a href="#" class="dealers__item_tel">тел.: +38 (067) 555-1552</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон м'яких меблів "Millini"</h4>
                            <a href="#" class="dealers__item_link">www.millini.com.ua</a>
                            <p>ТЦ "4Room". - 1 поверх.</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 6</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (044) 229-2905</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Київ. Салон італійських меблів "Tango"</h4>
                            <a href="#" class="dealers__item_link">www.tango.ua</a>
                            <p>ТЦ "4Room", 2 поверх</p>
                            <p>с. Петропавлівська Борщагівка,</p>
                            <p>вул. Петропавлівська, 6</p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (044) 383-4900</a>
                        </li>
                        <li class="dealers__item">
                            <h4 class="dealers__item_title">Одеса. Салон італійських меблів "Tango"</h4>
                            <a href="#" class="dealers__item_link">www.tango.ua</a>
                            <p class="dealers__item_adress">Люстдорфська дорога, 55/2 </p>
                            <a href="#" class="dealers__item_tel">тел.: +38 (048) 737-3030</a>
                            <a href="#" class="dealers__item_tel">тел.: +380 (97) 333-04-44</a>
                            <p class="dealers__item_adress">10:00-20:00</p>
                        </li>
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
                    <h4 class="newsletter__title text-center fw-500">Отримайте доступ до нашого щорічного каталогу картин в PDF
                        форматі</h4>
                    <p class="newsletter__text text-center fz-18">Готові вдосконалити ваші проекти за допомогою робіт від наших
                        художників? Залиште email нижче, щоб отримати каталог для зручного використання
                    </p>
                    <div class="newsletter__form">
                        <form method="post">
                            <div class="newsletter__form_field">
                                <input class="newsletter__form_input" placeholder="Email" id="POST-name" type="text" name="name">
                                <label class="newsletter__form_label" for="POST-name">Email</label>
                            </div>
                            <input class="button__primary newsletter__form_button" type="submit" value="Підписатися">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
