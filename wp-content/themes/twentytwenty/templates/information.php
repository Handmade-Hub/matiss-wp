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

$text_block = get_field('text-block');
$result_array = get_information_menu_items();
?>

<script>
 console.log(<?php print_r(json_encode($text_block)) ?>)
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

<!-- text-block -->
<section class="text-block">
   <div class="text-block__wrapper bg-gray">
    <div class="container">
     <div class="text-block__inner">
      <div class="text-block__image tablet-none">
       <img src="images/information/one.png" alt="image">
      </div>
      <div class="text-block__content">
       <h4><?= $text_block['title'] ?></h4>
       <?= $text_block['text'] ?>
       <p>Наш каталог налічує понад 300 варіантів авторських інтер'єрних картин. Трендові роботи завжди можна знайти в
        наявності в декількох розмірах. Всі вони представлені в наших салонах та знаходяться на експозиції у партнерів.
       </p>
       <p>Близько 80% картин ми робимо саме на замовлення, виконуючи авторську копію в потрібному вам розмірі саме під
        ваш інтер'єр. І щоразу клієнти залишаються задоволені результатом, оскільки ніхто краще за нас не створить копію
        наших робіт. Отже, якщо необхідної вам картини або розміру немає в наявності, ми виготовимо її за короткий
        термін.</p>
       <p>Оскільки у нас працює велика команда художників, зазвичай термін складає всього 5-8 робочих днів, залежно від
        розміру полотна. Для цього лише потрібно повідомити дизайнеру побажання стосовно картини та розміру, та вже
        зовсім скоро ваш дім прикрашатиме неймовірний витвір мистецтва від наших художників.</p>
      </div>
     </div>
    </div>
    <div class="text-block__image tablet-up-none">
     <img src="images/information/one.png" alt="image">
    </div>
   </div>
</section>

<?php
get_footer();