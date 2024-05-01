<?php
/**
 * Simple product add to cart modal
 */

global $product;
?>

<section class="modal-order">
    <div class="modal-order__wrapper">
        <button class="modal-order__close mobile-none">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 36L36 12M12 12L36 36" stroke="black" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
            </svg>
        </button>
        <div class="modal-order__inner">
            <h4 class="modal-order__title">
                <?php echo __( 'Розрахунок вартості індивідуального замовлення: ', 'twentytwenty' ); ?>
            </h4>
            <button class="modal-order__close mobile-up-none">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 36L36 12M12 12L36 36" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                </svg>
            </button>
            <div class="hidden_cf7_form">
                <?php
                echo do_shortcode( '[contact-form-7 id="e9f15a2" title="Painting wall order"]' );
                ?>
            </div>
            <form class="modal-order__form">
                <div class="modal-order__block">
                    <div class="modal-order__case">
                        <div class="modal-order__field">
                            <input class="modal-order__form_input modal-order__form_input--required" type="text" name="name" placeholder="<?php echo __( 'Імʼя*', 'twentytwenty' ); ?>" id="name">
                            <label for="name"><?php echo __( 'Імʼя*', 'twentytwenty' ); ?></label>
                            <p class="modal-order__form_error"><?php echo __( 'Будь-ласка, введіть імʼя', 'twentytwenty' ); ?></p>
                        </div>
                        <div class="modal-order__field">
                            <input class="modal-order__form_input modal-order__form_input--required" type="text" name="name" placeholder="<?php echo __( 'Телефон*', 'twentytwenty' ); ?>" id="phone">
                            <label for="phone"><?php echo __( 'Телефон*', 'twentytwenty' ); ?></label>
                            <p class="modal-order__form_error"><?php echo __( 'Будь-ласка, введіть номер телефону', 'twentytwenty' ); ?></p>
                        </div>
                    </div>
                    <div class="modal-order__field">
                        <input class="modal-order__form_input" type="text" name="name" placeholder="<?php echo __( 'Email', 'twentytwenty' ); ?>" id="email">
                        <label for="email"><?php echo __( 'Email', 'twentytwenty' ); ?></label>
                        <p class="modal-order__form_error"><?php echo __( 'Будь-ласка, введіть правильний Email', 'twentytwenty' ); ?></p>
                    </div>
                    <div class="modal-order__field">
                        <textarea placeholder="<?php echo __( 'Повідомлення', 'twentytwenty' ); ?>" name="message" id="message"></textarea>
                        <label for="message"><?php echo __( 'Повідомлення', 'twentytwenty' ); ?></label>
                    </div>
                </div>
                <div class="modal-order__add-file_result">
                    <ul class="modal-order__add-file_list">
                        <button type="button" class="modal-order__add-file_remove-all"><?php echo __( 'Очистити', 'twentytwenty' ); ?></button>
                    </ul>
                </div>
                <div class="modal-order__buttons">
                    <div class="modal-order__add-file">
                        <label for="file"><?php echo __( 'прикріпити файл', 'twentytwenty' ); ?></label>
                        <input class="modal-order__add-file_button" type="file" name="file" id="file"
                               data-multiple-caption="{count} files selected" accept="image/*" multiple />
                        <p><?php echo __( '(Не більше 2МБ)', 'twentytwenty' ); ?></p>
                    </div>
                    <input type="submit" class="modal-order__submit button__primary" value="<?php echo __( 'надіслати', 'twentytwenty' ); ?>">
                </div>
                <div class="modal-order-form-response"></div>
            </form>
        </div>
    </div>
</section>
