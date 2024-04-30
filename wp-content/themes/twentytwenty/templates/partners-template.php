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
$result_array = get_information_menu_items();
?>



<script>
 console.log(<?php print_r(json_encode($partners)) ?>)
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

<?php
get_footer();