<?php

namespace Database\Seeders;

use App\Events\Templates\Mails\ResetPasswordAdminEvent;
use App\Events\Templates\Mails\ResetPasswordUserEvent;
use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        $this->createTemplates();
    }

    /**
     * Akcja dodająca szablony
     */
    public function createTemplates()
    {
        $templates = [
            [
                'event_name' => ResetPasswordAdminEvent::class,
                'subject' => 'Process reset password',
                'content' => 'Process reset password @VarAppName for admin user is start @VarProcessUrl',
            ],
            [
                'event_name' => ResetPasswordUserEvent::class,
                'subject' => 'Process reset password',
                'content' => 'Process reset password @VarAppName for user is start @VarProcessUrl',
            ],
        ];
        DB::transaction(function () use ($templates) {
            foreach ($templates as $template) {
                Template::firstOrCreate([
                    'event_name' => $template['event_name']
                ], [
                    'event_name' => $template['event_name'],
                    'subject' => $template['subject'],
                    'content' => $template['content'],
                ]);
            }
        });
    }
}
