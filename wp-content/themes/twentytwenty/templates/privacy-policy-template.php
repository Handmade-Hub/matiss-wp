<?php

/**
 * Template Name: Privacy Policy Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$privacy = get_field('privacy');
$result_array = get_information_menu_items();
?>

<script>
 console.log(<?php print_r(json_encode($privacy)) ?>)
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

<!-- privacy-policy -->
<section class="privacy-policy">
   <div class="privacy-policy__wrapper">
    <div class="container">
     <div class="privacy-policy__inner">
      <h4 class="privacy-policy__title text-center fw-500"><?= $privacy['title'] ?></h4>
      <p class="privacy-policy__subtitle fz-18 text-center"><?= $privacy['text'] ?></p>
      <div class="privacy-policy__content"><?= $privacy['content'] ?></div>
     </div>
    </div>
   </div>
</section>


<?php
get_footer();