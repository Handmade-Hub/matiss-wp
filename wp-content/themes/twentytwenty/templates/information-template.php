<?php

/**
 * Template Name: Information Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$text_block = get_field('text-block');
$information_work = get_field('information_work');
$text_block_second = get_field('text-block-second');
$faq = get_field('faq');
$result_array = get_information_menu_items();
?>


<script>
 console.log(<?php print_r(json_encode($faq)) ?>)
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

<!-- text-block -->
<section class="text-block">
   <div class="text-block__wrapper bg-gray">
    <div class="container">
     <div class="text-block__inner">
      <div class="text-block__image tablet-none">
      <img src="<?= $text_block['image']['url'] ?>" alt="<?= $text_block['image']['alt'] ?>">
      </div>
      <div class="text-block__content">
       <h4><?= $text_block['title'] ?></h4>
       <?= $text_block['text'] ?>
      </div>
     </div>
    </div>
    <div class="text-block__image tablet-up-none">
     <img src="<?= $text_block['image']['url'] ?>" alt="<?= $text_block['image']['alt'] ?>">
    </div>
   </div>
</section>

<!-- work -->
<section class="work work--second">
   <div class="work__wrapper space-sections">
    <div class="container">
     <div class="work__inner">
      <h3 class="work__title text-center fw-500"><?= $information_work['title'] ?></h3>
      <div class="work__content">
       <div class="work__images">
        <div class="work__image"><img src="<?= $information_work['image-one']['url'] ?>" alt="<?= $information_work['image-one']['alt'] ?>"></div>
        <div class="work__image"><img src="<?= $information_work['image-two']['url'] ?>" alt="<?= $information_work['image-two']['alt'] ?>"></div>
       </div>
       <ul class="work__list">
       <?php
       $counter_items = 1;
       foreach ($information_work['works_items'] as $item) { ?>
          <li class="work__item">
           <div class="work__item_content">
            <div class="work__item_number fw-500 text-center"><?= $counter_items ?></div>
            <div class="work__item_case">
             <h6 class="work__item_title fw-500"><?= $item['title'] ?></h6>
             <p class="work__item_text"><?= $item['text'] ?></p>
            </div>
           </div>
          </li>
         <?php
         $counter_items++;
       } ?>
       </ul>
      </div>
     </div>
    </div>
   </div>
</section>

<!-- text-block -->
<section class="text-block text-block--reverse">
   <div class="text-block__wrapper bg-gray">
    <div class="container">
     <div class="text-block__inner">
      <div class="text-block__image tablet-none">
      <img src="<?= $text_block_second['image']['url'] ?>" alt="<?= $text_block_second['image']['alt'] ?>">
      </div>
      <div class="text-block__content">
       <h4><?= $text_block_second['title'] ?></h4>
       <?= $text_block_second['text'] ?>
      </div>
     </div>
    </div>
    <div class="text-block__image tablet-up-none">
     <img src="<?= $text_block_second['image']['url'] ?>" alt="<?= $text_block_second['image']['alt'] ?>">
    </div>
   </div>
</section>

 <!-- faq -->
 <section class="faq">
   <div class="faq__wrapper">
    <div class="container">
     <div class="faq__inner">
      <div class="faq__content">
       <h4 class="faq__title"><?= $faq['title'] ?></h4>
       <ul class="faq__list">
       <?php foreach ($faq['items'] as $item) { ?>
        <li class="faq__item">
         <h6><?= $item['title'] ?></h6>
         <?= $item['text'] ?>
        </li>
       <?php } ?>
       </ul>
      </div>
      <div class="faq__images">
       <img src="<?= $faq['image-one']['url'] ?>" alt="<?= $faq['image-one']['alt'] ?>">
       <img src="<?= $faq['image-two']['url'] ?>" alt="<?= $faq['image-two']['alt'] ?>">
      </div>
     </div>
    </div>
   </div>
  </section>

<?php
get_footer();