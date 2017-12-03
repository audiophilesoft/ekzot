<footer class="footer">
    <div class="footer__top-line" id="contacts">
        <div class="footer__name">
            <div class="footer__content-container">Ковриженко Виктор&nbsp;Васильевич</div>
        </div>
        <div class="footer__email">
            <div class="footer__content-container"><a href="mailto:kvv@ekzot.com">kvv@ekzot.com</a></div>
        </div>
        <div class="footer__phone">
            <div class="footer__content-container"><a href="tel:+380664771984">+38&nbsp;066&nbsp;4771984</a> <a href="tel:+380970035710">+38&nbsp;097&nbsp;0035710</a></div>
        </div>
        {{-- Label here for some genius users who click on icon instead of link --}}
        <label for="show_address" class="footer__map">
            <div class="footer__content-container">карта<br>проезда</div>
            <input type="checkbox" id="show_address" class="address-window__show-switcher">@include('common.address_window')
        </label>
        <div class="footer__social"><a class="footer__social-button footer__facebook-button"  title="Наша страница на Facebook" href="https://www.facebook.com/ekzot.ua/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34" style="fill:#2D2D2D">
                    <path d="M17 0C7.611 0 0 7.643 0 17.071c0 8.456 6.129 15.459 14.165 16.815V20.633h-4.101v-4.77h4.1v-3.516c0-4.08 2.483-6.304 6.108-6.304 1.736 0 3.228.13 3.662.187v4.265l-2.515.001c-1.971 0-2.351.94-2.351 2.321v3.044h4.703l-.613 4.77h-4.09V34C27.479 32.972 34 25.79 34 17.066 34 7.643 26.389 0 17 0z"/>
                </svg>
            </a><a class="footer__social-button footer__viber-button" href="//invite.viber.com/?g=H5dzF4019UZ-Zl5ubwyFvtsisdmo0bFz" title="Наш чат в Viber"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 42.5 42.5" style="fill:#2D2D2D"><title>viber icon</title><path d="M21.25 0A21.25 21.25 0 0 0 0 21.25a21.25 21.25 0 0 0 21.25 21.252A21.25 21.25 0 0 0 42.5 21.25 21.25 21.25 0 0 0 21.25 0zm-.504 10.297c.286-.039.618.036.836.006 5.755.192 10.71 5.324 10.64 10.869-.004.544.157 1.35-.636 1.334-.793-.017-.588-.833-.658-1.377-.762-5.885-3.525-8.664-9.516-9.56h-.004c-.497-.073-1.255.034-1.215-.606.028-.476.267-.628.553-.666zm-8.238.625c.252-.002.503.041.756.133 1.22.438 4.305 4.582 4.375 5.822.053.948-.61 1.465-1.268 1.898-1.243.825-1.25 1.866-.719 3.03 1.198 2.63 3.247 4.436 5.9 5.61.964.424 1.882.382 2.54-.587 1.172-1.73 2.606-1.645 4.176-.57.783.54 1.58 1.066 2.33 1.652l.004-.004c1.015.8 2.297 1.463 1.691 3.137-.627 1.742-2.817 3.494-4.682 3.477-.265-.072-.784-.15-1.25-.344-8.19-3.442-14.143-9.078-17.523-17.178-1.138-2.714.047-5.004 2.906-5.943.257-.085.511-.131.764-.133zm9.176 2.168c.279-.023.612.06.9.094 3.695.434 6.714 3.556 6.684 6.994-.056.408.187 1.1-.489 1.203-.91.136-.735-.676-.822-1.2-.605-3.577-1.896-4.89-5.596-5.697-.544-.119-1.385-.076-1.25-.853.068-.39.293-.518.573-.541zm1.24 2.902c1.639-.038 3.559 1.878 3.533 3.535.017.454-.034.93-.584.994-.397.047-.655-.28-.695-.68-.148-1.477-.951-2.35-2.467-2.587-.453-.068-.903-.213-.69-.813.14-.398.52-.439.903-.449z" stroke-width=".04"/></svg></a>{{--<a class="footer__social-button footer__twitter-button" href="//twitter.com">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                    <path d="M17 0C7.626 0 0 7.626 0 17c0 9.373 7.626 17 17 17 9.373 0 17-7.627 17-17 0-9.374-7.626-17-17-17zm7.584 13.11c.007.168.011.337.011.507 0 5.17-3.934 11.131-11.133 11.131-2.21 0-4.267-.646-5.998-1.756.306.036.618.054.933.054 1.834 0 3.52-.625 4.86-1.674a3.917 3.917 0 0 1-3.655-2.718 3.944 3.944 0 0 0 1.766-.066 3.913 3.913 0 0 1-3.138-3.837v-.05c.528.293 1.131.47 1.772.49a3.91 3.91 0 0 1-1.74-3.256c0-.718.193-1.39.53-1.968a11.11 11.11 0 0 0 8.064 4.09 3.913 3.913 0 0 1 6.668-3.57 7.81 7.81 0 0 0 2.485-.95 3.93 3.93 0 0 1-1.722 2.165 7.779 7.779 0 0 0 2.247-.616 7.87 7.87 0 0 1-1.95 2.023z"/>
                </svg>
            </a>--}}</div>
    </div>
    <div class="footer__bottom-line"><span class="copyright">2017 «Экзот»</span></div>
</footer>