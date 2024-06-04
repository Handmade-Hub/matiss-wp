document.addEventListener('DOMContentLoaded', function () {

    const wishlistBtn = document.querySelector('#wishlist-btn');
    const wishlistContainer = document.querySelector('.wishlist__list');
    const wishlistEmptyContainer = document.querySelector('.wishlist-empty');

    const pushLocalStorage = (id) => {
        const wishlistId = localStorage.getItem('matis-wishlist');

        if (wishlistId.length == 0) {
            createLocalStorage(id);
            return;
        }

        const parseId = wishlistId.split(',');
        const checkIncludesId = parseId.includes(id);

        if (checkIncludesId) { return }

        parseId.push(id);
        localStorage.setItem('matis-wishlist', parseId);
    };

    const createLocalStorage = (id) => {
        const idArr = [];

        idArr.push(id);

        const arrToString = idArr.toString();

        localStorage.setItem('matis-wishlist', arrToString);
    };

    const addToWishlist = () => {
        console.log('addToWishlist')
        const coociesWishlist = localStorage.getItem('matis-wishlist');
        const productId = wishlistBtn.dataset.id;

        if (coociesWishlist) {
            pushLocalStorage(productId)
        } else {
            createLocalStorage(productId);
        };

        wishlistBtn.classList.add('wishlist-added');
    };

    const removeFromWishlist = (id) => {
        const whishlist = localStorage.getItem('matis-wishlist');
        const idList = whishlist.split(',');
        const newWishlist = idList.filter((item)=>{
            if (item != id){
                return item;
            }
        })
        console.log('idList', idList)
        console.log('newWishlist', newWishlist)
        localStorage.setItem('matis-wishlist', newWishlist);
    };


    const loadEmpty = () => {
        console.log(wishlistEmptyContainer);
        wishlistEmptyContainer.classList.remove('hidden');
    };

    const loadProducts = (wishlistId) => {
        const url = wc_add_to_cart_params.ajax_url;

        jQuery.ajax({
            type: 'GET',
            url: url,
            data: {
                'action': 'get_wishlist',
                'products': wishlistId
            },
            success: function (response) {
                jQuery('.wishlist__list').append(response);
                wishlistEvents();
            },
            error: function (error) {
                console.log('error: ', error);
            }
        });
    }

    const checkProducts = (wishlistId) => {
        if (wishlistId.length == 0) {
            loadEmpty();
            return false;
        }

        return true;
    };

    const loadWishlist = () => {
        const wishlistId = localStorage.getItem('matis-wishlist');
        if (!wishlistId) {
            loadEmpty();
            console.log(false);
        } else if (checkProducts(wishlistId)) {
            loadProducts(wishlistId);
        }
    };

    const checkIfAdded = () => {
        const wishlist = localStorage.getItem('matis-wishlist');
        const productId = wishlistBtn.dataset.id;
        const wishlistIdList = wishlist.split(',');

        if (wishlistIdList.includes(productId)) {
            wishlistBtn.classList.add('wishlist-added')
        }
    }

    wishlistBtn && wishlistBtn.addEventListener('click', () => {
        if ( !wishlistBtn.classList.contains('wishlist-added')) {
            addToWishlist();
        } else {
            const id = wishlistBtn.dataset.id;
            removeFromWishlist(id);
            wishlistBtn.classList.remove('wishlist-added');
        }
    });

    function wishlistEvents(){
        const wishlistBtnRemove = document.querySelectorAll('.product-card__remove');

        wishlistBtnRemove && wishlistBtnRemove.forEach((item)=>{
            item.addEventListener('click', (event)=>{
                removeFromWishlist(event.currentTarget.dataset.id);
                item.closest('.wishlist__item').remove();
            })
        })
    }





    // const coociesWishlistJSON = JSON.parse(coociesWishlist);
    // const productsID = coociesWishlistJSON;
    // const apiKey = 'ck_8e872869c7559c61d33d277263c8a1ad22dc48f0'
    // const apiSecret = 'cs_753ae6e56de5fcb3006f06ef89d43cbaeef3fd54';
    // const storeUrl = '/wp-json/wc/v3';
    // const endpoint = `${storeUrl}/products?consumer_key=${apiKey}&consumer_secret=${apiSecret}&include=${productsID.join(',')}`;

    // fetch(endpoint).then(response => response.json()).then(data => {
    //     console.log(data);
    //     creatreCards(data);
    // }
    // ).catch(error => {
    //     console.error(error);
    // }
    // ).finally(() => {
    //     document.querySelector('.loader').style.display = "none"
    // }
    // );

    // function creatreCards(products) {
    //     const articlesContainer = document.querySelector('.calendars-list');
    //     const sortedProducts = productsID.map(productId => products.find(product => product.id === productId)).reverse();

    //     sortedProducts.forEach(product => {
    //         if (!product.images)
    //             return;

    //         const article = document.createElement('article');
    //         article.classList.add('product');

    //         const img = `<img width="400" height="400" src="${product.images[0].src}" class="product__thumb" alt="" loading="lazy" sizes="(max-width: 400px) 100vw, 400px">`;
    //         const h3 = `<h3 class="product__title">${product.name}</h3>`;
    //         const a = `<a href="${product.permalink}" class="btn btn--bordered">Детальніше</a>`;

    //         article.innerHTML = img + h3 + a;

    //         articlesContainer.append(article);
    //     }
    //     );
    // }

    wishlistBtn && checkIfAdded();

    wishlistContainer && loadWishlist();
});
