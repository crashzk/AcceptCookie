<div class="flute-cookie-notification" data-cookie-container aria-live="polite">
    <div class="flute-cookie-notification__wrapper">
        <div class="flute-cookie-notification__content">
            <h6 class="flute-cookie-notification__title">{{ __('accept-cookie.title') }}</h6>

            <p class="flute-cookie-notification__description">
                {{ __('accept-cookie.description') }}

                @if ($hasPrivacyPolicy)
                    <a class="flute-cookie-notification__learn" href="{{ url('/privacy') }}">
                        {{ __('accept-cookie.learn_more') }}
                    </a>
                @endif
            </p>
        </div>

        <div class="flute-cookie-notification__actions">
            <x-button class="flute-cookie-notification__accept-btn" data-accept-cookie>
                {{ __('accept-cookie.accept') }}
            </x-button>
        </div>
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

            container.classList.add('flute-cookie-notification--hiding');

            var remove = function() {
                if (container && container.parentNode) {
                    container.parentNode.removeChild(container);
                }
            };
            container.addEventListener('animationend', remove, {
                once: true
            });
            setTimeout(remove, 420);
        });
    })();
</script>
