<?php

/**
 * Template Name: Our Team Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$members = get_field('members');
$result_array = get_information_menu_items();
?>



<script>
 console.log(<?php print_r(json_encode($members)) ?>)
</script>

<!-- information-bar -->
<section class="information-bar">
 <div class="information-bar__wrapper bg-gray">
  <div class="container">
   <div class="information-bar__inner">
    <nav class="information-bar__navigation">
     <ul class="information-bar__list">
      <?php foreach ($result_array as $item) { ?>
       <li class="information-bar__item">
        <a href="<?= $item['parent']->url ?>" class="information-bar__link uppercase"><?= $item['parent']->title ?></a>
       </li>
      <?php } ?>
     </ul>
    </nav>
   </div>
  </div>
 </div>
</section>

<!-- our-team -->
<section class="our-team">
 <div class="our-team__wrapper">
  <div class="container">
   <div class="our-team__inner">
    <ul class="our-team__list">

     <?php foreach ($members as $member) { ?>
      <li class="our-team__item">
       <div class="our-team__image">
        <img src="<?= $member['image'] ?>" alt="<?= $member['image']['alt'] ?>">
       </div>
       <p class="our-team__name fw-600 text-center fz-22"><?= $member['name'] ?></p>
       <p class="our-team__job text-center fz-18"><?= $member['position'] ?></p>
       <p class="our-team__experience text-center"><?= $member['skills'] ?></p>
      </li>
     <?php } ?>

    </ul>
   </div>
  </div>
 </div>
</section>

<?php
get_footer();