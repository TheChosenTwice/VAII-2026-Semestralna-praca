<?php

namespace App\Models;

use DateTimeImmutable;
use Framework\Core\Model;

class Topic extends Model
{
    protected ?int $id = null;
    protected ?string $title = null;
    protected ?int $user_id = null;
    protected ?int $category_id = null;
    protected ?string $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->created_at ?? 'now');
    }

    public function setCreatedAt(DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at->format('Y-m-d H:i:s');
    }
}