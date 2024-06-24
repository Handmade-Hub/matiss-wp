<?php

/**
 * Template Name: Partners Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$partners = get_field('partners');
$newsletter = get_field('newsletter');
$shortcode_subscribe_form = $newsletter['shortcode_form'];
$result_array = get_information_menu_items();
?>

<script>
 console.log(<?php print_r(json_encode($newsletter)) ?>)
</script>

<!-- information-bar -->
<section class="information-bar">
 <div class="information-bar__wrapper bg-gray">
  <div class="container">
   <div class="information-bar__inner">
    <nav class="information-bar__navigation">
     <ul class="information-bar__list">
      <?php foreach ($result_array as $item) { ?>
       <li class="information-bar__item <?php echo is_menu_item_active($item) ? 'active' : ''; ?>">
           <span class="information-bar__link uppercase"><?= $item['parent']->title ?></span>
           <a href="<?= $item['parent']->url ?>" aria-label="<?= $item['parent']->title ?>"></a>
       </li>
      <?php } ?>
     </ul>
    </nav>
   </div>
  </div>
 </div>
</section>

<!-- partners -->
<section class="partners">
 <div class="partners__wrapper">
  <div class="container">
   <div class="partners__inner">
    <ul class="partners__list">
     <?php foreach ($partners as $partner) { ?>
      <li class="partners__item">
       <div class="partners__item_image">
        <img src="<?= $partner['image']['url'] ?>" alt="<?= $partner['image']['alt'] ?>">
       </div>
       <div class="partners__item_content">
        <h2 class="partners__item_title open-sans fz-22 fw-600"><?= $partner['name'] ?></h2>
        <p class="partners__item_text fz-18"><?= $partner['description'] ?></p>
        <a href="<?= $partner['button_url']['url'] ?>" class="partners__item_link"><?= $partner['button_label'] ?></a>
       </div>
      </li>
     <?php } ?>
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
                    <h4 class="newsletter__title text-center fw-500"><?= $newsletter['title'] ?></h4>
                    <p class="newsletter__text text-center fz-18"><?= $newsletter['text'] ?></p>
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