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
        <a href="<?= $item['parent']->url ?>" class="information-bar__link uppercase"><?= $item['parent']->title ?></a>
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
     <?php echo do_shortcode('[wpforms id="325" title="false"]')?>
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