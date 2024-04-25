<?php

/**
 * Template Name: Catalog Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$elements = get_field('elements')
?>

<script>
    console.log(<?php print_r(json_encode($elements)) ?>)
</script>

<!-- collections -->
<section class="collections">
    <div class="collections__wrapper">
        <div class="container">
            <div class="collections__inner">
                <ul class="collections__list">
                    <?php

                    foreach ($elements as $element) { ?>
                        <li class="collections__item">
                            <div class="collections__item_image">
                                <img src="<?= $element['image'] ?>" alt="collection">
                                <a href="<?= $element['button_link']['url'] ?>" class="collections__item_button button__secondary uppercase"><?= $element['button_label'] ?></a>
                            </div>
                            <p class="collections__item_description text-center"><?= $element['description'] ?></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
