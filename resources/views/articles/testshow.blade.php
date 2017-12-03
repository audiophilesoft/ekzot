@extends('entries.show')

@section('content')

    <main class="content_article">


        <article class="article">
            <header class="article__header">
                <h1 class="article__title">О прививках сеянцев цитрусовых</h1>
            </header>
            <div class="article__content">
                <p>Позволю себе небольшое вступление (в виде истории из собственного опыта). Лет 19 назад один из моих друзей увлекся (не без моей помощи) цитрусоводством. Я подарил ему небольшой саженец Павловского лимона. В то время мы работали вместе, и от лавины его вопросов по поводу правильного ухода за лимоном у меня просто голова шла кругом. Он настолько скрупулезно подходил к проблеме выращивания, что я не сомневался в его успехе. И вот однажды — как гром среди ясного неба — мой друг сообщает, что его лимон погиб. В срочном порядке я выдвигаюсь на место гибели нашего питомца, чтобы произвести расследование. На вопросы «Поливал? Удобрял? Опрыскивал? Омывал? Досвечивал? Переваливал? Не подвергал ли? Не переставлял ли? Не забывал ли?» — я получил утвердительный ответ.То есть, весь комплекс ухода за несчастным лимоном производился. Я долго думал о причине гибели и пришел к определенному выводу. Приобняв друга, я сказал ему «А лимон-то погиб от чрезмерного ухода!».</p>
                <p>По сей день, встречаясь и беседуя с другом о растениях, мы с ним в шутку вспоминаем этот случай — геройски погиб от чрезмерного ухода.</p>
                <p>Дорогие мои читатели, чтобы в вашей практике подобного не случалось, хочу порекомендовать вам не заниматься буквоедством инструкций, а попытаться в процессе выращивания почувствовать вашего питомца. Со временем (ко мне это пришло на пятый-седьмой год) вы научитесь чувствовать свои растения и, глядя на них, понимать, что им нужно, чего не хватает. Для этого необходимо как можно чаще общаться с растением — они такие же живые как и мы, они не механизмы.Желаю Вам успехов.</p>
            </div>
            <footer class="article__footer">
                <div class="article__footer__wrapper">
                    <div class="article__footer__date"><span class="article__footer__date__value">11.01.2017</span>
                    </div>
                    <div class="article__footer__views-num"><span class="article__footer__views-num__value">1576</span>
                    </div>
                    <div class="article__footer__comments-num">
                        <span class="article__footer__comments-num__value">10</span>
                    </div>
                </div>
            </footer>
        </article>

        <section class="comments_article">
            <h2 class="comments__title">Комментарии</h2>


            <div class="comments__not-registered-message">Хотите добавить комментарий? Пожалуйста,
                <a href="#" class="comments__register-link">зарегистрируйтесь</a></div>

            <form action="/" class="comments__form">
                <textarea class="comments__form__text-field" maxlength="4096" placeholder="Введите текст комментария" rows="4"></textarea>
                <input type="submit" class="comments__form__submit-button" value="Отправить">

            </form>
            <div class="comments__items">
                <div class="comments__thread-container">
                    <div class="comment">
                        <header class="comment__header">
                            <a class="comment__number" href="#">1</a>
                            <div class="comment__avatar"></div>
                            <div class="comment__user-name">Даниил Иванович</div>
                            <div class="comment__datetime">сегодня в 16:56</div>
                            <div class="comment__manage-buttons">
                                <a href="#change" class="comment__change-button"> </a><a href="#delete" class="comment__delete-button"></a>
                            </div>
                        </header>
                        <div class="comment__text">Когда я вижу человека, мне хочется ударить его по морде. Так приятно бить по морде человека! Я сижу у себя в комнате и ничего не делаю. Вот кто-то пришел ко мне в гости, он стучится в мою дверь. Я говорю: “Войдите!” Он входит и говорит: “Здравствуйте! Как хорошо, что я застал вас дома!” А я его стук по морде, а потом еще сапогом в промежность. Мой гость падает навзничь от страшной боли. А я ему каблуком по глазам! Дескать, нечего шляться, когда не звали! А то еще так. Я предлагаю гостю выпить чашку чая. Гость соглашается, садится к столу, пьет чай и что-то рассказывает. Я делаю вид, что слушаю его с большим интересом, киваю головой, ахаю, делаю удивленные глаза и смеюсь. Гость, польщенный моим вниманием, расходится все больше и больше. Я спокойно наливаю полную чашку кипятка и плещу кипятком гостю в морду. Гость вскакивает и хватается за лицо. А я ему говорю: “Больше нет в душе моей добродетели. Убирайтесь вон!” И я выталкиваю гостя.</div>
                        <footer class="comment__footer">
                            <a class="comment__reply-link" href="#">Ответить</a>
                            <a class="comment__likes__like" href="#like"> </a>
                            <div class="comment__likes-num">150</div>
                        </footer>
                    </div>
                </div>


                <div class="comments__thread-container">
                    <div class="comment">
                        <header class="comment__header">
                            <a class="comment__number" href="#">1</a>
                            <div class="comment__avatar"></div>
                            <div class="comment__user-name">Даниил Иванович</div>
                            <div class="comment__datetime">сегодня в 17:51</div>
                            <div class="comment__manage-buttons">
                                <a href="#change" class="comment__change-button"> </a><a href="#delete" class="comment__delete-button"></a>
                            </div>
                        </header>
                        <div class="comment__text">Одна старуха от чрезмерного любопытства вывалилась из окна, упала и разбилась.</div>
                        <footer class="comment__footer">
                            <a class="comment__reply-link" href="#">Ответить</a>
                            <a class="comment__likes__like" href="#like"> </a>
                            <div class="comment__likes-num">8</div>
                        </footer>
                    </div>

                    <div class="comments__thread-container">
                        <div class="comment">
                            <header class="comment__header">
                                <a class="comment__number" href="#">2</a>
                                <div class="comment__avatar"></div>
                                <div class="comment__user-name">Даниил Иванович</div>
                                <div class="comment__datetime">сегодня в 17:52</div>
                                <div class="comment__manage-buttons">
                                    <a href="#change" class="comment__change-button"> </a><a href="#delete" class="comment__delete-button"></a>
                                </div>
                            </header>
                            <div class="comment__text">Из окна высунулась другая старуха и стала смотреть на разбившуюся, но, от чрезмерного любопытства, тоже вывалилась из окна, упала и разбилась.</div>
                            <footer class="comment__footer">
                                <a class="comment__reply-link" href="#">Ответить</a>
                                <a class="comment__likes__like" href="#like"> </a>
                                <div class="comment__likes-num">15</div>
                            </footer>
                        </div>


                        <div class="comments__thread-container">
                            <div class="comment">
                                <header class="comment__header">
                                    <a class="comment__number" href="#">3</a>
                                    <div class="comment__avatar"></div>
                                    <div class="comment__user-name">Даниил Иванович</div>
                                    <div class="comment__datetime">сегодня в 17:54</div>
                                    <div class="comment__manage-buttons">
                                        <a href="#change" class="comment__change-button"> </a><a href="#delete" class="comment__delete-button"></a>
                                    </div>
                                </header>
                                <div class="comment__text">Потом из окна вывалилась третья старуха, потом четвертая, потом пятая.</div>
                                <footer class="comment__footer">
                                    <a class="comment__reply-link" href="#">Ответить</a>
                                    <a class="comment__likes__like" href="#like"> </a>
                                    <div class="comment__likes-num">29</div>
                                </footer>
                            </div>


                            <div class="comments__thread-container">
                                <div class="comment">
                                    <header class="comment__header">
                                        <a class="comment__number" href="#">4</a>
                                        <div class="comment__avatar"></div>
                                        <div class="comment__user-name">Даниил Иванович</div>
                                        <div class="comment__datetime">сегодня в 17:58</div>
                                        <div class="comment__manage-buttons">
                                            <a href="#change" class="comment__change-button"> </a><a href="#delete" class="comment__delete-button"></a>
                                        </div>
                                    </header>
                                    <div class="comment__text">Когда вывалилась шестая старуха, мне надоело смотреть на них, и я пошел на мальцевский рынок, где, говорят, одному слепому подарили вязаную шаль.</div>
                                    <footer class="comment__footer">
                                        <a class="comment__reply-link" href="#">Ответить</a>
                                        <a class="comment__likes__like" href="#like"> </a>
                                        <div class="comment__likes-num">57</div>
                                    </footer>
                                </div>


                            </div>

                        </div>

                    </div>


                </div>
            </div>
            </div>


        </section>

    </main>


@endsection