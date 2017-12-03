/*class WindowFormHandler
{

    constructor(prefix)
    {
        this.prefix = prefix;
    }

    loadWindowForm(classname = null)
    {

    }

    append()
    {

    }

    appendTo()
    {

    }
}
*/

function loadLoginForm() {
    if (!$(".login-window__background").length) {
        $.get('/login', {}, function (data) {
            //console.log(data);
            $('body').append(data);
            $('.login-window__background').fadeIn();
        });
    } else {
        $('.login-window__background').fadeIn();
    }
}

function loadRegForm() {
    if (!$(".registration-window__background").length) {
        $.get('/register', {}, function (data) {
            //console.log(data);
            $('body').append(data);
            $('.registration-window__background').fadeIn();
        });
    } else {
        $('.registration-window__background').fadeIn();
    }
}

function hideLoginForm() {
    $('.login-window__background').fadeOut();
}

function hideRegForm() {
    $('.registration-window__background').fadeOut();
}

function hideRequestPasswordForm() {
    $('.request-password-window').fadeOut();
}

function hideResetPasswordForm() {
    $('.reset-password-window').fadeOut();
}


function tryToLogin(login_window) {
    var form = $('.login-form')[0];
    var formData = new FormData(form);

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            login_window.className += '_success';
            location.reload(true);
        },
        cache: false,
        contentType: false,
        processData: false
    }).fail(function (xhr, status, error) {
        login_window.className += '_fail';
        setTimeout(function () { // To have the time for class change
            // todo: replace with something better and concat all errors in string
            alert(xhr.responseJSON.email || 'Извините, произошла неизвестная ошибка');
            login_window.className = login_window.className.replace('_waiting_fail', '');
        }, 500);

    });
}


function tryToRegister(reg_window) {
    let form = $('.registration-form')[0];
    var formData = new FormData(form);
    formData.append('g-recaptcha-response', grecaptcha.getResponse());

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            reg_window.className += '_success';
            setTimeout(function () {
                alert('Спасибо, Вы успешно зарегистрированы. На указанную почту отправлена ссылка для активации аккаунта.');
                location.reload(true);
            }, 500);
        },
        cache: false,
        contentType: false,
        processData: false
    }).fail(function (xhr, status, error) {
        reg_window.className += '_fail';
        setTimeout(function () { // To have the time for class change\
            showXhrErr(xhr, status, error);
            Modifiers.removeWaitingFail(reg_window);
            grecaptcha.reset();
        }, 500);

    });
}


function tryToRequestPassword(req_window) {
    let form = $('.request-password-form')[0];
    var formData = new FormData(form);
    formData.append('g-recaptcha-response', grecaptcha.getResponse());

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            req_window.className += '_success';
            setTimeout(function () {
                alert('На указанную почту была отправлена ссылка для восстановления пароля.');
                req_window.style.display = 'none';
                $('.login-window__background').fadeOut();
            }, 500);
        },
        cache: false,
        contentType: false,
        processData: false
    }).fail(function (xhr, status, error) {
        req_window.className += '_fail';
        setTimeout(function () { // To have the time for class change
            alert(jsonErrorsToStr(xhr.responseText).trim() || 'Извините, произошла неизвестная ошибка.');
            req_window.className = req_window.className.replace('_waiting_fail', '');
            grecaptcha.reset();
        }, 500);

    });
}




function tryToResetPassword(reset_window) {
    let form = $('.reset-password-form')[0];
    var formData = new FormData(form);

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            reset_window.className += '_success';
            setTimeout(function () {
                alert('Ваш пароль успешно изменён.');
                window.location = '/';
            }, 500);
        },
        cache: false,
        contentType: false,
        processData: false
    }).fail(function (xhr, status, error) {
        reset_window.className += '_fail';
        setTimeout(function () { // To have the time for class change
            alert(jsonErrorsToStr(xhr.responseText) || 'Извините, произошла неизвестная ошибка.');
            reset_window.className = reset_window.className.replace('_waiting_fail', '');
        }, 500);

    });
}

function jsonErrorsToStr(errors) {
    errors = JSON.parse(errors).errors;
    let err_str = '';
    for (let error in errors) {
        if (errors.hasOwnProperty(error)) {
            for (let sub in errors[error]) {
                if (error.hasOwnProperty(sub)) {
                    err_str += errors[error][sub] + ' ';
                }
            }
        }
    }
    return err_str.trim();
}

function bindLoginAjax() {
    $('body').on('submit', '.login-form', function (e) {
        e.preventDefault();
        var login_window = $('.login-window')[0];
        login_window.className += '_waiting';
        tryToLogin(login_window);
        return false;
    });
}

function bindRegisterAjax() {
    $('body').on('submit', '.registration-form', function (e) {
        e.preventDefault();
        var reg_window = $('.registration-window')[0];
        reg_window.className += '_waiting';
        tryToRegister(reg_window);
        return false;
    });
}

function previewAvatar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.registration-form__avatar__preview img').attr('src', e.target.result).css('background', 'none');
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function loadRequestPassword(link) {
    let login_window = $('.login-window')[0];
    let orig_class = login_window.className;
    login_window.className += '_waiting';
    if (!$('.request-password-window').length) {
        $.get(link, {}, function (data) {
            //console.log(data);
            $('.login-window__background').append(data);
            login_window.className = orig_class;
            //$(login_window).fadeOut();
            $('.request-password-window').fadeIn();
        });
    } else {
        login_window.className = orig_class;
        //$(login_window).fadeOut();
        $('.request-password-window').fadeIn();
    }
}

function bindLoadRequestPassword() {

    $('body').on('click', '.forgot-password-link', function (e) {
        e.preventDefault();
        loadRequestPassword($(this).attr('href'));
        return false;
    });


    $('body').on('submit', '.request-password-form', function (e) {
        e.preventDefault();
        var req_window = $('.request-password-window')[0];
        req_window.className += '_waiting';
        tryToRequestPassword(req_window);
        return false;
    });

}


function showResetPasswordWindow() {
    let target = document.getElementsByClassName('reset-password-window__background')[0];
    window.onload = function () {
        $(target).fadeIn(500);

        $('.reset-password-window__close').on('click',function () {
            $(target).fadeOut();
        });

        $('.reset-password-form').on('submit', function (e) {
            e.preventDefault();
            let reset_window = $('.reset-password-window')[0];
            reset_window.className += '_waiting';
            tryToResetPassword(reset_window);
            return false;
        });

    };


}