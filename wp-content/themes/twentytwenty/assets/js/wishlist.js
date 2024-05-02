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
        const coociesWishlist = localStorage.getItem('matis-wishlist');
        const productId = wishlistBtn.dataset.id;

        if (coociesWishlist) {
            pushLocalStorage(productId)
        } else {
            createLocalStorage(productId);
        };
    };


    const loadEmpty = () => {
        console.log(wishlistEmptyContainer);
        wishlistEmptyContainer.classList.remove('hidden');
    };

    const loadProducts = (wishlistId) => {
        const parsedId = wishlistId.split(',');
        const apiKey = 'ck_8e872869c7559c61d33d277263c8a1ad22dc48f0';
        const apiSecret = 'cs_753ae6e56de5fcb3006f06ef89d43cbaeef3fd54';
        const storeUrl = '/wp-json/wc/v3';
        const endpoint = `${storeUrl}/products?consumer_key=${apiKey}&consumer_secret=${apiSecret}&include=${parsedId.join(',')}`;
        console.log(endpoint);
        // const loader = document.querySelector('.loader');

        fetch(endpoint).then(response => response.json())
            .then(data => {
                console.log(data);
                // creatreCards(data);
            })
            .catch(error => {
                console.error(error);
            })
            .finally(() => {
                // loader.style.display = "none"
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

    wishlistBtn && wishlistBtn.addEventListener('click', addToWishlist);

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

    wishlistContainer && loadWishlist();
});
