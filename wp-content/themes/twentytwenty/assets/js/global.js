document.addEventListener('DOMContentLoaded', function () {
  const screenWidth = window.screen.width;
  const body = document.body;

  // header drop-down
  if (document.querySelectorAll('.header__drop-down').length) {
    const dropDown = document.querySelectorAll('.header__drop-down');

    dropDown.forEach(e => {
      const menu = e.querySelector('.header__drop-down_list');
      e.addEventListener('mouseover', () => {
        e.classList.add('active');
        menu.classList.add('active');
        menu.style.maxHeight = menu.scrollHeight + 'px';
      })
      e.addEventListener('mouseout', () => {
        e.classList.remove('active')
        menu.classList.remove('active')
        menu.style.maxHeight = null;
      })
    });
  }

  // burger menu
  if (document.querySelectorAll('.header-mobile__wrapper').length) {
    const button = document.querySelector('.header__burger');
    const menu = document.querySelector('.header-mobile__wrapper');
    const close = document.querySelector('.header-mobile__close');

    button.addEventListener('click', () => {
      menu.classList.add('menu-open');
      body.classList.add('menu-open');
    })
    close.addEventListener('click', () => {
      menu.classList.remove('menu-open');
      body.classList.remove('menu-open');
    })
  }

  // mobile drop-down
  if (document.querySelectorAll('.header-mobile__drop-down_list').length) {
    const dropDown = document.querySelectorAll('.header-mobile__drop-down');

    dropDown.forEach(item => {
      const button = item.querySelector('.header-mobile__menu_link.with-arrow');
      const list = item.querySelector('.header-mobile__drop-down_list')
      item.addEventListener('click', evt => {
        if (evt.target == button) {
          item.classList.toggle('active');
          item.classList.contains('active') ? list.style.maxHeight = list.scrollHeight + 'px' : list.style.maxHeight = null;
        }
      })
    });
  }

  // header localization
  if (document.querySelectorAll('.header__localization').length) {
    const buttons = document.querySelectorAll('.header__localization_button');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        if (!button.classList.contains('active')) {
          buttons.forEach(item => {
            item.classList.remove('active')
          });
          button.classList.add('active');
        }
      })
    })
  }

  //  search modal
  if (document.querySelectorAll('.header__search').length && document.querySelectorAll('.search-modal__wrapper').length) {
    const buttons = document.querySelectorAll('.header__search');
    const modal = document.querySelector('.search-modal__wrapper');
    const modalField = document.querySelector('.search-modal__field input');
    const buttonClose = document.querySelector('.search-modal__button_close');
    let activeClickOutside = false;
    let modalActive = false;

    buttons.forEach(button => {
      button.addEventListener('click', function () {
        modal.classList.add('open');
        body.classList.add('menu-open');
        modalField.focus();

        setTimeout(function (){
          modalActive = true;
        },100)

        // outside click listener
        if (!activeClickOutside) {
          setTimeout(function (){
            document.addEventListener('click', handleClickOutside);
            activeClickOutside = true;
          }, 100)
        }
      })
    })
    buttonClose.addEventListener('click', function () {
      modal.classList.remove('open');
      body.classList.remove('menu-open');
      modalActive = false;
    })

    modalField.addEventListener('input', function(event) {
      const searchResult = jQuery('.search-modal__list');
      let query = event.target.value;

      if (query.length < 2) {
        searchResult.empty();
        return;
      }

      // get search result
      jQuery.ajax({
        url: wc_add_to_cart_params.ajax_url,
        type: 'POST',
        data: {
          action: 'get_search_suggestions',
          query: query
        },
        success: function(response) {
          searchResult.html(response);
        }
      });
    });

    function handleClickOutside(event) {
      const element = modal;
      if (!element.contains(event.target) && modalActive) {
        modal.classList.remove('open');
        body.classList.remove('menu-open');
        modalActive = false;

        console.log('handleClickOutside')
      }
    }
  }

  const openEnterEvent = () => {
    const searchModalField = document.querySelector('.search-modal__field');
    const searchInput = searchModalField.querySelector('input');
    searchInput.addEventListener('keyup', evt => {
      const key = evt.key;

      if (key != 'Enter') return;

      submitSearch();
    })
  }

  openEnterEvent();

  //  cart modal
  if (document.querySelectorAll('.cart-modal').length && document.querySelectorAll('.header__cart').length) {
    const buttonOpen = document.querySelectorAll('.header__cart');
    const modal = document.querySelector('.cart-modal');
    const buttonClose = document.querySelector('.cart-modal__close');

    document.addEventListener('click', e => {
      if (e.target == modal && modal.classList.contains('open')) {
        modal.classList.remove('open');
        body.classList.remove('menu-open');
      }
    })

    // show and hide cart
    buttonOpen.forEach(button => {
      button.addEventListener('click', function () {
        modal.classList.add('open');
        body.classList.add('menu-open');
        getCart();
      })
    })
    buttonClose.addEventListener('click', function () {
      modal.classList.remove('open');
      body.classList.remove('menu-open');
    })

    // set quantity
    function setQuantityListener() {
      const cartItems = document.querySelectorAll('.cart-modal__item');
      cartItems.forEach(cartItem => {
        const buttonPlus = cartItem.querySelector('.cart-modal__quantity_plus');
        const buttonMinus = cartItem.querySelector('.cart-modal__quantity_minus');
        const input = cartItem.querySelector('.cart-modal__quantity_input');

        if (input.value == 99) buttonPlus.classList.add('disabled');
        if (input.value == 1) buttonMinus.classList.add('disabled');

        input.addEventListener('change', function () {
          let id = input.closest('.cart-modal__item').dataset.id;
          let quantity = input.value;

          if (input.value >= 99) {
            buttonPlus.classList.add('disabled');
            if (buttonMinus.classList.contains('disabled')) buttonMinus.classList.remove('disabled');

          }
          if (input.value <= 1) {
            buttonMinus.classList.add('disabled');
            if (buttonPlus.classList.contains('disabled')) buttonPlus.classList.remove('disabled');
          }
          if (input.value < 1) input.value = 1;
          if (input.value > 99) input.value = 99;


          changeQuantity(id, quantity);
        })

        buttonPlus.addEventListener('click', function () {
          if (input.value < 99) input.value = ++input.value;
          if (input.value == 99) buttonPlus.classList.add('disabled')
          if (input.value > 1 && buttonMinus.classList.contains('disabled')) buttonMinus.classList.remove('disabled');
          input.dispatchEvent(new Event('change'));
        })
        buttonMinus.addEventListener('click', function () {

          if (input.value > 1) input.value = --input.value;
          if (input.value == 1) buttonMinus.classList.add('disabled')
          if (input.value < 99 && buttonPlus.classList.contains('disabled')) buttonPlus.classList.remove('disabled');
          input.dispatchEvent(new Event('change'));
        })
      })
    }

    // remove cart item
    function setRemoveListener() {
      const cartItems = document.querySelectorAll('.cart-modal__item');
      cartItems.forEach(cartItem => {
        const buttonRemove = cartItem.querySelector('.cart-modal__item_remove');

        buttonRemove.addEventListener('click', function () {
          let id = buttonRemove.closest('.cart-modal__item').dataset.id;
          removeCartItem(id);
        })
      })
    }

    function getCart() {
      const cartIcon = document.querySelectorAll('.header__cart');

      jQuery.ajax({
        type: 'GET',
        url: wc_add_to_cart_params.ajax_url,
        data: {
          'action': 'get_cart_drawer'
        },
        success: function (response) {
          let data = JSON.parse(response);
          jQuery('.cart-modal .cart-modal__list').html(data['rendered_items']);
          jQuery('.cart-modal .total_price_value').html(data['total_price']);
          jQuery('.cart-modal .subtotal_price_value').html(data['total_saving']);
          jQuery('.cart-modal .discount_price_value').html(data['total_discounted_price']);
          jQuery('.cart-modal .cart-modal__count span').html(data['cart_count']);

          setQuantityListener();
          setRemoveListener();

          if (data['cart_count'] > 0) {
            cartIcon.forEach(icon => {
              icon.classList.add('not-empty');
            });
          }
        },
        error: function (error) {
          console.log('error: ', error);
        }
      });
    }

    function changeQuantity(id, quantity) {
      jQuery.ajax({
        type: 'POST',
        url: wc_add_to_cart_params.ajax_url,
        data: {
          'action': 'update_cart_quantity',
          'quantity': quantity,
          'id': id
        },
        success: function (response) {
          getCart();
          setQuantityListener();
          setRemoveListener();
        },
        error: function (error) {
          console.log('error: ', error);
        }
      });
    }

    function removeCartItem(id) {
      jQuery.ajax({
        type: 'POST',
        url: wc_add_to_cart_params.ajax_url,
        data: {
          'action': 'remove_cart_item',
          'id': id
        },
        success: function (response) {
          getCart();
          setQuantityListener();
          setRemoveListener();
        },
        error: function (error) {
          console.log('error: ', error);
        }
      });
    }
  }

  getCart();

  // banner swiper
  if (document.querySelectorAll('.banner__swiper').length) {
    const swiper = new Swiper('.banner__swiper', {
      speed: 1000,
      autoplay: {
        delay: 5000,
        pauseOnMouseEnter: true
      },
      pagination: {
        el: '.banner__swiper-pagination',
        clickable: true
      },
    });
  }

  // new-collection swiper
  if (document.querySelectorAll('.new-collection__swiper').length) {
    const swiper = new Swiper('.new-collection__swiper', {
      speed: 1000,
      spaceBetween: 32,
      slidesPerView: 1,
      slidesPerGroup: 1,
      breakpoints: {
        576: {
          slidesPerView: 2,
          slidesPerGroup: 2
        },
        992: {
          slidesPerView: 3,
          slidesPerGroup: 3
        }
      },
      navigation: {
        nextEl: '.new-collection__swiper-button-next',
        prevEl: '.new-collection__swiper-button-prev',
      },
      pagination: {
        el: '.new-collection__swiper-pagination',
      },
    });
  }

  // achievements numbers counts
  if (document.querySelectorAll('.achievements__list').length) {
    const wrapper = document.querySelector('.achievements');
    const items = document.querySelectorAll('.achievements__item_title span');

    // function counts
    function countItems() {
      items.forEach(item => {
        const number = item.textContent;
        let i = 0;

        if (number <= 100) {
          let counts = setInterval(function () {
            i++;
            i > number ? clearInterval(counts) : item.innerText = i;
          }, 20);
        } else if (number <= 1000) {
          let counts = setInterval(function () {
            i++;
            i > number ? clearInterval(counts) : item.innerText = i;
          }, 1);
        } else {
          let counts = setInterval(function () {
            i += 8;
            i > number ? clearInterval(counts) : item.innerText = i;
          }, 1);
        }
      })
    }

    // start function on scroll
    let scrollPage = setInterval(function () {
      const offset = wrapper.offsetTop;
      let scrollDistance = window.scrollY;
      let topDistance, bottomDistance;
      if (screenWidth >= 768) {
        topDistance = 350;
        bottomDistance = -650;
      } else {
        topDistance = 600;
        bottomDistance = -500;
      }
      if (offset - scrollDistance <= topDistance && offset - scrollDistance > 0) {
        countItems();
        clearInterval(scrollPage);
      } else if ((offset - scrollDistance >= bottomDistance && offset - scrollDistance < 0)) {
        countItems();
        clearInterval(scrollPage);
      }
    }, 10);
  }

  // goal swiper
  if (document.querySelectorAll('.goal__swiper').length) {
    const swiper = new Swiper('.goal__swiper', {
      speed: 1000,
      navigation: {
        nextEl: '.goal__swiper-button-next',
        prevEl: '.goal__swiper-button-prev',
      },
      pagination: {
        el: '.goal__swiper-pagination',
        clickable: true,
      },
    });
  }

  // clients swiper
  if (document.querySelectorAll('.clients__swiper').length) {
    const swiper = new Swiper('.clients__swiper', {
      speed: 1000,
      loop: true,
      spaceBetween: 48,
      slidesPerView: 2.6,
      speed: 3000,
      autoplay: {
        delay: 0,
      },
      breakpoints: {
        575: {
          slidesPerView: 4,
        },
        768: {
          slidesPerView: 5,
          spaceBetween: 30,
        },
        992: {
          slidesPerView: 6,
          spaceBetween: 60,
        },
        1200: {
          slidesPerView: 6.8,
        }
      }
    });
  }

  // map pins
  if (document.querySelectorAll('.map__dots').length) {
    const wrapper = document.querySelector('.map__dots');
    const items = wrapper.querySelectorAll('.map__dot');
    let m = 0;
    for (let i = 0; i < items.length; i++) {
      m = (i + 1) * 500;
      function addClass() {
        items[i].classList.add('active')
      }
      setInterval(addClass, m);
    }
  }

  // filters desktop
  if (document.querySelectorAll('.filters-desktop').length) {
    const filtersItems = document.querySelectorAll('.filters__item');
    const choosedBlock = document.querySelector('.filters__choosed');
    const choosedList = document.querySelector('.filters__choosed_list');
    const clearButton = document.querySelector('.filters__choosed_clear');
    let arr = [];

    filtersItems.forEach(item => {
      const menu = item.querySelector('.filters__item_list');
      if (menu != null && menu != undefined) {
        // filters drop-down
        item.addEventListener('mouseover', () => {
          item.classList.add('active');
          menu.classList.add('active');
          menu.style.maxHeight = menu.scrollHeight + 'px';
        })
        item.addEventListener('mouseout', () => {
          item.classList.remove('active')
          menu.classList.remove('active')
          menu.style.maxHeight = null;
        })
        // filters choose
        if (menu.querySelectorAll('.filters__item_option').length) {
          const options = menu.querySelectorAll('.filters__item_option');
          options.forEach(option => {
            // add choosed item
            option.addEventListener('click', function () {
              if (!arr.includes(option.textContent)) {
                arr.push(option.textContent);
                if (choosedBlock.classList.contains('empty')) choosedBlock.classList.remove('empty');
                let li = document.createElement('li');
                li.classList.add('filters__choosed_item');
                li.innerHTML = `
         <span>${option.textContent}</span>
         <button></button>
         `
                choosedList.appendChild(li);
                // remove item
                const closeButton = li.querySelector('button');
                closeButton.addEventListener('click', function () {
                  li.remove();
                  if (!choosedList.querySelectorAll('li').length) choosedBlock.classList.add('empty');
                  arr = arr.filter(function (m) {
                    return m != li.querySelector('span').textContent;
                  })
                })
              }
            })
          })
        }
        // clear all choosed filters
        clearButton.addEventListener('click', function () {
          arr = [];
          choosedBlock.classList.add('empty');
          const choosedItem = choosedList.querySelectorAll('li');
          choosedItem.forEach(element => {
            element.remove();
          })
        })
      }
    })
    // filter price range
    if (document.querySelectorAll('.filters__item_list--range').length) {
      const rangeWrapper = document.querySelector('.filters__item_list--range');
      const fromSlider = rangeWrapper.querySelector('#fromSlider');
      const toSlider = rangeWrapper.querySelector('#toSlider');
      const fieldMin = rangeWrapper.querySelector('.filters__item_min');
      const fieldMax = rangeWrapper.querySelector('.filters__item_max');
      const submitButton = rangeWrapper.querySelector('.filters__item_case > button');
      let priceValue, lastPrice;

      // update page
      fieldMin.textContent = fromSlider.value;
      fieldMax.textContent = toSlider.value;

      // change value
      function controlFromSlider(fromSlider, toSlider) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#ffffff', '#000000', toSlider);
        if (from > to) {
          fromSlider.value = to;
          fieldMax.textContent = to;
        } else {
          fromSlider.value = from;
          fieldMin.textContent = from;
        }
      }

      function controlToSlider(fromSlider, toSlider) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#ffffff', '#000000', toSlider);
        setToggleAccessible(toSlider);
        if (from <= to) {
          toSlider.value = to;
          fieldMax.textContent = to;
        } else {
          toSlider.value = from;
          fieldMin.textContent = from;
        }
      }

      function getParsed(currentFrom, currentTo) {
        const from = parseInt(currentFrom.value, 10);
        const to = parseInt(currentTo.value, 10);
        return [from, to];
      }

      function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
        const rangeDistance = to.max - to.min;
        const fromPosition = from.value - to.min;
        const toPosition = to.value - to.min;
        controlSlider.style.background = `linear-gradient(
     to right,
     ${sliderColor} 0%,
     ${sliderColor} ${(fromPosition) / (rangeDistance) * 100}%,
     ${rangeColor} ${((fromPosition) / (rangeDistance)) * 100}%,
     ${rangeColor} ${(toPosition) / (rangeDistance) * 100}%, 
     ${sliderColor} ${(toPosition) / (rangeDistance) * 100}%, 
     ${sliderColor} 100%)`;
      }

      function setToggleAccessible(currentTarget) {
        const toSlider = document.querySelector('#toSlider');
        if (Number(currentTarget.value) <= 0) {
          toSlider.style.zIndex = 2;
        } else {
          toSlider.style.zIndex = 0;
        }
      }

      fillSlider(fromSlider, toSlider, '#ffffff', '#000000', toSlider);
      setToggleAccessible(toSlider);
      fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider);
      toSlider.oninput = () => controlToSlider(fromSlider, toSlider);

      // submit button
      submitButton.addEventListener('click', function () {
        // update price
        priceValue = `$${fromSlider.value} - $${toSlider.value}`;
        // not price in array
        if (!arr.includes('thereIsPrice')) {
          arr.push('thereIsPrice');
          arr.push(priceValue);
          lastPrice = priceValue;
          if (choosedBlock.classList.contains('empty')) choosedBlock.classList.remove('empty');
          let li = document.createElement('li');
          li.classList.add('filters__choosed_item', 'filters__choosed_item--price');
          li.innerHTML =
            `<span>${priceValue}</span>
       <button></button>`
          choosedList.appendChild(li);

          // remove item
          const closeButton = li.querySelector('button');
          closeButton.addEventListener('click', function () {
            li.remove();
            arr = arr.filter(function (c) {
              return c != 'thereIsPrice';
            });
            arr = arr.filter(function (m) {
              return m != lastPrice;
            });
            if (!choosedList.querySelectorAll('li').length) choosedBlock.classList.add('empty');
          })
          // there is price but different
        } else if (priceValue != lastPrice) {
          let price = document.querySelector('.filters__choosed_item--price > span');
          price.textContent = priceValue;
          arr.push(priceValue);
          arr = arr.filter(function (m) {
            return m != lastPrice;
          });
          lastPrice = priceValue;
        }
      })
    }
  }

  // filters mobile
  if (document.querySelectorAll('.filters-mobile').length) {
    const filter = document.querySelector('.filters-mobile__wrapper');
    const list = document.querySelectorAll('.filters-mobile__sublist_item');
    const openButton = document.querySelector('.filters__item_trigger');
    const closeButton = document.querySelector('.filters-mobile__close');
    const submitButton = document.querySelector('.filters-mobile__buttons_submit');
    const removeButton = document.querySelector('.filters-mobile__buttons_remove');
    const choosedBlock = document.querySelector('.filters__choosed');
    const choosedList = document.querySelector('.filters__choosed_list');
    const clearButton = document.querySelector('.filters__choosed_clear');
    let priceField = document.querySelector('.filters__choosed_item--price span');
    let arr = [];

    // open & close filter menu
    openButton.addEventListener('click', function () {
      filter.classList.add('open');
      body.classList.add('menu-open');
    })
    closeButton.addEventListener('click', function () {
      filter.classList.remove('open');
      body.classList.remove('menu-open');
    })

    // choose item
    list.forEach(item => {
      item.addEventListener('click', function () {
        if (!item.classList.contains('choosed')) {
          item.classList.add('choosed');
          arr.push(item.textContent);
        } else {
          item.classList.remove('choosed');
          arr = arr.filter(function (m) {
            return m != item.textContent;
          });
        }
      })
    })

    // remove choose items
    removeButton.addEventListener('click', function () {
      arr = [];
      choosedBlock.classList.add('empty');
      const choosedItem = choosedList.querySelectorAll('li');
      choosedItem.forEach(element => {
        element.remove();
      })
      list.forEach(item => {
        if (item.classList.contains('choosed')) item.classList.remove('choosed');
      })
    })

    // filter price range
    if (document.querySelectorAll('.filters-mobile__item--range').length) {
      const rangeWrapper = document.querySelector('.filters-mobile__item--range');
      const fromSlider = rangeWrapper.querySelector('#fromMobileSlider');
      const toSlider = rangeWrapper.querySelector('#toMobileSlider');
      const fieldMin = rangeWrapper.querySelector('.filters-mobile__item_min');
      const fieldMax = rangeWrapper.querySelector('.filters-mobile__item_max');
      let priceValue, lastPrice;

      // update page
      fieldMin.textContent = fromSlider.value;
      fieldMax.textContent = toSlider.value;

      // change value
      function controlFromSlider(fromSlider, toSlider) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#ffffff', '#000000', toSlider);
        if (from > to) {
          fromSlider.value = to;
          fieldMax.textContent = to;
        } else {
          fromSlider.value = from;
          fieldMin.textContent = from;
        }
      }

      function controlToSlider(fromSlider, toSlider) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#ffffff', '#000000', toSlider);
        setToggleAccessible(toSlider);
        if (from <= to) {
          toSlider.value = to;
          fieldMax.textContent = to;
        } else {
          toSlider.value = from;
          fieldMin.textContent = from;
        }
      }

      function getParsed(currentFrom, currentTo) {
        const from = parseInt(currentFrom.value, 10);
        const to = parseInt(currentTo.value, 10);
        return [from, to];
      }

      function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
        const rangeDistance = to.max - to.min;
        const fromPosition = from.value - to.min;
        const toPosition = to.value - to.min;
        controlSlider.style.background = `linear-gradient(
      to right,
      ${sliderColor} 0%,
      ${sliderColor} ${(fromPosition) / (rangeDistance) * 100}%,
      ${rangeColor} ${((fromPosition) / (rangeDistance)) * 100}%,
      ${rangeColor} ${(toPosition) / (rangeDistance) * 100}%, 
      ${sliderColor} ${(toPosition) / (rangeDistance) * 100}%, 
      ${sliderColor} 100%)`;
      }

      function setToggleAccessible(currentTarget) {
        const toSlider = document.querySelector('#toSlider');

        if (!toSlider) {
          return;
        }

        if (Number(currentTarget.value) <= 0) {
          toSlider.style.zIndex = 2;
        } else {
          toSlider.style.zIndex = 0;
        }
      }

      fillSlider(fromSlider, toSlider, '#ffffff', '#000000', toSlider);
      setToggleAccessible(toSlider);
      fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider);
      toSlider.oninput = () => controlToSlider(fromSlider, toSlider);

      // submit button
      submitButton.addEventListener('click', function () {
        if (choosedBlock.classList.contains('empty')) choosedBlock.classList.remove('empty');
        filter.classList.remove('open');
        body.classList.remove('menu-open');
        // update price
        priceValue = `$${fromSlider.value} - $${toSlider.value}`;
        priceField = priceValue;
        // not price in array
        if (!arr.includes('thereIsPrice')) {
          arr.push('thereIsPrice');
          arr.push(priceValue);
          lastPrice = priceValue;
          if (choosedBlock.classList.contains('empty')) choosedBlock.classList.remove('empty');
          let li = document.createElement('li');
          li.classList.add('filters__choosed_item', 'filters__choosed_item--price');
          li.innerHTML =
            `<span>${priceValue}</span>
       <button></button>`
          choosedList.appendChild(li);
          // remove item
          const closeButton = li.querySelector('button');
          closeButton.addEventListener('click', function () {
            li.remove();
            arr = arr.filter(function (c) {
              return c != 'thereIsPrice';
            });
            arr = arr.filter(function (m) {
              return m != lastPrice;
            });
            if (!choosedList.querySelectorAll('li').length) choosedBlock.classList.add('empty');
          })
          // there is price but different
        } else if (priceValue != lastPrice) {
          let price = document.querySelector('.filters__choosed_item--price > span');
          price.textContent = priceValue;
          arr.push(priceValue);
          arr = arr.filter(function (m) {
            return m != lastPrice;
          });
          lastPrice = priceValue;
        }
      })
    }

    // submit filters
    submitButton.addEventListener('click', function () {
      if (arr.length > 0) {
        if (choosedBlock.classList.contains('empty')) choosedBlock.classList.remove('empty');
        filter.classList.remove('open');
        body.classList.remove('menu-open');
        const choosedItem = choosedList.querySelectorAll('li');
        // remove choosed items
        choosedItem.forEach(element => {
          if (!element.classList.contains('filters__choosed_item--price')) element.remove();
        })
        // create choosed items
        for (let i = 0; i < arr.length; i++) {
          if (document.querySelectorAll('.filters-mobile__item--range').length) {
            if (priceField != null && priceField != arr[i]) {
              let li = document.createElement('li');
              li.classList.add('filters__choosed_item');
              li.innerHTML =
                `<span>${arr[i]}</span>
           <button></button>`
              choosedList.appendChild(li);
            }
          } else {
            let li = document.createElement('li');
            li.classList.add('filters__choosed_item');
            li.innerHTML =
              `<span>${arr[i]}</span>
           <button></button>`
            choosedList.appendChild(li);
          }
        }
        // remove item
        const choosedItems = document.querySelectorAll('.filters__choosed_item');
        choosedItems.forEach(choosedItem => {
          if (choosedItem.querySelector('span').textContent == 'thereIsPrice') choosedItem.remove();
          const removeItemButton = choosedItem.querySelector('button');
          removeItemButton.addEventListener('click', function () {
            choosedItem.remove();
            if (!choosedList.querySelectorAll('li').length) choosedBlock.classList.add('empty');
            arr = arr.filter(function (m) {
              return m != choosedItem.querySelector('span').textContent;
            });
            list.forEach(filterItem => {
              if (choosedItem.querySelector('span').textContent == filterItem.textContent && filterItem.classList.contains('choosed')) filterItem.classList.remove('choosed');
            })
          })
        })
      }
    })

    // clear all choosed filters
    clearButton.addEventListener('click', function () {
      arr = [];
      choosedBlock.classList.add('empty');
      const choosedItem = choosedList.querySelectorAll('li');
      choosedItem.forEach(element => {
        element.remove();
      })
      list.forEach(item => {
        if (item.classList.contains('choosed')) item.classList.remove('choosed');
      })
    })
  }

  // vilidation email\phone functions
  function validEmailAddress(email) {
    var filter =
      /^([\w-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return filter.test(email);
  }

  function validPhoneNumber(phoneNumber) {
    const phonePattern = /^\+?[0-9]{10,}$/;
    return phonePattern.test(phoneNumber);
  }

  // contact form error
  if (document.querySelectorAll('.contact-form').length) {
    const form = document.querySelector('.contact-form form.contact-form_mask');
    const requiredFields = form.querySelectorAll('.contact-form__field');
    const contactSubmit = form.querySelector('.contact-form__button');
    const nameInput = form.querySelector('.contact-form__field input[name="name"]');
    const phoneInput = form.querySelector('.contact-form__field input[name="phone"]');

    nameInput.addEventListener('input', function () {
      checkContactsInput();
    });

    phoneInput.addEventListener('input', function () {
      checkContactsInput();
    });

    function checkContactsInput() {
      if (nameInput.value !== '' && phoneInput.value !== '') {
        contactSubmit.classList.remove('disabled');
        contactSubmit.removeAttribute('disabled');
      } else {
        contactSubmit.classList.add('disabled');
        contactSubmit.setAttribute('disabled', true);
      }
    }

    form.addEventListener('submit', e => {
      e.preventDefault();
      let isValid = true;

      requiredFields.forEach(field => {
        const input = field.querySelector('input');
        if (input != null && input.value == '' && field.classList.contains('contact-form__field--required')) {
          field.classList.add('error');
          isValid = false;
        } else {
          field.classList.remove('error');
        }

        // validate email
        if (input != null && input.value !== '' && input.getAttribute('id') === 'email') {
          if (!validEmailAddress(input.value)) {
            field.classList.add('error');
            isValid = false;
          } else {
            field.classList.remove('error');
          }
        }

        // validate phone number
        if (input != null && input.value !== '' && input.getAttribute('id') === 'phone') {
          if (!validPhoneNumber(input.value)) {
            field.classList.add('error');
            isValid = false;
          } else {
            field.classList.remove('error');
          }
        }
      })

      let name = jQuery('.contact-form #name').val();
      let phone = jQuery('.contact-form #phone').val();
      let email = jQuery('.contact-form #email').val();
      let message = jQuery('.contact-form #message').val();

      if (isValid) {
        jQuery('.contact-form .wpcf7-form-control[name="your-name"]').val(name);
        jQuery('.contact-form .wpcf7-form-control[name="your-phone"]').val(phone);
        jQuery('.contact-form .wpcf7-form-control[name="your-email"]').val(email);
        jQuery('.contact-form .wpcf7-form-control[name="your-message"]').val(message);
        jQuery('.contact-form .wpcf7-submit').click();
      }
    })

    /// response observer
    const formResponseElement = document.querySelector('.contact-form .wpcf7-response-output');

    const formResponseObserver = new MutationObserver(function (mutationsList, observer) {
      let formResponseBlock = document.querySelector('.contact-form-response');
      formResponseBlock.innerHTML = formResponseElement.innerHTML;
    });

    formResponseObserver.observe(formResponseElement, { subtree: true, characterData: true, childList: true });
  }

  // newsletter form error
  if (document.querySelectorAll('.newsletter__form').length) {
    const form = document.querySelector('.newsletter__form form.newsletter_form_mask');
    const input = form.querySelector('.newsletter__form_input');
    const errorMessage = document.querySelector('.newsletter__form .contact-form__error');

    form.addEventListener('submit', e => {
      e.preventDefault();
      let isValid = true;

      // validate email
      if (input != null) {
        if (!validEmailAddress(input.value)) {
          errorMessage.classList.add('active');
          isValid = false;
        } else {
          errorMessage.classList.remove('active');
        }
      }

      let email = jQuery('.newsletter__form .newsletter__form_input').val();

      if (isValid) {
        jQuery('.newsletter__form .wpcf7-form-control[name="your-email"]').val(email);
        jQuery('.newsletter__form .wpcf7-submit').click();
      }
    })

    /// response observer
    const formResponseElement = document.querySelector('.newsletter__form .wpcf7-response-output');

    const formResponseObserver = new MutationObserver(function (mutationsList, observer) {
      let formResponseBlock = document.querySelector('.subscribe-form-response');
      formResponseBlock.innerHTML = formResponseElement.innerHTML;
    });

    formResponseObserver.observe(formResponseElement, { subtree: true, characterData: true, childList: true });
  }

  // featured-product swiper
  if (document.querySelectorAll('.featured-product__swiper').length) {
    const swiper = new Swiper('.featured-product__swiper', {
      speed: 1000,
      spaceBetween: 32,
      slidesPerView: 1,
      breakpoints: {
        576: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
        }
      },
      navigation: {
        nextEl: '.featured-product__swiper-button-next',
        prevEl: '.featured-product__swiper-button-prev',
      },
      pagination: {
        el: '.featured-product__swiper-pagination',
      },
    });
  }

  // mobile video listener

  if (document.querySelectorAll('.product__swiper .video_slide video').length) {
    const mobileVideo = document.querySelector('.product__swiper .video_slide video');
    const videoPlayButton = document.querySelector('.product__swiper .video_slide');

    videoPlayButton.addEventListener('click', () => {
      videoPlayButton.classList.add('play');
      mobileVideo.play();
    })
  }

  // tabs
  if (document.querySelectorAll('.tabs').length) {
    const barItems = document.querySelectorAll('.tabs__bar_item');
    const contentItems = document.querySelectorAll('.tabs__content_item');

    // add active first elements
    const barItemFirst = document.querySelector('.tabs__bar_item');
    const contentItemFirst = document.querySelector('.tabs__content_item');
    barItemFirst.classList.add('active');
    contentItemFirst.classList.add('active');

    // add data atributes
    for (let i = 0; i < barItems.length; i++) {
      barItems[i].setAttribute('data-bar', i);
    }
    for (let i = 0; i < contentItems.length; i++) {
      contentItems[i].setAttribute('data-content', i);
    }

    // change active tab
    barItems.forEach(item => {
      item.addEventListener('click', function () {
        barItems.forEach(m => {
          m.classList.remove('active');
        })
        const itemAttr = item.getAttribute('data-bar');
        for (let i = 0; i < contentItems.length; i++) {
          const contentAttr = contentItems[i].getAttribute('data-content');
          if (itemAttr == contentAttr) {
            item.classList.add('active');
            contentItems[i].classList.add('active');
          }
          else {
            contentItems[i].classList.remove('active');
          }
        }
      })
    })
  }

  // product popup and swiper
  if (document.querySelectorAll('.product').length) {
    // popup
    Fancybox.bind('[data-fancybox]', {
      Toolbar: {
        display: {
          left: [],
          middle: [],
          right: ["close"],
        },
      },
    });

    // swiper
    const swiper = new Swiper('.product__swiper', {
      speed: 1000,
      spaceBetween: 10,
      pagination: {
        el: '.product__swiper-pagination',
      },
    });
  }

  // product select
  if (document.querySelectorAll('.product__select').length) {
    const selectItems = document.querySelectorAll('.product__select');
    const buttonAdd = document.querySelector('.add-to-cart');

    selectItems.forEach(select => {
      const panel = select.querySelector('.product__select_panel');
      let spanValue = panel.querySelector('span');
      const list = select.querySelector('.product__select_list');
      const items = select.querySelectorAll('.product__select_item');
      const multiLists = select.querySelectorAll('.product__select_multi');
      // open - close select
      panel.addEventListener('click', () => {
        if (!panel.classList.contains('active')) {
          panel.classList.add('active');
          list.classList.add('active');
          list.style.maxHeight = list.scrollHeight + 'px';
        } else {
          panel.classList.remove('active');
          list.classList.remove('active');
          list.style.maxHeight = null;
        }
      })
      // close select
      document.addEventListener('click', e => {
        if (!select.contains(e.target)) {
          panel.classList.remove('active');
          list.classList.remove('active');
          list.style.maxHeight = null;
        }
      })
      // change selects value
      items.forEach(item => {
        item.addEventListener('click', function () {
          panel.setAttribute('data-content', item.innerText);
          panel.classList.remove('active');
          list.classList.remove('active');
          list.style.maxHeight = null;

          changeWcSelectValue(item); // change WC select
          if (spanValue.classList.contains('--default')) spanValue.classList.remove('--default');
          spanValue.innerText = item.innerText;
          spanValue.dataset.value = item.dataset.value;
          if (select.classList.contains('error')) select.classList.remove('error');
          if (buttonAdd.classList.contains('error')) buttonAdd.classList.remove('error');
          // check on multichoice for item
          if (item.classList.contains('multichoice')) {
            // check on double click for the active element
            if (!panel.classList.contains('multichoice')) {
              panel.classList.add('multichoice');
              panel.setAttribute('data-choised', null);
            }
          } else {
            panel.classList.remove('multichoice');
            panel.removeAttribute('data-choised');
            // clear class choised for item
            multiLists.forEach(multiList => {
              const multiItems = multiList.querySelectorAll('li');
              multiItems.forEach(multiItem => {
                if (multiItem.classList.contains('choised')) multiItem.classList.remove('choised');
              })
            })
          }
          // multichoice
          if (multiLists.length) {
            const itemAttr = item.getAttribute('data-type');
            multiLists.forEach(multiList => {
              const multiItems = multiList.querySelectorAll('li');
              // choise multi item
              multiList.addEventListener('click', e => {
                multiItems.forEach(multiItem => {
                  if (e.target == multiItem) {
                    multiItem.classList.add('choised');
                    panel.setAttribute('data-choised', multiItem.innerText);
                    changeWcSelectMultiValue(multiItem);
                    if (select.classList.contains('error')) select.classList.remove('error');
                    if (buttonAdd.classList.contains('error')) buttonAdd.classList.remove('error');
                  } else {
                    if (e.target != e.currentTarget) multiItem.classList.remove('choised');
                  }
                })
              })
              // add class choised for multi list
              multiList.classList.remove('choised');
              const multiListAttr = multiList.getAttribute('data-type');
              if (multiListAttr != null && multiListAttr == itemAttr) {
                multiList.classList.add('choised');
              }
            });
          }
        })
      })
      // selection check
      const buttons = document.querySelectorAll('.product__button');
      buttons.forEach(button => {
        button.addEventListener('click', e => {
          // check on selected
          if (spanValue.classList.contains('--default')) {
            e.preventDefault();
            select.classList.add('error');
            buttonAdd.classList.add('error');
          }
          // check on selected multichoce
          if (panel.classList.contains('multichoice') && panel.getAttribute('data-choised') == 'null') {
            e.preventDefault();
            select.classList.add('error');
            buttonAdd.classList.add('error');
          }
        })
      })
    })
    // change  woocommerce select
    function changeWcSelectValue(currentSelectedItem) {
      let itemValue = currentSelectedItem.dataset.value;
      let parentBlock = currentSelectedItem.closest('.product__select');
      let wcForm = currentSelectedItem.closest('.variations_form');
      let wcSelect = parentBlock.querySelector('.product_form_item select');
      wcSelect.value = itemValue;
      wcSelect.dispatchEvent(new Event('change'));
      wcForm.dispatchEvent(new Event('check_variations'));

      // if withot frame change color
      if (itemValue === 'Без рами') {
        let multiSelect = document.querySelector('.product_form_item_multi select');

        multiSelect.value = "Без кольору";
        multiSelect.dispatchEvent(new Event('change', { bubbles: true }));
        multiSelect.dispatchEvent(new Event('check_variations'));

        setTimeout(function () {
          if (wcSelect.value !== 'Без рами') {
            wcSelect.value = itemValue;
            wcSelect.dispatchEvent(new Event('change'));
            wcForm.dispatchEvent(new Event('check_variations'));
          }
        }, 200)
      }
    }
    // change woocommerce multiitem select
    function changeWcSelectMultiValue(currentSelectedItem) {
      let itemValue = currentSelectedItem.dataset.value;
      let parentBlock = currentSelectedItem.closest('.product__select');
      let wcForm = currentSelectedItem.closest('.variations_form');
      let wcSelect = parentBlock.querySelector('.product_form_item_multi select');
      wcSelect.value = itemValue;
      wcSelect.dispatchEvent(new Event('change'));
      wcForm.dispatchEvent(new Event('check_variations'));
    }
    // validation form
    function isformCanSubmitted() {
      let selectPanels = jQuery('.product__select_panel');

      let spans = selectPanels.find('span');
      let isCanSubmitted = true;

      selectPanels.each(function () {
        if (jQuery(this).hasClass('multichoice') && jQuery(this).attr('data-choised') == 'null') {
          isCanSubmitted = false;
        }
      })

      spans.each(function () {
        if (jQuery(this).hasClass('--default')) {
          isCanSubmitted = false;
        }
      })

      return isCanSubmitted;
    }

    const element = document.querySelector('.woocommerce-variation.single_variation');

    const priceObserver = new MutationObserver(function (mutationsList, observer) {
      let mainPrice = document.querySelector('.product__content .product__price');
      mainPrice.innerHTML = element.innerHTML;
    });

    priceObserver.observe(element, { subtree: true, characterData: true, childList: true });
  }

  // add to cart modal
  if (document.querySelectorAll('.add-to-cart').length && document.querySelectorAll('.modal-add-to-cart').length) {
    const button = document.querySelector('.add-to-cart');
    const modal = document.querySelector('.modal-add-to-cart');
    const buttonClose = document.querySelectorAll('.modal-add-to-cart__button_close');
    const cartIcon = document.querySelectorAll('.header__cart');
    // open modal
    function openModal() {
      // if (!button.classList.contains('error')) {
      modal.classList.add('open');
      body.classList.add('menu-open');
      cartIcon.forEach(icon => {
        icon.classList.add('not-empty');
      })
    }
    // }
    // close modal
    buttonClose.forEach(button => {
      button.addEventListener('click', () => {
        modal.classList.remove('open');
        body.classList.remove('menu-open');
      })
    })
    // change modal content
    function changeModalContent(data) {
      let quantity = 1;
      let price = data['price'];
      let variation = decodeUrlObject(data['variation']);
      let size, frame, cost;

      if (variation['attribute_розмір']) {
        size = variation['attribute_розмір'];
      }

      if (variation['attribute_рама']) {
        frame = variation['attribute_рама'].toLowerCase();
      }

      if (variation['attribute_колір-рами']) {
        if (variation['attribute_колір-рами'] !== 'Без кольору') {
          frame = variation['attribute_колір-рами'].toLowerCase() + ' ' + variation['attribute_рама'].split(' ')[0].toLowerCase();
        } else {
          frame = variation['attribute_рама'].toLowerCase();
        }
      }

      if (variation['attribute_вартість']) {
        cost = variation['attribute_вартість'];
      }

      // set content
      jQuery('.modal-add-to-cart .atribute_size_value').text(size);
      jQuery('.modal-add-to-cart .atribute_frame_value').text(frame);
      jQuery('.modal-add-to-cart .atribute_cost_value').text(cost);
      jQuery('.modal-add-to-cart .modal-add-to-cart__case_quantity_value').text(quantity);
      jQuery('.modal-add-to-cart .modal-add-to-cart__price_value').text(price);
    }
  }

  function decodeUrlObject(obj) {
    let decodedObject = {};
    for (let key in obj) {
      if (obj.hasOwnProperty(key)) {
        let decodedKey = decodeURIComponent(key);
        let decodedValue = decodeURIComponent(obj[key]);
        decodedObject[decodedKey] = decodedValue;
      }
    }
    return decodedObject;
  }

  // modal add to cart
  if (document.querySelectorAll('.modal-order').length && document.querySelectorAll('.product__button--modal-order').length) {
    const modal = document.querySelector('.modal-order');
    const form = modal.querySelector('.modal-order__form');
    const input = modal.querySelector('.modal-order__add-file input');
    const buttonOpen = document.querySelector('.product__button--modal-order');
    const buttonsClose = document.querySelectorAll('.modal-order__close');
    const buttonRemoveAll = document.querySelector('.modal-order__add-file_remove-all');
    const result = form.querySelector('.modal-order__add-file_result');
    const list = form.querySelector('.modal-order__add-file_list');
    const modalOrderSubmit = form.querySelector('.modal-order__submit');
    const nameInput = form.querySelector('.modal-order__form_input[name="name"]');
    const phoneInput = form.querySelector('.modal-order__form_input[name="phone"]');
    let arr = [];

    // open and hide modal
    buttonOpen.addEventListener('click', function () {
      modal.classList.add('open');
      body.classList.add('menu-open');
    });

    buttonsClose.forEach(buttonClose => {
      buttonClose.addEventListener('click', function () {
        modal.classList.remove('open');
        body.classList.remove('menu-open');
      })
    })

    nameInput.addEventListener('input', function () {
      checkModalOrderInput();
    });

    phoneInput.addEventListener('input', function () {
      checkModalOrderInput();
    });

    function checkModalOrderInput() {
      if (nameInput.value !== '' && phoneInput.value !== '') {
        modalOrderSubmit.classList.remove('disabled');
        modalOrderSubmit.removeAttribute('disabled');
      } else {
        modalOrderSubmit.classList.add('disabled');
        modalOrderSubmit.setAttribute('disabled', true);
      }
    }

    // submit form
    form.addEventListener('submit', e => {
      e.preventDefault();
      const fields = form.querySelectorAll('.modal-order__field');
      let isValid = true;
      fields.forEach(field => {
        const input = field.querySelector('.modal-order__form_input');
        if (input != null && input.value == '' && input.classList.contains('modal-order__form_input--required')) {
          field.classList.add('error');
          isValid = false;
        } else {
          field.classList.remove('error');
        }

        // validate email
        if (input != null && input.value !== '' && input.getAttribute('id') === 'email') {
          if (!validEmailAddress(input.value)) {
            field.classList.add('error');
            isValid = false;
          } else {
            field.classList.remove('error');
          }
        }

        // validate phone number
        if (input != null && input.value !== '' && input.getAttribute('id') === 'phone') {
          if (!validPhoneNumber(input.value)) {
            field.classList.add('error');
            isValid = false;
          } else {
            field.classList.remove('error');
          }
        }
      })

      let name = jQuery('.modal-order__form #name').val();
      let phone = jQuery('.modal-order__form #phone').val();
      let email = jQuery('.modal-order__form #email').val();
      let message = jQuery('.modal-order__form #message').val();

      if (isValid) {
        jQuery('.wpcf7-form-control[name="your-name"]').val(name);
        jQuery('.wpcf7-form-control[name="your-phone"]').val(phone);
        jQuery('.wpcf7-form-control[name="your-email"]').val(email);
        jQuery('.wpcf7-form-control[name="your-message"]').val(message);
        jQuery('.wpcf7-submit').click();
      }
    })

    /// response observer
    const formResponseElement = document.querySelector('.wpcf7-response-output');

    const formResponseObserver = new MutationObserver(function (mutationsList, observer) {
      let formResponseBlock = document.querySelector('.modal-order-form-response');
      formResponseBlock.innerHTML = formResponseElement.innerHTML;
    });

    formResponseObserver.observe(formResponseElement, { subtree: true, characterData: true, childList: true });

    // update items
    const updateItems = () => {
      const choosedItems = list.querySelectorAll('li');
      choosedItems.forEach(choosedItem => {
        choosedItem.remove();
      })
      for (let i = 0; i < arr.length; i++) {
        result.classList.add('not-empty');
        let li = document.createElement('li');
        li.innerHTML = `
     <span>${arr[i]}</span>
     <button type="button" class="modal-order__add-file_remove">
     <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
     <path fill-rule="evenodd" clip-rule="evenodd"
     d="M13.0667 4.30102C13.1237 4.24408 13.169 4.17647 13.1998 4.10204C13.2307 4.02762 13.2466 3.94784 13.2467 3.86726C13.2467 3.78669 13.2309 3.70689 13.2001 3.63243C13.1693 3.55797 13.1242 3.4903 13.0672 3.43329C13.0103 3.37628 12.9427 3.33104 12.8683 3.30016C12.7938 3.26928 12.7141 3.25336 12.6335 3.25331C12.5529 3.25326 12.4731 3.26908 12.3987 3.29987C12.3242 3.33066 12.2565 3.37581 12.1995 3.43275L8.49924 7.13302L4.80004 3.43275C4.6849 3.31761 4.52874 3.25293 4.36591 3.25293C4.20308 3.25293 4.04692 3.31761 3.93178 3.43275C3.81664 3.54789 3.75195 3.70406 3.75195 3.86689C3.75195 4.02972 3.81664 4.18588 3.93178 4.30102L7.63204 8.00022L3.93178 11.6994C3.87477 11.7564 3.82954 11.8241 3.79869 11.8986C3.76783 11.9731 3.75195 12.0529 3.75195 12.1336C3.75195 12.2142 3.76783 12.294 3.79869 12.3685C3.82954 12.443 3.87477 12.5107 3.93178 12.5677C4.04692 12.6828 4.20308 12.7475 4.36591 12.7475C4.44654 12.7475 4.52637 12.7316 4.60086 12.7008C4.67535 12.6699 4.74303 12.6247 4.80004 12.5677L8.49924 8.86742L12.1995 12.5677C12.3146 12.6827 12.4708 12.7472 12.6335 12.7471C12.7962 12.747 12.9522 12.6823 13.0672 12.5672C13.1822 12.452 13.2468 12.2959 13.2467 12.1332C13.2466 11.9704 13.1818 11.8144 13.0667 11.6994L9.36644 8.00022L13.0667 4.30102Z"
     fill="black" />
    </svg>
    </button>`
        buttonRemoveAll.insertAdjacentElement('beforeBegin', li);
        // remove item
        const buttonRemove = li.querySelector('button');
        buttonRemove.addEventListener('click', () => {
          // get files array
          let filesArray = input.files;
          let deletedFileName = li.querySelector('span').innerText;

          // create new files array
          let newFilesArray = [];

          // add files in new array without target file
          for (let file of filesArray) {
            if (file.name !== deletedFileName) {
              newFilesArray.push(file);
            }
          }

          let dataTransfer = new DataTransfer();
          newFilesArray.forEach(function (file) {
            dataTransfer.items.add(file);
          });

          // add new file array in input
          input.files = dataTransfer.files;
          input.dispatchEvent(new Event('change'));

          li.remove();
          arr = arr.filter(function (m) {
            return m != li.querySelector('span').textContent;
          })
          if (arr.length == 0) result.classList.remove('not-empty');
        })
      }
    }

    // select files
    input.addEventListener('change', function (event) {
      const cf7Files = document.querySelector('.wpcf7-drag-n-drop-file');
      if (arr.length == 0) {
        for (const file of this.files) {
          arr.push(file.name);
        }
        updateItems();
      } else {
        for (const file of this.files) {
          if (!arr.includes(file.name)) arr.push(file.name);
        }
        updateItems();
      }
      // remove all items
      buttonRemoveAll.addEventListener('click', () => {
        arr = [];
        result.classList.remove('not-empty');
        const choosedItems = list.querySelectorAll('li');
        choosedItems.forEach(choosedItem => {
          choosedItem.remove();
        });
        input.value = '';
        input.dispatchEvent(new Event('change'));
      })
      // added files on hidden input
      cf7Files.files = event.target.files;
    });
  }

  // checkout
  if (document.querySelectorAll('.checkout').length) {
    const selects = document.querySelectorAll('.checkout__select');
    const form = document.getElementById('checkout__form');
    const requiredFields = document.querySelectorAll('.checkout__block_field.--required');
    const postDeliveryRadio = document.getElementById('deliveryOne');
    const certificateButton = document.querySelector('.checkout__certificate_button');
    const certificateWrap = document.querySelector('.checkout__certificate_wrap');
    const checkboxes = document.querySelectorAll('.checkout__block_checkboxes input[type=checkbox]');
    const additionally = document.querySelector('.checkout__order_checkbox');
    const radioItems = document.querySelectorAll('.checkout__delivery_item');
    const citySelect = document.querySelector('.checkout__select--city');
    const cityRadio = document.querySelector('.checkout__delivery_item--city');
    const certificateInput = document.querySelector('.checkout__certificate_field input');
    const certificateSubmit = document.querySelector('.checkout__certificate_submit');
    const certificateField = document.querySelector('.checkout__order_discount');
    const deliveryMethod = document.querySelector('.delivery-method');
    const rolledDelivery = document.querySelector('.checkout__rolled-delivery');
    const rolledDeliveryRadio = document.getElementById('deliveryRolled');

    // add sertificate
    certificateSubmit.addEventListener('click', () => {
      if (certificateInput.value != '') certificateField.textContent = `$${certificateInput.value}`;
    })

    // delivery method on the loading page
    if (deliveryMethod != null) {
      const deliveryMethodValue = document.querySelector('.delivery-method-value span');
      if (deliveryMethodValue.textContent == 'Відділення') deliveryMethod.classList.add('department');
      else deliveryMethod.classList.remove('department');
      if (deliveryMethodValue.textContent == 'Адресна доставка') deliveryMethod.classList.add('address');
      else deliveryMethod.classList.remove('address');
    }

    // selects
    selects.forEach(select => {
      const trigger = select.querySelector('.checkout__select_panel');
      const list = select.querySelector('.checkout__select_list');
      const items = select.querySelectorAll('.checkout__select_item');
      const span = select.querySelector('.checkout__select_panel span');

      // hide selects
      document.addEventListener('click', e => {
        if (!select.contains(e.target)) {
          trigger.classList.remove('active');
          list.classList.remove('active');
          list.style.maxHeight = null;
        }
      })

      // show and hide select
      trigger.addEventListener('click', () => {
        if (!trigger.classList.contains('active')) {
          trigger.classList.add('active');
          list.classList.add('active');
          // list.style.maxHeight = list.scrollHeight + 'px';
        } else {
          trigger.classList.remove('active');
          list.classList.remove('active');
          // list.style.maxHeight = null;
        }
      })

      select.addEventListener('click', (e) => {
        if (e.target.closest('.checkout__select_item')) {
          const el = e.target;
          const trigger = select.querySelector('.checkout__select_panel');

          if (select.classList.contains('error')) select.classList.remove('error');
          if (span.classList.contains('--default')) span.classList.remove('--default');
          span.innerText = el.innerText;

          trigger.setAttribute('data-content', el.innerText);

          trigger.classList.remove('active');
          list.classList.remove('active');
          list.style.maxHeight = null;

          // city select
          if (citySelect != null && cityRadio != null) {
            const panelText = citySelect.querySelector('.checkout__select_panel span').textContent
            if (panelText == 'місто Київ' || panelText == 'місто Львів') cityRadio.classList.remove('disabled');
            else cityRadio.classList.add('disabled')
          }

          if (deliveryMethod != null) {
            const deliveryMethodValue = document.querySelector('.delivery-method-value span');
            if (deliveryMethodValue.textContent == 'Відділення') deliveryMethod.classList.add('department');
            else deliveryMethod.classList.remove('department');
            if (deliveryMethodValue.textContent == 'Адресна доставка') deliveryMethod.classList.add('address');
            else deliveryMethod.classList.remove('address');
          }
        }
      });

      // change selects value
      items.forEach(item => {
        item.addEventListener('click', () => {
          // if (select.classList.contains('error')) select.classList.remove('error');
          // if (span.classList.contains('--default')) span.classList.remove('--default');
          // span.innerText = item.innerText;
          // // city select
          // if (citySelect != null && cityRadio != null) {
          //   const panelText = citySelect.querySelector('.checkout__select_panel span').textContent
          //   if (panelText == 'Київ' || panelText == 'Львів') cityRadio.classList.remove('disabled');
          //   else cityRadio.classList.add('disabled')
          // }
          if (deliveryMethod != null) {
            const deliveryMethodValue = document.querySelector('.delivery-method-value span');
            if (deliveryMethodValue.textContent == 'Відділення') deliveryMethod.classList.add('department');
            else deliveryMethod.classList.remove('department');
            if (deliveryMethodValue.textContent == 'Адресна доставка') deliveryMethod.classList.add('address');
            else deliveryMethod.classList.remove('address');
          }
        })
      })
    })

    // radio show and hide
    radioItems.forEach(radioItem => {
      // add class checked on the loading page
      radioInput = radioItem.querySelector('input[type=radio]');
      if (radioInput.checked) radioItem.classList.add('checked');
      // change checked input
      radioInput.addEventListener('change', () => {
        for (let i = 0; i < radioItems.length; i++) {
          const input = radioItems[i].querySelector('input[type=radio]');
          radioItems[i].classList.remove('checked');
          if (input.checked) radioItems[i].classList.add('checked');
        }
      })
    })

    // certificate show and hide
    certificateButton.addEventListener('click', () => {
      if (!certificateWrap.classList.contains('active')) {
        certificateButton.classList.add('active');
        certificateWrap.classList.add('active');
        certificateWrap.style.maxHeight = certificateWrap.scrollHeight + 'px';
      } else {
        certificateButton.classList.remove('active');
        certificateWrap.classList.remove('active');
        certificateWrap.style.maxHeight = null;
      }
    })

    // checkboxes
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('click', () => {
        let t = 0;

        const pretyNum = (num) => {
          let newNum = num.split('$')[1];
          newNum = parseInt(newNum);
          newNum = Math.round(newNum);

          return newNum;
        };

        if (checkbox.checked) {
          const addPrice = additionally.querySelector('span');
          const actPrice = document.querySelector('.checkout__order_total').querySelector('#original');
          const procent = checkbox.closest('[data-p]').dataset.p;
          const initialPrice = actPrice.dataset.initialPrice;

          console.log(Math.round(pretyNum(addPrice.innerHTML)));

          const addAddPrice = Math.round(pretyNum(addPrice.innerHTML)) > 0 ? Math.round(pretyNum(addPrice.innerHTML)) : 0;

          // set add price
          addPrice.innerHTML = "$" + (addAddPrice + Math.round(Math.round(parseInt(initialPrice)) / 100 * parseInt(procent)));

          // set actual price
          actPrice.innerHTML = "$" + (Math.round(parseInt(initialPrice)) + pretyNum(addPrice.innerHTML));

          additionally.classList.add('active');
        } else {
          const addPrice = additionally.querySelector('span');
          const actPrice = document.querySelector('.checkout__order_total').querySelector('#original');
          const procent = checkbox.closest('[data-p]').dataset.p;
          const initialPrice = actPrice.dataset.initialPrice;

          // set actual price
          actPrice.innerHTML = "$" + (pretyNum(actPrice.innerHTML) - Math.round((Math.round(parseInt(initialPrice)) / 100 * parseInt(procent))));

          // set add price
          addPrice.innerHTML = "$" + (pretyNum(addPrice.innerHTML) - (Math.round(parseInt(initialPrice)) / 100 * parseInt(procent)));
        };

        for (let i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].checked) t = 1;
        }
        if (t == 0) {
          additionally.classList.remove('active')
        };
      })
    })

    // submit form
    form.addEventListener('submit', e => {
      // checking required fields
      requiredFields.forEach(field => {
        const input = field.querySelector('input');
        if (input.value == '') {
          field.classList.add('error');
          e.preventDefault();
        } else {
          field.classList.remove('error');
        }
      })
      // checking delivery field
      if (postDeliveryRadio != null && postDeliveryRadio.checked) {
        if (deliveryMethod != null) {
          if (deliveryMethod.classList.contains('department')) {
            selects.forEach(select => {
              if (select.classList.contains('--required')) {
                const span = select.querySelector('.checkout__select_panel span');
                if (span.classList.contains('--default')) {
                  e.preventDefault();
                  select.classList.add('error');
                } else {
                  select.classList.remove('error');
                }
              }
            })
          }
          if (deliveryMethod.classList.contains('address')) {
            const fields = document.querySelectorAll('.checkout__address-delivery_field.--required');
            if (fields.length) {
              fields.forEach(field => {
                const input = field.querySelector('input');
                if (input.value == '') {
                  field.classList.add('error');
                  e.preventDefault();
                } else {
                  field.classList.remove('error');
                }
              })
            }
          }
        }
      }
      if (rolledDelivery != null && rolledDeliveryRadio.checked) {
        const fields = document.querySelectorAll('.checkout__rolled-delivery_field.--required');
        if (fields.length) {
          fields.forEach(field => {
            const input = field.querySelector('input');
            if (input.value == '') {
              field.classList.add('error');
              e.preventDefault();
            } else {
              field.classList.remove('error');
            }
          })
        }
      }
    })
  }

  // add to cart handler
  jQuery('.add-to-cart').click(function () {
    if (isformCanSubmitted()) {
      jQuery('.variations_form').trigger('submit');
    }
  });

  // quick buy handler
  jQuery('.quick_buy').click(function () {
    if (isformCanSubmitted()) {
      jQuery('.variations_form').trigger('submit', 'quick');
    }
  });

  // ajax add to cart
  jQuery('body').on('submit', '.variations_form', function (event, param) {
    event.preventDefault();

    let quantity = 1;
    let productId = jQuery(this).find('.single_variation_wrap input[name="product_id"]').val();
    let variationId = jQuery(this).find('.single_variation_wrap input[name="variation_id"]').val()

    jQuery.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: {
        'action': 'custom_add_to_cart',
        'product_id': productId,
        'variation_id': variationId,
        'quantity': quantity
      },
      success: function (response) {
        let data = JSON.parse(response);
        // relocate if quick buy
        if (param && param === 'quick') {
          window.location.href = "checkout";
        } else {
          // change modal content and open
          if (data) {
            changeModalContent(data);
            openModal();
          }
        }
      },
      error: function (error) {
        console.log('error: ', error);
      }
    });
  });

  const headerSearch = document.querySelector('#header-search');
  const searchBtn = document.querySelector('.search-modal__button_search');

  const submitSearch = () => {
    const container = searchBtn.closest('.search-modal__field');
    const input = container.querySelector('[type="text"]');
    const formInput = headerSearch.querySelector('[type="search"]');

    if (input.value == '') { return; };

    formInput.value = input.value;

    headerSearch.submit();
  }

  headerSearch && searchBtn.addEventListener('click', submitSearch)


  if (document.querySelectorAll('.newsletter').length) {
    const visibleForm = document.getElementById('newsletter__form_visible');
    const visibleFormInput = visibleForm.querySelector('input[type=text]');
    const errorText = visibleForm.querySelector('.newsletter__form_error');
    const hideForm = document.querySelector('#wpcf7-f357-o1 form');
    const hideFormInput = hideForm.querySelector('#wpcf7-f357-o1 input[type=email]');

    visibleForm.addEventListener('submit', (e) => {
      e.preventDefault();
      // validate email
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(visibleFormInput.value)) {
        errorText.classList.add('error');
      } else {
        errorText.classList.remove('error');
        hideFormInput.value = visibleFormInput.value;
        hideForm.submit();
      }
    })
  }

});

const descriptionAccordion = (initialHeight, mobileHeight) => {
  // description accordion
  const screenWidth = window.screen.width;

  if (document.querySelectorAll('.description').length) {
    const wrapper = document.querySelector('.description__wrapper');
    const button = wrapper.querySelector('.description__button');

    button.addEventListener('click', () => {
      button.classList.toggle('active');
      wrapper.classList.toggle('active');
      if (wrapper.classList.contains('active')) wrapper.style.maxHeight = wrapper.scrollHeight + 'px';
      else if (screenWidth >= 768) wrapper.style.maxHeight = `${mobileHeight}px`;
      else wrapper.style.maxHeight = `${initialHeight}px`
    });
  }
}

// disable stripe plugin scroll
if (jQuery('.single-product .product').length > 0) {
  jQuery(document).ready(function (){
    let interval = setInterval(function (){
      jQuery('html, body').stop();
    }, 50)

    setTimeout(function (){
      clearInterval(interval);
    }, 2000)
  })
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

// hide UAH price if not default language
if (document.querySelectorAll('.checkout__order_footer').length > 0) {
  if (getCookie('googtrans') !== undefined) {
    document.querySelector('.checkout__order_footer #uah').style.display = 'none';
  }
}