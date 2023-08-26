<?php

namespace App\Variables\Sms;

use App\Events\Templates\EventWrapper;
use App\Models\User;

class ProcessUserPhoneChangeVariable extends SmsVariables
{
    public const VAR_SMS_CODE = '@VarSmsCode';
    public const VAR_PROCESS_URL = '@VarProcessUrl';

    public static function mockedVariables(array $data = []): array
    {
        $faker = \Faker\Factory::create();
        return array_merge($data, [
            self::VAR_SMS_CODE => $faker->numberBetween(100000, 999999),
            self::VAR_PROCESS_URL => $faker->url,
        ]);
    }

    public static function variablesFromEvent(EventWrapper $event): array
    {
        return array_merge(parent::variablesFromEvent($event), [
            self::VAR_SMS_CODE => $event->getUser()->sms_code,
            self::VAR_PROCESS_URL => route('user.process.phone', ['token' => $event->getUser()->process_token]),
        ]);
    }

    public static function getVariables(): array
    {
        return [
            self::VAR_SMS_CODE,
            self::VAR_PROCESS_URL
        ];
    }

    public static function assignableClass(): ?string
    {
        return User::class;
    }
}
