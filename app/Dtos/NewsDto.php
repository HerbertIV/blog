<?php

namespace App\Dtos;

class NewsDto extends BaseDto
{
    protected string $title;
    protected string $short;
    protected string $content;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getShort(): string
    {
        return $this->short;
    }

    /**
     * @param string $title
     */
    protected function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $content
     */
    protected function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param string $short
     */
    protected function setShort(string $short): void
    {
        $this->short = $short;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'short' => $this->getShort(),
        ];
    }
}
