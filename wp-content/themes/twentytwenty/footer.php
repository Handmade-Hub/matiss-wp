<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


$header_menu_obj = wp_get_nav_menu_items(84);
$result_array = array();

foreach ($header_menu_obj as $menu_item) {
    if ($menu_item->menu_item_parent == 0) {
        $parent_array = array(
            'parent' => $menu_item,
            'children' => array()
        );

        foreach ($header_menu_obj as $child_menu_item) {
            if ($child_menu_item->menu_item_parent == $menu_item->ID) {
                $parent_array['children'][] = $child_menu_item;
            }
        }

        $result_array[] = $parent_array;
    }
}

?>
</main>
<footer class="footer">
    <div class="footer__wrapper space-sections">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__block">
                    <div class="footer__logo footer__logo_mobile">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                        ?>
                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="footer__content">
                        <div class="footer__wrap">
                            <div class="footer__logo">
                                <?php
                                if (has_custom_logo()) {
                                    the_custom_logo();
                                } else {
                                ?>
                                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="footer__info">
                                <p class="footer__info_title fw-600"><?php echo __('Салони', 'twentytwenty'); ?></p>
                                <ul class="footer__info_list">
                                    <?php
                                    $salons = get_field('salons_list', 'option');
                                    if (is_array($salons) && !empty($salons)) {
                                        foreach ($salons as $salon) {
                                    ?>
                                            <li class="footer__info_item">
                                                <?php echo $salon['salon']; ?>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="footer__info">
                                <p class="footer__info_title fw-600"><?php echo __('Майстерня', 'twentytwenty'); ?></p>
                                <ul class="footer__info_list">
                                    <?php
                                    $workshops = get_field('workshops', 'option');
                                    if (is_array($workshops) && !empty($workshops)) {
                                        foreach ($workshops as $workshop) {
                                    ?>
                                            <li class="footer__info_item">
                                                <?php echo $workshop['workshop']; ?>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $menu_counter = 1;
                        foreach ($result_array as $key => $item) {
                        ?>
                                <div class="footer__menu">
                                <?php
                            if (empty($item['children'])) { ?>
                                    <a href="<?= $item['parent']->url ?>" class="footer__menu_link"><?= $item['parent']->title ?></a>
                                <?php
                            } else { ?>
                                    <a href="<?= $item['parent']->url ?>" class="footer__menu_title fw-600"><?= $item['parent']->title ?></a>
                                    <nav class="footer__menu_nav">
                                        <ul class="footer__menu_list">
                                            <?php foreach ($item['children'] as $child) { ?>
                                                <li class="footer__menu_item">
                                                    <a href="<?= $child->url ?>" class="footer__menu_link"><?= $child->title ?></a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                <?php
                            }
                            ?>
                                </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="footer__icons">
                        <ul class="footer__social">
                            <?php
                            $socials_media = get_field('socials_media', 'option');
                            if (is_array($socials_media) && !empty($socials_media)) {
                                foreach ($socials_media as $social) {
                                    $icon_id = $social['icon'];
                                    if (!empty($icon_id)) {
                                        $social_icon = wp_get_attachment_image($icon_id, 'full', false, array('loading' => 'lazy'));
                                    }
                                    $social_link = $social['url'];
                            ?>
                                    <li class="footer__social_item">
                                        <a href="<?php echo $social_link; ?>" class="footer__social_link">
                                            <?php
                                            if (!empty($social_icon)) {
                                                echo $social_icon;
                                            }
                                            ?>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                        <ul class="footer__payments">
                            <li class="footer__payments_item">
                                <img src="<?= home_url(); ?>/images/icons/footer-paypal.svg" alt="paypal">
                            </li>
                            <li class="footer__payments_item">
                                <img src="<?= home_url(); ?>/images/icons/footer-mastercard.svg" alt="mastercard">
                            </li>
                            <li class="footer__payments_item">
                                <img src="<?= home_url(); ?>/images/icons/footer-visa.svg" alt="visa">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer__copyright">
                    <p><a href="/privacy-policy">© 2024. All rights reserved.</a></p>
                    <a href="/privacy-policy">Політка конфіденційності</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $description = get_field('description'); ?>

<?php if ($description) { ?>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            descriptionAccordion(<?= $description['min-height'] ?>, <?= $description['min-height-mob'] ?>)
            console.log('descriptionAccordion')
        })
    </script>

<?php }; ?>

<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('html_element', {
            'sitekey': '6Lenrt4pAAAAABTEylEWEzBQk86LACrZfpo7HGMj'
        });
    };

    function recaptchaCallback() {
        const wpcf7Submit = document.querySelector('.wpcf7-submit');
        wpcf7Submit.classList.remove('disable');
        wpcf7Submit.removeAttribute('disabled');
    }
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
</script>

<?php wp_footer(); ?>

</body>

</html>