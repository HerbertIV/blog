<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\NewsDto;
use App\Enums\GuardEnums;
use App\Enums\PermissionEnums;
use App\Http\Livewire\Components\Inputs\Trix;
use App\Http\Requests\Blog\NewsRequest;
use App\Models\Blog;
use App\Services\Contracts\BlogServiceContract;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class BlogForm extends Component
{
    private BlogServiceContract $blogService;
    public ?Blog $news;
    public ?string $title = '';
    public ?string $short = '';
    public ?string $content = '';
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->blogService = app(BlogServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'NewsCreateEvent',
        Trix::EVENT_VALUE_UPDATED
    ];

    public function trix_value_updated($value) {
        $this->content = $value;
    }

    protected function getRules()
    {
        return (new NewsRequest())->rules();
    }

    public function createNews(): void
    {
        $hasCreate = auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('blog' . PermissionEnums::HYPHEN . PermissionEnums::CREATE_ACTION);
        if (!$hasCreate) {
            abort(403);
        }
        $this->resetErrorBag();
        $this->validate();

        $newsDto = new NewsDto($this->toArray());
        $news = $this->blogService->create($newsDto);
        $this->emit('saved');
        $this->redirect(route('blogs.show', $news));
    }

    public function updateNews(): void
    {
        $hasEdit = auth()->guard(GuardEnums::ADMIN)->user()->hasPermissionFromGuard('blog' . PermissionEnums::HYPHEN . PermissionEnums::UPDATE_ACTION);
        if (!$hasEdit) {
            abort(403);
        }
        $this->resetErrorBag();
        $this->validate();
        $news = $this->news;
        $newsDto = new NewsDto($this->toArray());
        $this->blogService->update($newsDto, $news->getKey());
        $this->emit('updated');
        $this->redirect(route('blogs.show', ['blog' => $news]));
    }

    public function mount(?Blog $news = null): void
    {
        if ($news) {
            $this->news = $news;
            $this->setData([
                'title' => $this->news->title,
                'short' => $this->news->short,
                'content' => $this->news->content,
            ]);
        }
        $this->button = create_button($this->action, 'Blog');
    }

    public function render(): View
    {
        return view('admin.pages.blog.components.blog-form');
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'short' => $this->short,
            'content' => $this->content,
        ];
    }

    public function setData(array $data): void
    {
        foreach ($data as $k => $v) {
            $key = Str::studly($k);
            if (method_exists($this, 'set' . $key)) {
                $this->{'set' . $key}($v);
            } else {
                $key = lcfirst($key);
                if (array_key_exists($key, get_class_vars(self::class))) {
                    $this->$key = $v;
                }
            }
        }
    }
}
