<?php

declare(strict_types = 1);

namespace App\Events\Templates;

use App\Models\Admin;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class CommonResetPassword
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private Admin $admin
    ) {
    }

    public function getUser(): Admin
    {
        return $this->admin;
    }
}
