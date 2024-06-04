document.addEventListener('DOMContentLoaded', function () {

    const wishlistBtn = document.querySelectorAll('.wishlist-add');
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
        const coociesWishlist = localStorage.getItem('matis-wishlist');
        const productId = wishlistBtn[0].dataset.id;

        if (coociesWishlist) {
            pushLocalStorage(productId)
        } else {
            createLocalStorage(productId);
        };


        wishlistBtn.forEach((item)=>{
            item.classList.add('wishlist-added');
        })
    };

    const removeFromWishlist = (id) => {
        const whishlist = localStorage.getItem('matis-wishlist');
        const idList = whishlist.split(',');
        const newWishlist = idList.filter((item)=>{
            if (item != id){
                return item;
            }
        })

        localStorage.setItem('matis-wishlist', newWishlist);
    };


    const loadEmpty = () => {
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
        } else if (checkProducts(wishlistId)) {
            loadProducts(wishlistId);
        }
    };

    const checkIfAdded = () => {
        const wishlist = localStorage.getItem('matis-wishlist');
        const productId = wishlistBtn[0].dataset.id;
        const wishlistIdList = wishlist.split(',');

        if (wishlistIdList.includes(productId)) {
            wishlistBtn.forEach((item)=>{
                item.classList.add('wishlist-added')
            });
        }
    }

    wishlistBtn && wishlistBtn.forEach((item)=>{
        item.addEventListener('click', () => {
            if ( !item.classList.contains('wishlist-added')) {
                addToWishlist();
            } else {
                const id = item.dataset.id;
                removeFromWishlist(id);
                wishlistBtn.forEach((item)=>{
                    item.classList.remove('wishlist-added');
                });
            }
        });
    })

    function wishlistEvents(){
        const wishlistBtnRemove = document.querySelectorAll('.product-card__remove');

        wishlistBtnRemove && wishlistBtnRemove.forEach((item)=>{
            item.addEventListener('click', (event)=>{
                removeFromWishlist(event.currentTarget.dataset.id);
                item.closest('.wishlist__item').remove();
            })
        })
    }

    wishlistBtn.length > 0 && checkIfAdded();

    wishlistContainer && loadWishlist();
});
