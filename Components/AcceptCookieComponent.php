<?php

namespace Flute\Modules\AcceptCookie\Components;

use Flute\Core\Database\Entities\Page;
use Flute\Core\Support\FluteComponent;
use Flute\Modules\AcceptCookie\Providers\AcceptCookieProvider;

class AcceptCookieComponent extends FluteComponent
{
    public $isAccepted = false;

    public $hasPrivacyPolicy = false;

    public function mount()
    {
        $this->isAccepted = cookie()->has(AcceptCookieProvider::ACCEPT_COOKIE_KEY);
    }

    public function setAccepted(bool $accepted): void
    {
        $this->isAccepted = $accepted;

        cookie()->set(
            AcceptCookieProvider::ACCEPT_COOKIE_KEY,
            $accepted,
            carbon()->addYear()->timestamp,
            sameSite: 'Lax',
        );

        $this->skipRenderWithStatus(204);
    }

    public function render()
    {
        if ($this->isAccepted) {
            return;
        }

        $this->hasPrivacyPolicy = Page::findOne(['route' => '/privacy']) !== null;

        return $this->view('accept-cookie::components.cookie', [
            'hasPrivacyPolicy' => $this->hasPrivacyPolicy,
        ]);
    }
}
