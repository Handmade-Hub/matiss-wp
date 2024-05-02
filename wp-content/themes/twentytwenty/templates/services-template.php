<?php

/**
 * Template Name: Services Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$result_array = get_information_menu_items();

$fields = get_field( 'services_fields' );
$main_section = $fields[ 'main_section' ];
$modern_painting = $fields[ 'modern_painting' ];
$turning_to_us = $fields[ 'turning_to_us' ];
$wall_painting = $fields[ 'wall_painting' ];
$advantages_wall_painting = $fields[ 'advantages_wall_painting' ];
$aerography = $fields[ 'aerography' ];
$aerography_on_car = $fields[ 'aerography_on_car' ];
$anywhere = $fields[ 'anywhere' ];
?>

    <!-- information-bar -->
    <section class="information-bar">
        <div class="information-bar__wrapper bg-gray">
            <div class="container">
                <div class="information-bar__inner">
                    <nav class="information-bar__navigation">
                        <ul class="information-bar__list">
                            <?php foreach ($result_array as $item) { ?>
                                <li class="information-bar__item <?php echo is_menu_item_active($item) ? 'active' : ''; ?>">
                                    <a href="<?= $item['parent']->url ?>" class="information-bar__link uppercase"><?= $item['parent']->title ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- image-with-text -->
    <section class="image-with-text image-with-text--one">
        <div class="image-with-text__wrapper">
            <div class="container">
                <div class="image-with-text__inner">
                    <div class="image-with-text__case">
                        <div class="image-with-text__image">
                            <?php
                            if ( ! empty( $main_section[ 'image' ] ) ) {
                                echo wp_get_attachment_image( $main_section[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                            }
                            ?>
                        </div>
                        <div class="image-with-text__content">
                            <h4><?php echo $main_section[ 'title' ]; ?></h4>
                            <div><?php echo $main_section[ 'text' ]; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- column -->
    <section class="column">
        <div class="column__wrapper">
            <div class="container">
                <div class="column__inner">
                    <div class="column__content">
                        <h3 class="column__title"><?php echo $modern_painting[ 'title' ]; ?></h3>
                        <div class="column__subtitle"><?php echo $modern_painting[ 'text' ]; ?></div>
                    </div>
                    <div class="column__image">
                        <?php
                        if ( ! empty( $modern_painting[ 'image' ] ) ) {
                            echo wp_get_attachment_image( $modern_painting[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                        }
                        ?>
                    </div>
                    <div class="column__case">
                        <div class="column__case_content">
                            <h4 class="column__case_title"><?php echo $turning_to_us[ 'title' ]; ?></h4>
                            <div><?php echo $turning_to_us[ 'text' ]; ?></div>
                            <?php
                            if ( is_array( $turning_to_us[ 'button' ] ) && ! empty( $turning_to_us[ 'button' ] ) ) {
                                $linkUrl = $turning_to_us[ 'button' ][ 'url' ];
                                $linkTitle = $turning_to_us[ 'button' ][ 'title' ];
                                $linkTarget = $turning_to_us[ 'button' ][ 'target' ] ?
                                    $turning_to_us[ 'button' ][ 'target' ] : '_self';
                            ?>
                            <a class="column__case_button button__outline" href="<?php echo $linkUrl; ?>"
                               target="<?php echo $linkTarget; ?>">
                                <?php echo $linkTitle; ?>
                            </a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="column__case_image">
                            <?php
                            if ( ! empty( $turning_to_us[ 'image' ] ) ) {
                                echo wp_get_attachment_image( $turning_to_us[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- multi-row -->
    <secrion class="multi-row">
        <div class="multi-row__wrapper">
            <div class="container">
                <div class="multi-row__inner">
                    <div class="multi-row__content">
                        <h3 class="multi-row__title"><?php echo $wall_painting[ 'title' ]; ?></h3>
                        <div class="multi-row__subtitle"><?php echo $wall_painting[ 'text' ]; ?></div>
                    </div>
                    <div class="multi-row__image">
                        <?php
                        if ( ! empty( $wall_painting[ 'image' ] ) ) {
                            echo wp_get_attachment_image( $wall_painting[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                        }
                        ?>
                    </div>
                    <div class="multi-row__case">
                        <div class="multi-row__case_block">
                            <h4 class="multi-row__case_title"><?php echo $advantages_wall_painting[ 'title' ]; ?></h4>
                            <div><?php echo $advantages_wall_painting[ 'text' ]; ?></div>
                        </div>
                        <div class="multi-row__case_image">
                            <?php
                            if ( ! empty( $advantages_wall_painting[ 'image' ] ) ) {
                                echo wp_get_attachment_image( $advantages_wall_painting[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="multi-row__case multi-row__case--reverse">
                        <div class="multi-row__case_image">
                            <?php
                            if ( ! empty( $advantages_wall_painting[ 'image_second' ] ) ) {
                                echo wp_get_attachment_image( $advantages_wall_painting[ 'image_second' ], 'full', false, array( 'loading' => 'lazy' ) );
                            }
                            ?>
                        </div>
                        <div class="multi-row__case_block">
                            <div><?php echo $advantages_wall_painting[ 'text_second' ]; ?></div>
                            <?php
                            if ( is_array( $advantages_wall_painting[ 'button' ] ) && ! empty( $advantages_wall_painting[ 'button' ] ) ) {
                                $linkUrl = $advantages_wall_painting[ 'button' ][ 'url' ];
                                $linkTitle = $advantages_wall_painting[ 'button' ][ 'title' ];
                                $linkTarget = $advantages_wall_painting[ 'button' ][ 'target' ] ?
                                    $advantages_wall_painting[ 'button' ][ 'target' ] : '_self';
                                ?>
                                <a class="multi-row__case_button button__outline" href="<?php echo $linkUrl; ?>"
                                   target="<?php echo $linkTarget; ?>">
                                    <?php echo $linkTitle; ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </secrion>

    <!-- column -->
    <section class="column column--two">
        <div class="column__wrapper">
            <div class="container">
                <div class="column__inner">
                    <div class="column__content">
                        <h3 class="column__title"><?php echo $aerography[ 'title' ]; ?></h3>
                        <div class="column__subtitle"><?php echo $aerography[ 'text' ]; ?></div>
                    </div>
                    <div class="column__image">
                        <?php
                        if ( ! empty( $aerography[ 'image' ] ) ) {
                            echo wp_get_attachment_image( $aerography[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                        }
                        ?>
                    </div>
                    <div class="column__case">
                        <div class="column__case_content">
                            <h4 class="column__case_title"><?php echo $aerography_on_car[ 'title' ]; ?></h4>
                            <div><?php echo $aerography_on_car[ 'text' ]; ?></div>
                        </div>
                        <div class="column__case_image">
                            <?php
                            if ( ! empty( $aerography_on_car[ 'image' ] ) ) {
                                echo wp_get_attachment_image( $aerography_on_car[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- image-with-text -->
    <section class="image-with-text image-with-text--two image-with-text--reverse">
        <div class="image-with-text__wrapper">
            <div class="container">
                <div class="image-with-text__inner">
                    <h3 class="image-with-text__title"><?php echo $anywhere[ 'title' ]; ?></h3>
                    <div class="image-with-text__case">
                        <div class="image-with-text__image">
                            <?php
                            if ( ! empty( $anywhere[ 'image' ] ) ) {
                                echo wp_get_attachment_image( $anywhere[ 'image' ], 'full', false, array( 'loading' => 'lazy' ) );
                            }
                            ?>
                        </div>
                        <div class="image-with-text__content">
                            <?php echo $anywhere[ 'text' ]; ?>
                            <?php
                            if ( is_array( $anywhere[ 'button' ] ) && ! empty( $anywhere[ 'button' ] ) ) {
                                $linkUrl = $anywhere[ 'button' ][ 'url' ];
                                $linkTitle = $anywhere[ 'button' ][ 'title' ];
                                $linkTarget = $anywhere[ 'button' ][ 'target' ] ?
                                    $anywhere[ 'button' ][ 'target' ] : '_self';
                                ?>
                                <a class="image-with-text__button button__outline" href="<?php echo $linkUrl; ?>"
                                   target="<?php echo $linkTarget; ?>">
                                    <?php echo $linkTitle; ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
get_footer();