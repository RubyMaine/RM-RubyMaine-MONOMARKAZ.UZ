$(document).ready(function() {

    let options = {
        max_font_size_step: 3,
        current_font_step: 0,
        is_stop_font_size_step: '',
        contrast: 0,
        max_theme_step: 4,
        current_contrast_step: 0,
        current_grayscale_step: 0,
        'current_hue-rotate_step': 0,
    }

    getLocalStorage();


    $('.helper_btn').on('click', function() {
        if ($('.helper_tools')[0].classList.length > 1) {
            $('.helper_tools').removeClass('show')
        } else {
            $('.helper_tools').addClass('show')
        }
    })


    $('.tools_item').click(function(e) {
        let tools_type = e.target.getAttribute('data-type');
        let font_size_array = $('.tools_size');

        if (font_size_array.length === 0) {
            $('a, span, b, h1, h2, h3, h4, h5, h6, i').addClass('tools_size');
            font_size_array = $('.tools_size');
        }

        switch (tools_type) {
            case 'zoomIn':
                fontSizeSettings('inc')
                break;
            case 'zoomOut':
                fontSizeSettings('dic');
                break;
            case 'contrast':
                themeSettings('contrast', '%');
                break;
            case 'grayscale':
                themeSettings('grayscale', '%');
                break;
            case 'hue-rotate':
                themeSettings('hue-rotate', 'deg');
                break;
            case 'clear':
                clearSettings();
                break;
        }

        function fontSizeSettings(type) {
            if (options.is_stop_font_size_step !== type) {
                type === 'inc' ? options.current_font_step++ : options.current_font_step--;
                options.is_stop_font_size_step = ''
                for (let i = 0; i < font_size_array.length; i++) {
                    let fontSize = window.getComputedStyle(font_size_array[i], null).getPropertyValue('font-size');
                    let nextSize = (type === 'inc' ? (parseInt(fontSize) + 2) : (parseInt(fontSize) - 2)) + 'px !important';
                    font_size_array[i].setAttribute("style", 'font-size: ' + nextSize)
                }
            }
            if (Math.abs(options.current_font_step) === options.max_font_size_step) {
                options.is_stop_font_size_step = type
            }

            setLocalStorage();
        }


        function fontColorSettins() {

        }

        function themeSettings(type, symbol) {
            let style = $('.special-wrapper').attr('style');
            let bool = true;
            let style_arr = [];
            if (style) {
                style_arr = style.split(';')[0].split(':')[1].split(' ').filter(el => el.length > 1);

                style_arr.map((el, index) => {
                    if (el.search(type) > -1) {
                        if (type === 'contrast') {
                            options['current_' + type + '_step']++;
                            style_arr[index] = type + '(' + (50 * options['current_' + type + '_step']) + symbol + ')';
                        } else {
                            style_arr[index] = type + '(' + (50 * options['current_' + type + '_step']) + symbol + ')';
                            options['current_' + type + '_step']++;
                        }
                        bool = false
                        if (options['current_' + type + '_step'] === options.max_theme_step) {
                            options['current_' + type + '_step'] = 0
                        }
                        return 0;
                    }
                })
            }

            if (bool) {
                options['current_' + type + '_step']++;
                style_arr.push(type + '(' + 50 * options['current_' + type + '_step'] + symbol + ')')
            }

            let url = window.location.href

            if (url.split('/').reverse()[0] === '' || url.split('/').reverse()[0][0] === '?') {
                $('.special-wrapper').attr("style", 'filter: ' + style_arr.join(' '))
                $('.header-upper').attr("style", 'filter: ' + style_arr.join(' '))
                $('.helper_container').attr("style", 'filter: ' + style_arr.join(' '))
                $('.membership_container').attr("style", 'filter: ' + style_arr.join(' '))
                $('.scroll-to-top').attr("style", 'filter: ' + style_arr.join(' '))
                $('#container').attr("style", 'filter: ' + style_arr.join(' '))
                $('.side-menu__block').attr("style", 'filter: ' + style_arr.join(' '))
                $('#footWrapper').attr("style", 'filter: ' + style_arr.join(' '))
            } else {
                $('.special-wrapper').attr("style", 'filter: ' + style_arr.join(' '))
                $('.header-upper').attr("style", 'filter: ' + style_arr.join(' '))
                $('.helper_container').attr("style", 'filter: ' + style_arr.join(' '))
                $('.membership_container').attr("style", 'filter: ' + style_arr.join(' '))
                $('.scroll-to-top').attr("style", 'filter: ' + style_arr.join(' '))
                $('#container').attr("style", 'filter: ' + style_arr.join(' '))
                $('.side-menu__block').attr("style", 'filter: ' + style_arr.join(' '))
                $('#footWrapper').attr("style", 'filter: ' + style_arr.join(' '))
            }

            setLocalStorage()
        }

        function clearSettings() {
            $('.special-wrapper').attr("style", "")
            $('.header-upper').attr("style", "")
            $('.helper_container').attr("style", "")
            $('.membership_container').attr("style", "")
            $('.scroll-to-top').attr("style", "")
            $('#container').attr("style", "")
            $('.side-menu__block').attr("style", "")
            $('#footWrapper').attr("style", "")
            for (let i = 0; i < font_size_array.length; i++) {
                let fontSize = window.getComputedStyle(font_size_array[i], null).getPropertyValue('font-size');
                let nextSize = (parseInt(fontSize) - options.current_font_step * 2) + 'px !important';
                font_size_array[i].setAttribute("style", 'font-size: ' + nextSize)
            }
            options = {
                max_font_size_step: 3,
                current_font_step: 0,
                is_stop_font_size_step: '',
                contrast: 0,
                max_theme_step: 4,
                current_contrast_step: 0,
                current_grayscale_step: 0,
                'current_hue-rotate_step': 0,
            }

            localStorage.removeItem('options')
            localStorage.removeItem('body')
        }
    })


    function setLocalStorage() {
        localStorage.setItem('options', JSON.stringify(options))
        if ($('.special-wrapper').attr('style')) {
            localStorage.setItem('body', $('.special-wrapper').attr('style'))
        }
    }

    function getLocalStorage() {
        let body_style = localStorage.getItem('body');
        let locale_options = JSON.parse(localStorage.getItem('options'))

        if (body_style) {
            let url = window.location.href

            if (url.split('/').reverse()[0] === '' || url.split('/').reverse()[0][0] === '?') {
                // if(body_style.split(';').filter(el => el.search('transform') > -1).length === 0) {
                //     body_style += '; transform: translateY(-114px)'
                // }
                $('.special-wrapper').attr('style', body_style)
                $('.header-upper').attr('style', body_style)
                $('.helper_container').attr('style', body_style)
                $('.membership_container').attr('style', body_style)
                $('.scroll-to-top').attr('style', body_style)
                $('#container').attr('style', body_style)
                $('.side-menu__block').attr('style', body_style)
                $('#footWrapper').attr('style', body_style)
            } else {
                $('.special-wrapper').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('.header-upper').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('.helper_container').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('.membership_container').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('.scroll-to-top').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('#container').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('.side-menu__block').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))
                $('#footWrapper').attr('style', body_style.split(';').filter(el => el.search('transform') === -1).join(';'))

            }
        }

        if (locale_options) {

            options = JSON.parse(JSON.stringify(locale_options))

            let font_size_array = $('.tools_size');

            if (font_size_array.length === 0) {
                $('a, span, b, h1, h2, h3, h4, h5, h6, i').addClass('tools_size');
                font_size_array = $('.tools_size');
            }

            for (let i = 0; i < font_size_array.length; i++) {
                let fontSize = window.getComputedStyle(font_size_array[i], null).getPropertyValue('font-size');
                let nextSize = (parseInt(fontSize) + options.current_font_step * 2) + 'px !important';
                font_size_array[i].setAttribute("style", 'font-size: ' + nextSize)
            }
        }
    }

});