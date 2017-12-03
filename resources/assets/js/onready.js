document.addEventListener('DOMContentLoaded', function () {
    
    $('body').on('change', ".registration-form__avatar__uploader__input", function () {
        previewAvatar($(".registration-form__avatar__uploader__input")[0]);

    });

    $('body').on('touchend', ".main-menu__open-button", function () {
        $('.main-menu__item').slideToggle();

    });

    bindLoginAjax();

    bindRegisterAjax();

    $('.post-preview_catalogue__more-items').click(function (e) {
        preventDefault(e);
        loadOthers(this, $('.post-preview_catalogue__items'));
        return false;
    });

    $('.post-preview_main__more-items').on('click', function (e) {
        preventDefault(e);
        loadOthers(this, $('.post-preview_main__items'));
        return false;
    });


    $('.login-link').click(function (e) {
        e.preventDefault();
        loadLoginForm();
        return false;
    });

    $('.register-link').click(function (e) {
        e.preventDefault();
        loadRegForm();
        return false;
    });


    $('body').on('click', '.login-window__close', function (e) {
        e.preventDefault();
        hideLoginForm();
        return false;
    });

    $('body').on('click', '.registration-window__close', function (e) {
        e.preventDefault();
        hideRegForm();
        return false;
    });


    $('body').on('click', '.request-password-window__close', function (e) {
        e.preventDefault();
        hideRequestPasswordForm();
        return false;
    });


    bindLoadRequestPassword();


    enableMainPhotoExpand();

    enableScrollToTop();

    enableThumbScrolling();

    enableScrollTo();

    $('body').on('mouseenter', '.main-menu__submenu', function () {
        showSubmenu(this);
        return false;
    })
        .on('mouseleave', '.main-menu__submenu', function () {
            hideSubmenu(this);
            return false;
        })
        .on('touchstart', '.main-menu__submenu__title', function () {
            triggerSubmenu(this);
            return false;
        });

    $('.spoiler__button').click(function () {
        switchSpoiler(this)
        return false;
    });


    try {
        bindReply();

        bindCommentsFormSubmit();

        bindCommentDelete();

        bindCommentLike();

        bindLoadCommentEdit();

        bindCommentEditFormSubmit();

    } catch (e) {

    }

    bindSearch();

    bindShowArticles();

});