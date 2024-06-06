(() => {
    const filtersItemOptions = document.querySelector('.filters__item_options');
    const woocommerceOrdering = document.querySelector('.woocommerce-ordering');

    const getSort = (element) => {
        const dataValue = element.dataset.value;
        if (element.closest('.filters__item_option') && dataValue) {
            updSort(dataValue);
        }
    };

    const updSort = (value) => {
        const option = woocommerceOrdering.querySelector(`[value=${value}]`);

        option.selected = true;

        woocommerceOrdering.submit();
    };

    filtersItemOptions.addEventListener('click', evt => {
        getSort(evt.target);
    })
})();
(() => {
    const filterPridceBtn = document.querySelector('#filter_pridce_btn');

    const queryFilterByPrice = () => {
        const min = document.querySelector('.filters__item_min').innerText;
        const max = document.querySelector('.filters__item_max').innerText;
        const url = window.location.href;
        const search = window.location.search;

        let newUrl = "";

        if (search.includes('min_price') || search.includes('max_price')) {
            newUrl = url.replace(/([?&])min_price=(\d+)+/g, `$1min_price=${min}`);
            newUrl = newUrl.replace(/([?&])max_price=(\d+)+/g, `$1max_price=${max}`);
        } else {
            const perf = window.location.search != "" ? "&" : "?";

            newUrl = `${url + perf}min_price=${min}&max_price=${max}`;
        }

        window.location.href = newUrl;
    }

    filterPridceBtn && filterPridceBtn.addEventListener('click', queryFilterByPrice)
})();
(() => {
    const filtersList = document.querySelector('.filters__list_desktop');

    const filterHandler = (element) => {
        console.log('filtersList element', element)
        if (!element.closest('[data-value]')) {
            return;
        }

        let dataValue = element.closest('[data-value]').dataset.value;
        let newUrl = "";

        const dataKey = element.closest('[data-key]').dataset.key;
        const searchParams = new URLSearchParams(window.location.search);
        const url = window.location.href;

        if (searchParams.has(dataKey)) {
            searchParams.set(dataKey, dataValue);
            newUrl = `${url.split('?')[0]}?${searchParams.toString()}`;
        } else {
            const perf = window.location.search !== "" ? "&" : "?";
            newUrl = `${url + perf}${dataKey}=${dataValue}`;
        }

        console.log(dataKey + " - " + dataValue);
        console.log(newUrl);

        const decodedUrl = decodeURIComponent(newUrl);

        window.location.href = decodedUrl;
    };



    filtersList.addEventListener('click', evt => filterHandler(evt.target))
})();
/// mobile filters
(() => {
    const filtersList = document.querySelector('.filters-mobile__list');
    const mobileSubmitFilter = document.querySelector('.filters-mobile__buttons_submit');
    const mobileClearFilter = document.querySelector('.filters-mobile__buttons_remove');
    const searchParams = new URLSearchParams(window.location.search);
    let fromMobileSlider = document.getElementById('fromMobileSlider');
    let toMobileSlider = document.getElementById('toMobileSlider');
    let searchParamsArray = Array.from(searchParams.entries());
    let choosedOption = {};

    //get search params
    if (searchParamsArray.length > 0) {
        searchParamsArray.forEach(function (item) {
            let key = item[0];
            let values = item[1].split(',');
            choosedOption[key] = values;

            values.forEach(function (item) {
                // set min price range
                if (key === 'min_price') {
                    fromMobileSlider.value = item;
                }
                // set max price range
                if (key === 'max_price') {
                    toMobileSlider.value = item;
                }

                /// add active class in filter button
                if (key !== 'min_price' && key !== 'max_price' && key !== 'orderby') {
                    let selector = `.filters-mobile__sublist[data-key="${key}"] .filters-mobile__sublist_item[data-value="${item}"]`;
                    document.querySelector(selector).classList.add('choosed');
                }
            })
        })
    }

    // filter handler
    const filterHandler = (element) => {
        if (!element.closest('[data-value]')) {
            return;
        }

        let dataValue = element.closest('[data-value]').dataset.value;
        const dataKey = element.closest('[data-key]').dataset.key;

        if (choosedOption[dataKey]) {
            if (!choosedOption[dataKey].includes(dataValue)) {
                choosedOption[dataKey].push(dataValue);
            } else {
                // remove if was second picked
                choosedOption[dataKey] = choosedOption[dataKey].filter(function (item) {
                    return item !== dataValue;
                });

                if (choosedOption[dataKey].length === 0) delete choosedOption[dataKey];
            }
        } else {
            choosedOption[dataKey] = []
            choosedOption[dataKey].push(dataValue);
        }

        for (let key in choosedOption) {
            choosedOption[key].forEach(function (childItem) { })
        }
    };

    filtersList.addEventListener('click', evt => filterHandler(evt.target))

    // min price range
    fromMobileSlider.addEventListener('change', function (event) {
        choosedOption['min_price'] = [event.target.value];
    });


    // max price range
    toMobileSlider.addEventListener('change', function (event) {
        choosedOption['max_price'] = [event.target.value];
    });

    // submit filters
    mobileSubmitFilter.addEventListener('click', function () {
        setFilter();
    })

    // clear all filters
    mobileClearFilter.addEventListener('click', function () {
        let url = window.location.origin + window.location.pathname;
        const decodedUrl = decodeURIComponent(url);
        window.location.href = decodedUrl;
    })

    //orderby mobile filter
    const mobileSortBy = document.querySelector('.mobile__orderby');

    mobileSortBy.querySelectorAll('.filters__item_option').forEach(function (item) {
        item.addEventListener('click', function (event) {
            if (event.target.dataset.value) {
                choosedOption['orderby'] = [event.target.dataset.value];
                setFilter()
            }
        })
    });

    // set filter and reload page
    function setFilter() {
        let url = window.location.origin + window.location.pathname;
        let params = '?';
        let newUrl = "";
        for (let key in choosedOption) {
            let values = '';
            choosedOption[key].forEach(function (value) {
                if (values !== '') values += ',';
                values += value
            })
            params += `${key}=${values}&`;
        }
        newUrl = `${url + params}`;
        const decodedUrl = decodeURIComponent(newUrl);
        window.location.href = decodedUrl;
    }
})();