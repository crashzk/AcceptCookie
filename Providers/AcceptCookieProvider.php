<?php

namespace Flute\Modules\AcceptCookie\Providers;

use Flute\Core\Support\ModuleServiceProvider;
use Flute\Modules\AcceptCookie\Components\AcceptCookieComponent;

class AcceptCookieProvider extends ModuleServiceProvider
{
    public const ACCEPT_COOKIE_KEY = 'accept-cookie';

    public array $extensions = [];

    public function boot(\DI\Container $container): void
    {
        if (is_admin_path()) {
            return;
        }

        $this->bootstrapModule();

        $this->loadScss('Resources/assets/sass/accept-cookie.scss');

        $this->loadViews('Resources/views', 'accept-cookie');

        $this->loadComponent(AcceptCookieComponent::class, 'accept-cookie');

        if (!cookie()->has(self::ACCEPT_COOKIE_KEY)) {
            template()->prependTemplateToSection('footer', 'accept-cookie::index');
        }
    }

    public function register(\DI\Container $container): void
    {
    }
}
