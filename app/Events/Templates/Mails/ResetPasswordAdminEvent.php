<?php

namespace App\Events\Templates\Mails;

use App\Models\Admin;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordAdminEvent
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
