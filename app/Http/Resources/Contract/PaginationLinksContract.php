<?php

namespace App\Http\Resources\Contract;

use OpenApi\Attributes as OT;

#[OT\Schema(
    schema: 'PaginationLinks',
    title: 'Pagination Links',
    properties: [
        new OT\Property(property: 'first', type: 'string', nullable: false),
        new OT\Property(property: 'last', type: 'string', nullable: false),
        new OT\Property(property: 'prev', type: 'string', nullable: true),
        new OT\Property(property: 'next', type: 'string', nullable: true),
    ],
)]
interface PaginationLinksContract
{
}
