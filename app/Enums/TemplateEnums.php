<?php

namespace App\Enums;

use App\Events\Templates\Mails\ResetPasswordUserEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use BenSampo\Enum\Enum;

class TemplateEnums extends Enum
{
    public const TEMPLATE_EVENTS_TO_LIST = [
        ResetPasswordUserEvent::class => 'Process changing email for user',
        ProcessUserPhoneChangeEvent::class => 'Process changing phone for user',
    ];
}
