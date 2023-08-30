<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\Contracts;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OT;
interface BlogsControllerContract
{
    #[OT\Get(
        path: '/api/blogs',
        tags: ['Get news'],
        description: 'It is endpoints list with news'
    )]
    #[OT\Response(
        response: 200,
        description: 'Successful operation',
        content: new OT\JsonContent(
            properties: [
                new OT\Property(
                    property: 'data',
                    type: 'array',
                    items: new OT\Items('#/components/schemas/Blog'),
                    nullable: false
                ),
                new OT\Property(
                    property: 'links',
                    ref: '#/components/schemas/PaginationLinks',
                ),
                new OT\Property(
                    property: 'meta',
                    ref: '#/components/schemas/PaginationMeta',
                ),
            ],
        ),
    )]

    #[OT\Response(response: 422, description: 'Unprocessable content')]
    public function index(Request $request): JsonResource;

    #[OT\Get(
        path: '/api/blogs/{blog}',
        tags: ['Get news detail'],
        description: 'It is endpoints detail news'
    )]
    #[OT\Response(
        response: 200,
        description: 'Successful operation',
        content: new OT\JsonContent(ref: '#/components/schemas/Blog'),
    )]
    #[OT\Response(response: 422, description: 'Unprocessable content')]
    public function show(Request $request, Blog $blog): JsonResource;
}
