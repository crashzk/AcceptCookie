<div class="cookie-notice" data-cookie-container aria-live="polite">
    <div class="cookie-notice__body">
        <span class="cookie-notice__icon">
            <x-icon path="ph.bold.cookie-bold" />
        </span>
        <p class="cookie-notice__text">{{ __('accept-cookie.description') }}</p>
    </div>
    <div class="cookie-notice__footer">
        @if ($hasPrivacyPolicy)
            <a class="cookie-notice__link" href="{{ url('/privacy') }}">{{ __('accept-cookie.learn_more') }}</a>
        @endif
        <button type="button" class="cookie-notice__btn" data-accept-cookie>
            {{ __('accept-cookie.accept') }}
        </button>
    </div>
</div>

<script>
    (function() {
        var container = document.querySelector('[data-cookie-container]');
        if (!container) return;

        var acceptBtn = container.querySelector('[data-accept-cookie]');
        if (!acceptBtn) return;

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
        }

        acceptBtn.addEventListener('click', function() {
            try {
                setCookie('accept-cookie', '1', 365);
            } catch (e) {}

            container.classList.add('cookie-notice--out');

            var remove = function() {
                if (container && container.parentNode) {
                    container.parentNode.removeChild(container);
                }
            };
            container.addEventListener('animationend', remove, { once: true });
            setTimeout(remove, 500);
        });
    })();
</script>
