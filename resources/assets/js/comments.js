function bindReply() {
    rememberCommentFormPosition();
    $('body').on('click', '.comment__reply-link', function (e) {
        e.preventDefault();
        setReplyTo(this);
        return false
    });
}

// todo: add cancel button
function setReplyTo(reply_button) {
    let container = $(reply_button).closest('.comments__thread-container')[0];
    let id = container.dataset.id;
    let username = container.getElementsByClassName('comment__user-name')[0].textContent;
    let form = document.getElementsByClassName('comments__form')[0];
    let reply_to = $(form).find('[name="reply_to"]');
    if (reply_to.length) {
        reply_to[0].setAttribute('value', id);
    } else {
        $(form).prepend('<input name="reply_to" type="hidden" value="' + id + '">');
    }
    let textarea = form.getElementsByClassName('comments__form__text-field')[0];
    textarea.setAttribute('placeholder', 'Ваш ответ пользователю ' + username);
    //form.parentNode.removeChild(form);
    let comment_to_reply = container.getElementsByClassName('comment')[0];
    container.insertBefore(form, comment_to_reply.nextSibling)
    /*$('html, body').animate({
        scrollTop: $("#comments").offset().top - 2 * getRemSize()
    }, 500);*/
    $(form).scrollintoview({duration: 500});
    textarea.focus();
}

function rememberCommentFormPosition() {
    let form = document.getElementsByClassName('comments__form')[0];
    form.oldNeighbour = form.previousSibling;
}

function bindCommentsFormSubmit() {
    document.getElementsByClassName('comments__form')[0].addEventListener('submit', function (e) {
        e.preventDefault();
        tryToAddComment(this);
    });
}


function bindCommentEditFormSubmit() {

    $('body').on('submit', '.comment__edit-form', function (e) {
        e.preventDefault();
        tryToUpdateComment(this);
    });
}


function tryToUpdateComment(form) {
    let comment = getCommentByElement(form);
    let comment_number = comment.getElementsByClassName('comment__number')[0].innerHTML;
    let text_field = comment.getElementsByClassName('comment__text')[0];
    let button = $(comment).find('button[form="' + form.id + '"]')[0];
    Modifiers.addWaiting(button);
    let new_text = text_field.innerHTML;
    let formData = new FormData(form);
    formData.append('text', new_text);
    //console.log($(form).attr('action'));
    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            //console.log(data);
            Modifiers.removeWaiting(button);
            let updated_comment = htmlToDOM(data);
            updated_comment.getElementsByClassName('comment__number')[0].innerHTML = comment_number;
            comment.parentNode.replaceChild(updated_comment, comment);
        },

        cache: false,
        contentType: false,
        processData: false
    }).fail(function (xhr, status, error) {
        Modifiers.addFail(button);
        setTimeout(function () { // To have the time for class change
            // todo: replace with something better and concat all errors in string
            //console.log(xhr);
            showXhrErr(xhr, status, error);
            Modifiers.removeWaitingFail(button);
        }, 500);

    });
}


function bindCommentDelete() {
    $('body').on('click', '.comment__delete-button', function (e) {
        e.preventDefault();
        tryToDeleteComment(this);
    });
}

function bindCommentLike() {
    $('body').on('click', 'a.comment__likes__like', function (e) {
        e.preventDefault();
        tryToLikeComment(this);
    });
}

function bindLoadCommentEdit() {
    $('body').on('click', '.comment__change-button', function (e) {
        e.preventDefault();
        loadCommentEdit(this);
    });
}

function loadCommentEdit(button) {
    Modifiers.addWaiting(button);
    let comment = getCommentByElement(button);
    let text_element = comment.getElementsByClassName('comment__text')[0];



    $.ajax({
        url: $(button).attr('href'),
        type: 'GET',
        data: null,
        async: true,
        success: function (data) {
            let form = htmlToDOM(data);
            text_element.parentNode.replaceChild(form, text_element);

            form.getElementsByClassName('comment__edit__form__buttons__cancel')[0].addEventListener('click', function (e) {
                e.preventDefault();
                form.parentNode.replaceChild(text_element, form);
                Modifiers.removeWaiting(button);
                makeClickable(button);
            });
            let text_editable = comment.getElementsByClassName('comment__text')[0];
            Modifiers.removeWaiting(button);
            makeUnclickable(button);
            setTimeout(function () {
                text_editable.focus();
            }, 0);
        },
        error: function (xhr, status, error) {
            Modifiers.addFail(button);
            setTimeout(function () { // To have the time for class change
                //console.log(xhr);
                showXhrErr(xhr, status, error);
                Modifiers.removeWaitingFail(button);
            }, 500);
        },
        cache: false,
        contentType: false,
        processData: false
    });

}

function tryToAddComment(form) {
    Modifiers.addWaiting(form);
    let formData = new FormData(form);
    let reply_to = $(form).find('[name="reply_to"]')[0];
    //console.log(reply_to);
    reply_to = reply_to ? reply_to.value : null;

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            // todo: remove reply:to attr
            resetCommentForm(form);
            Modifiers.removeWaiting(form);
            let comment = htmlToDOM(data);
            let container = $('.comments__thread-container[data-id="' + reply_to + '"]')[0];
            if (!container) {
                container = $('.comments__items')[0];
            }
            comment.style.opacity = 0;
            container.appendChild(comment);
            $(comment).scrollintoview({duration: 500});
            setTimeout(function () {
                comment.style.display = 'none';
                comment.style.opacity = 1;
                $(comment).fadeIn();
            }, 500);

        },

        cache: false,
        contentType: false,
        processData: false
    }).fail(function (xhr, status, error) {
        Modifiers.addFail(form);
        setTimeout(function () { // To have the time for class change
            // todo: replace with something better and concat all errors in string
            //console.log(xhr);
            showXhrErr(xhr, status, error);
            Modifiers.removeWaitingFail(form);
        }, 500);

    });
}

function tryToDeleteComment(button) {
    Modifiers.addWaiting(button);
    let comment = getCommentByElement(button);
    //console.log(container, id, comment);
    $.ajax({
        url: $(button).attr('href'),
        type: 'DELETE',
        data: null,
        async: true,
        success: function (data, textStatus, jqXHR) {
            if (data.success === true) {
                let container = $(comment).closest('.comments__thread-container')[0];
                deleteComment(comment);
                setTimeout(function () {
                    if (isEmpty(container)) {
                        container.remove();
                    }
                }, 500);
            }
        },
        error: function (xhr, status, error) {
            Modifiers.addFail(button);
            setTimeout(function () { // To have the time for class change
                //console.log(xhr);
                showXhrErr(xhr, status, error);
                Modifiers.removeWaitingFail(button);
            }, 500);

        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function tryToLikeComment(button) {
    Modifiers.addWaiting(button);
    let comment = getCommentByElement(button);
    //console.log(container, id, comment);
    $.ajax({
        url: $(button).attr('href'),
        type: 'POST',
        data: null,
        async: true,
        success: function (data, textStatus, jqXHR) {
            if (data.success === true) {
                updateLikes(comment, data.likes);
                Modifiers.removeWaiting(button);
                makeUnclickable(button);
            }
        },
        error: function (xhr, status, error) {
            Modifiers.addFail(button);
            setTimeout(function () { // To have the time for class change
                //console.log(xhr);
                showXhrErr(xhr, status, error);
                Modifiers.removeWaitingFail(button);
            }, 500);

        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function deleteComment(comment) {
    $(comment).fadeOut(500);
    setTimeout(function () {
        comment.remove();
    }, 500);
}


function resetCommentForm(form) {
    $(form).find('.comments__form__text-field').val('');
    $(form).find('input[type="submit"]').blur();
    $(form).find('input[name="reply_to"]').remove();

    if(form.previousSibling) {
        form.oldNeighbour.parentNode.insertBefore(form, form.oldNeighbour);
    }
}



function updateLikes(comment, likes) {
    let num = comment.getElementsByClassName('comment__likes-num')[0];
    num.innerHTML = likes;
}


function getCommentByElement(el) {
    return $(el).closest('.comment')[0];
}