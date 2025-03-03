<?php

namespace App\Repositories;

use App\Models\Game;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class GameRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Game::class;
    }

    public function createForPage(Page $page, int $randomNumber, float $amount, bool $isWin): ?Game
    {
        return $this->model()->create([
            'page_id' => $page->id,
            'random_number' => $randomNumber,
            'amount' => $amount,
            'is_win' => $isWin
        ]);
    }

    public function getHistoryGamesForPage(int $pageId): Collection
    {
        return $this->model()->where('page_id', $pageId)->latest()->get();
    }
}
