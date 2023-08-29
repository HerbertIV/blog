<?php

namespace App\Providers;

use App\Channels\EmailChannel;
use App\Events\Templates\Mails\ResetPasswordAdminEvent;
use App\Events\Templates\Mails\ResetPasswordUserEvent;
use App\Facades\Template;
use App\Variables\Mails\ResetPasswordAdminVariable;
use App\Variables\Mails\ResetPasswordUserVariable;
use Illuminate\Support\ServiceProvider;

class TemplateEmailServiceProvider extends ServiceProvider
{
    public function register()
    {
        Template::register(
            ResetPasswordAdminEvent::class,
            ResetPasswordAdminVariable::class,
            EmailChannel::class
        );
        Template::register(
            ResetPasswordUserEvent::class,
            ResetPasswordUserVariable::class,
            EmailChannel::class
        );
    }
}
