document.addEventListener('DOMContentLoaded', function () {

    const wishlistBtn = document.querySelector('#wishlist-btn');

    const addToWishlist = () => {
        const coociesWishlist = localStorage.getItem('matis-wishlist');
        const productId = wishlistBtn.dataset.id;

        console.log(productId);

        if (!coociesWishlist) { return };



        console.log(endpoint);
    }

    const createLocalStorage = () => {

    };

    wishlistBtn.addEventListener('click', addToWishlist);




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
});
