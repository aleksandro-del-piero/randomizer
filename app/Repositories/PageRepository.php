<?php

namespace App\Repositories;

use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Str;

class PageRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Page::class;
    }

    public function findByHash(string $hash): ?Page
    {
        return $this->model()->where('hash', $hash)->first();
    }

    public function createNewOrReturnActivePage(User $user): Page
    {
        $page = $user->pages()->active()->first();

        if (!$page) {
            $page = $user->pages()->create($this->getDataForNewPage());
        }

        return $page;
    }

    public function createNewPageForUser(User $user)
    {
        return $this->model()->create([
            'user_id' => $user->id,
            ...$this->getDataForNewPage()
        ]);
    }

    public function deactivate(string $hash): bool
    {
        return $this->model()->where('hash', $hash)->update([
            'expires_at' => now()->subDay()
        ]);
    }

    protected function getPageExpiresInSeconds(): int
    {
        return config('page.expires_time');
    }

    protected function getDataForNewPage(): array
    {
        return [
            'hash' => Str::random(),
            'expires_at' => now()->addSeconds($this->getPageExpiresInSeconds()),
        ];
    }
}
