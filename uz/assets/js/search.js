$(document).ready(function() {
    //search open/close
    $('.first-show').on('click', function() {
        $('.search-input-wrapper').css('display', 'flex');
        $('.search-input-wrapper input').focus();
    })
    $('.search-close-btn').on('click', function() {
        $('.search-input-wrapper').css('display', 'none');
        $('.results-wrapper').css('display', 'none');
        $('.search-input-wrapper input')[0].value = '';
    })
    $('.search-info-btn').on('click', function() {
        searchResults()
    })

    $(document).on('keypress', function(e) {
        if (e.which == 13 && $('.search-input-wrapper').attr('style') === 'display: flex;' && $('.search-input-wrapper input').is(":focus")) {
            searchResults()
        }
    });

    function searchResults() {
        let value = $('.search-input-wrapper input').val().toString()
        if (value !== '') {
            $.ajax({
                method: "GET",
                url: `search?search_value=${value}`
            }).done(data => {
                let results = JSON.parse(data)
                $('.search-wrapper .results-wrapper')[0].innerHTML = ''
                if (results.length > 0) {
                    results.forEach((item) => {
                        $('.search-wrapper .results-wrapper').append('<span>' + item.title_uz + '</span>')
                    })
                } else {
                    $('.search-wrapper .results-wrapper').append("<span class='no-result'>Ma'lumolar topilmadi</span>")
                }
                $('.search-wrapper .results-wrapper').css('display', 'block')
                $('.results-wrapper span').on('click', function() {
                    let neededIndex = $('.results-wrapper span').index(this);
                    if (results[neededIndex].class_name === 'HomePage') {
                        document.location.href = window.location.origin
                    } else if (results[neededIndex].class_name === 'DefaultPage') {
                        document.location.href = window.location.origin + '/blog?m=' + results[neededIndex].id
                    } else if (results[neededIndex].class_name === 'BlogPage') {
                        document.location.href = window.location.origin + '/blog-page?m=' + results[neededIndex].id
                    } else {
                        document.location.href = window.location.origin
                    }
                })
            })
        }
    }
})