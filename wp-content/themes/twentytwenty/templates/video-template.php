<?php

/**
 * Template Name: Videos Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$videos = get_field('videos');
$result_array = get_information_menu_items();
?>

<script>
 console.log(<?php print_r(json_encode($videos)) ?>)
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

  <!-- videos -->
  <section class="videos">
   <div class="videos__wrapper">
    <div class="container">
     <div class="videos__inner">
      <ul class="videos__list">
       <?php foreach($videos as $video) { ?>
        <li class="videos__item">
        <h4 class="videos__item_title text-center"><?= $video['title']?></h4>
        <p class="videos__item_subtitle text-center fz-18"><?= $video['text']?> </p>
        <div class="videos__item_video">
         <iframe src="<?= $video['video_url'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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