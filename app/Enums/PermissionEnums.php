<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class PermissionEnums extends Enum
{
    public const HYPHEN = '-';
    public const CREATE_ACTION = 'create';
    public const READ_ACTION = 'read';
    public const UPDATE_ACTION = 'update';
    public const DELETE_ACTION = 'delete';
    public const FORCE_DELETE_ACTION = 'force-delete';
    public const RESTORE_ACTION = 'restore';

    public const CRUD_ACTIONS = [
        self::CREATE_ACTION,
        self::READ_ACTION,
        self::UPDATE_ACTION,
        self::DELETE_ACTION,
    ];

    public const ARCHIVE_ACTIONS = [
        self::FORCE_DELETE_ACTION,
        self::RESTORE_ACTION,
    ];

    public const ONLY_UPDATE = [
        self::READ_ACTION,
        self::UPDATE_ACTION,
    ];

    public const FULL_ACTIONS = [...self::CRUD_ACTIONS, ...self::ARCHIVE_ACTIONS];

    public const CRUD_PERMISSION_GROUP = [
        'user' => self::FULL_ACTIONS,
        'role' => [...self::CRUD_ACTIONS, ...['role-grant']],
        'admin' => self::CRUD_ACTIONS,
        'blog' => self::CRUD_ACTIONS,
    ];

    public static function getMiddleware(string $model, string $action): string
    {
        return 'can:' . self::getPermission($model, $action);
    }

    public static function getPermission(string $model, string $action): string
    {
        return $model . self::HYPHEN . $action;
    }
}
