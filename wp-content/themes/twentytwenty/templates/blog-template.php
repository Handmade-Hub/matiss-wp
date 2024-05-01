<?php

/**
 * Template Name: Blog Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$fields = get_field( 'blog_fields' );
$posts = $fields[ 'posts' ];

$posts =  array_reverse( $posts );
?>

    <section class="blog">
        <div class="blog__wrapper">
            <div class="container">
                <div class="blog__inner">
                    <ul class="blog__list">
                        <?php
                        if ( is_array( $posts ) && ! empty( $posts ) ) {
                            foreach ( $posts as $post ) {
                                $title = $post[ 'title' ];
                                $subtitle = $post[ 'subtitle' ];
                                $media_type = $post[ 'media_type' ];

                                // check media type
                                if ( $media_type === 'Зображення' ) {
                                    $image_id = $post[ 'image' ];
                                    if ( ! empty( $image_id ) ) {
                                        $media = wp_get_attachment_image( $image_id, 'full', false, array( 'loading' => 'lazy' ) );
                                    }
                                } else {
                                    // embed video
                                    $media = $post[ 'video' ];
                                }
                                ?>
                                <li class="blog__item">
                                    <div class="blog__item_content">
                                        <h3 class="blog__item_title"><?php echo $title; ?></h3>
                                        <p><?php echo $subtitle; ?></p>
                                    </div>
                                    <div class="blog__item_media">
                                        <?php
                                        if ( ! empty( $media ) ) {
                                            echo $media;
                                        }
                                        ?>
                                    </div>
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

<?php
get_footer();
