function calculateSubmenuMargins(parent, target) {
    var parentWidth = getComputedStyle(parent).width;
    var targetWidth = getComputedStyle(target).width;
    //console.log(parentWidth);
    //console.log(targetWidth);


    if (parseInt(parentWidth) > parseInt(targetWidth) && !target.marginComputed) {

        var child = $(target).find(".main-menu__submenu__items")[0];
        var margin = (parseInt(parentWidth) - parseInt(targetWidth)) / 2;
        var matrix = $.map(
            getComputedStyle(child).transform //get computed transform value, e.g.: matrix(1, 0, 0, 1, 1000, 0)
                .slice(7, -1)    //strip leading "matrix(" and trailing ")"
                .split(', '),    //split values into an array
            Number //map to numbers
        );
        //console.log(margin);
        matrix[4] += margin;
        child.style.transform = 'matrix(' + matrix.join(', ') + ')';
        target.marginComputed = true;
    }
}

// todo: adapt for touchpads
function showSubmenu(button) {



    //console.log(this);
    var target = $(button).find(".main-menu__submenu__wrapper")[0];    calculateSubmenuMargins(button, target);
    target.style.display = 'block';
}

function hideSubmenu(button) {
    //console.log(this);
    var target = $(button).find(".main-menu__submenu__wrapper")[0];
    target.style.display = 'none';
}

function triggerSubmenu(button) {
    var target = $(button.parentNode).find(".main-menu__submenu__wrapper")[0];
    target.style.display = (getComputedStyle(target).display !== 'none') ? 'none' : 'block';
}


function switchSpoiler(button) {

    var target = button.parentNode;
    var target2 = $(target).find(".spoiler__text")[0];
    $(target2).slideToggle();

}

function enableThumbScrolling() {
    let scroller = $(".thumbs-scroller");
    let container = $(".thumbs-scroller > div");

    let scroller_width = $(scroller).outerWidth(false);
    let container_width = 0;

    container.children('a').each(function (i) {
        container_width += $(this).outerWidth(true);
    });

    // Necessary for touchpad scrolling:
    container.css('width', container_width);

    let pos_a;
    let pos_b;
    let pointer_pos_percents;
    let pointer_pos;
    let container_shift;

    scroller.mousemove(function (e) {
        // Position of mouse pointer at the scroller box
        pointer_pos = (e.pageX - this.offsetLeft);
        // Position in percents
        pointer_pos_percents = pointer_pos / scroller_width;
        container_shift = -(((container_width - scroller_width) - scroller_width) * (pointer_pos_percents));
        pos_a = pointer_pos - container_shift;
        pos_b = container_shift - pointer_pos;

        if (pointer_pos > container_shift) {
            container.css("right", (pos_a > container_width / 2) ? container_width / 2 : pos_a);
        } else {
            container.css("right", -pos_b);
        }
    });

    scroller.mouseleave(function () {
        container.css("right", (pointer_pos_percents < 0.5) ? 0 : container_width - scroller_width);
    });
}


function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}


function loadOthers(button, target) {
    button.className += ' loading';

    var loc = window.location.href.split('?');
    var url = button.getAttribute('href') + '?' + loc[1];

    $.get(url, function (data) {target.append(data);
        $(button).fadeOut();

    })
}


function enableScrollToTop() {
    $(window).scroll(function () {
        if (Math.round($(window).scrollTop()) + $(window).height() == getDocHeight() && getDocHeight() > screen.height * 1.5) {
            $('.to-top').fadeIn();
        } else {

            $('.to-top').fadeOut();

        }
    });

    $('.to-top').click(function () {

        $("html, body").animate({scrollTop: 0}, "slow");

    });

}

function enableScrollTo() {
    "use strict";
    $(".scroll-to").click(function (e) {
        e.preventDefault();
        let target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: ($(target).offset().top)
        }, 1000);
    });
}

function bindSearch() {
    $('.site_search__form').submit(function (e) {
        runGoogleSearch(this);
        return false;
    });
}

function runGoogleSearch(form) {
    let loc = form.action;
    loc += '?q=site:ekzot.com%20'+form.getElementsByClassName('site_search__text-field')[0].value;
    window.open(loc);
}



function enableMainPhotoExpand() {
    let target = '.photo__expand';
    $('.photo > *:not(' + target + ')').mouseenter(function () {
        $(target).css('display', 'none');
    }).mouseleave(function () {
        $(target).css('display', 'initial');
    });
}

class Modifiers {
    static add(el, modifier) {
        if (modifier.constructor === Array) {
            modifier.forEach((item, i, arr) => {
                el.className += '_' + arr[i];
            });
        } else {
            el.className += '_' + modifier;
        }
    }

    static remove(el, modifier) {

        if (modifier.constructor === Array) {
            modifier.forEach((item, i, arr) => {
                el.className = el.className.replace('_' + arr[i], '');
            });
        } else {
            el.className = el.className.replace('_' + modifier, '');
        }
    }

    static addFail(el) {
        return this.add(el, 'fail');
    }

    static removeFail(el) {
        return this.remove(el, 'fail');
    }

    static addWaiting(el) {
        return this.add(el, 'waiting');
    }

    static removeWaiting(el) {
        return this.remove(el, 'waiting');
    }

    static removeWaitingFail(el) {
        return this.remove(el, ['waiting', 'fail']);
    }
}

function showXhrErr(xhr, status, error) {
    alert(jsonErrorsToStr(xhr.responseText).trim() || 'Извините, ошибка на стороне сервера ('+error+'). Мы уже уведомлены и cкоро всё починим.');
}

function htmlToDOM(html) {
    let temp = document.createElement("div");
    temp.innerHTML = html;
    return temp.firstChild;
}

function getRemSize() {
    return parseFloat(getComputedStyle(document.documentElement).fontSize);
}


function isEmpty(el) {
    return !Boolean(el.innerHTML.trim());
}



function makeUnclickable(el) {
    el.style.pointerEvents = 'none';
}

function makeClickable(el) {
    el.style.pointerEvents = 'initial';
}

function bindShowArticles() {
    $('body').on('click',  '[href="#articles"]', function (e) {
        showArticles();
        return false;
    });
}

function showArticles() {
    let target = $('.main-menu');
    $('#articles')[0].style.display = 'block';
    $('html, body').animate({
        scrollTop: (target.offset().top)
    }, 1000);
}

function preventDefault(event) {
    event.preventDefault ? event.preventDefault() : (event.returnValue = false);
}