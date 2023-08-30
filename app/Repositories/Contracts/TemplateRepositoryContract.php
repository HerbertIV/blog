<?php

namespace App\Repositories\Contracts;


use Illuminate\Database\Eloquent\Builder;

interface TemplateRepositoryContract extends BaseRepositoryContract
{
    public function findByEvent(string $event): Builder;
}
