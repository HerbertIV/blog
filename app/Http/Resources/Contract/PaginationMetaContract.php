<?php

namespace App\Http\Resources\Contract;

use OpenApi\Attributes as OT;

#[OT\Schema(
    schema: 'PaginationMeta',
    title: 'Pagination Meta',
    properties: [
        new OT\Property(property: 'current_page', type: 'int', nullable: false),
        new OT\Property(property: 'from', type: 'int', nullable: false),
        new OT\Property(property: 'last_page', type: 'int', nullable: false),
        new OT\Property(
            property: 'links',
            type: 'array',
            items: new OT\Items(
                properties: [
                    new OT\Property(property: 'url', type: 'string', nullable: true),
                    new OT\Property(property: 'label', type: 'string', nullable: false),
                    new OT\Property(property: 'active', type: 'boolean', nullable: false),
                ]
            )
        ),
        new OT\Property(property: 'path', type: 'string', nullable: false),
        new OT\Property(property: 'per_page', type: 'int', nullable: false),
        new OT\Property(property: 'to', type: 'int', nullable: false),
        new OT\Property(property: 'total', type: 'int', nullable: false),
    ],
)]
interface PaginationMetaContract
{
}
