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
    // console.log(<?php print_r(json_encode($elements)) ?>)
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
                                <a href="<?= $element['button_link']['url'] ?>" class="collections__item_button button__secondary uppercase <?php if ($element['button_label'] === 'Індивідуальне замовлення') {
                                                                                                                                                echo 'product__button--modal-order';
                                                                                                                                            } ?>"><?= $element['button_label'] ?></a>
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

//    $form_order = do_shortcode('[contact-form-7 id="3628495" title="Індивідуальне замовлення"]');
//    echo $form_order;

wc_get_template_part('single-product/add-to-cart/modal-order');
?>

<script defer>
    // (() => {
    //     const modalIndividualOrder = document.querySelector('.modal-individual-order');
    //     const collectionsInner = document.querySelector('.collections__inner');
    //     const closeBtn = document.querySelector('#close_btn');
    //
    //     collectionsInner.addEventListener('click', evt => {
    //         const element = evt.target;
    //
    //         if (!element.href.includes('#speshial_order')) return;
    //
    //         modalIndividualOrder.style.display = 'flex';
    //         setTimeout(() => {
    //             modalIndividualOrder.style.opacity = 1;
    //         }, 200)
    //     });
    //
    //     closeBtn.addEventListener('click', () => {
    //         modalIndividualOrder.style.opacity = 0;
    //         setTimeout(() => {
    //             modalIndividualOrder.style.display = 'none';
    //         }, 200)
    //     })
    //
    // })();
    (() => {
        const shopUploadArea = document.querySelector('#shop-upload-area');

        shopUploadArea.addEventListener('click', () => {
            const cdUploadBtn = document.querySelector('.cd-upload-btn');
            cdUploadBtn.click();
        })
    })()
</script>

<?php
get_footer();
