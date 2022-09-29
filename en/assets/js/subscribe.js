$(document).ready(function() {

    var phoneMask = IMask(
        document.getElementById('user_code'), {
            mask: '000-000'
        });

    $('.membership_btn').on('click', function() {
        $('.membership_start').addClass('animate__animated animate__backOutUp')
        $('.membership_phone').addClass('animate__animated animate__backInUp show')
        setTimeout(() => {
            $('.membership_start').removeClass('show')
            $('.membership_container').css({
                height: '165px'
            })
        }, 700)
    })

    $('#membership_code_btn').submit(function(event) {
        event.preventDefault();
        $('.membership_container').css({
            height: '200px'
        })
        $('.get_code').removeClass('show')
        $('.sub_loader').addClass('show')

        let obj = {
            email: $('#user_email').val()
        }

        $.ajax({
            method: "POST",
            url: `subscribe/create`,
            data: JSON.stringify(obj),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
        }).done(function(data) {
            console.log(data)
            $('#user_email').attr('readonly', true)
            $('.membership_container').css({
                height: '285px'
            })
            $('.sub_loader').removeClass('show')
            $('.membership_code').addClass('animate__animated animate__backInUp show')
        })
    })

    $('#membership_check_btn').submit(function(event) {
        event.preventDefault();
        $('.confirm_loader').addClass('show')
        $('.confirm_code').removeClass('show')

        let obj = {
            email: $('#user_email').val(),
            activation_code: $('#user_code').val().split('-').join('')
        }

        $.ajax({
            method: "POST",
            url: `subscribe`,
            data: JSON.stringify(obj),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
        }).done(function(data) {
            if (data === 0) {
                $('.membership_container').css({
                    height: '105px'
                })
                $('.membership_phone').removeClass('show')
                $('.membership_code').removeClass('show')
                $('.membership_start').removeClass('show')
                $('.membership_finish').addClass('show')

                $('.membership_container').removeClass('animate__animated animate__shakeX animate__delay-1s')
                $('.membership_container').addClass('animate__animated animate__zoomOutRight animate__delay-3s')

                localStorage.setItem('email', obj.email)

                setTimeout(() => {
                    closeDialog();
                }, 3600)
            } else if (data === 533) {
                $('#user_code').css({
                    border: '1px solid red'
                })
            } else if (data === 534) {
                $('#user_email').css({
                    border: '1px solid red'
                })

            }
        })
        $('.confirm_loader').removeClass('show')
    })

    $('.membership_close').on('click', function() {
        closeDialog();
    })


    function closeDialog() {
        $('.membership_container').removeClass('show')
        $('.membership_phone').removeClass('show')
        $('.membership_code').removeClass('show')
        $('.membership_start').addClass('show')
        $('.get_code').addClass('show')
    }
})