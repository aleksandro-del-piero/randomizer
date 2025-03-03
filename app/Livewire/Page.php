<?php

namespace App\Livewire;

use App\Models\User;
use App\Repositories\GameRepository;
use App\Repositories\PageRepository;
use App\Services\PlayService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Page extends Component
{
    public string $hash;

    public \App\Models\Page $page;
    public ?string $newPageLink = null;

    public array $resultGame = [];

    public ?Collection $historyGames = null;


    public function mount(GameRepository $gameRepository)
    {
        $this->historyGames = $gameRepository->getHistoryGamesForPage($this->page->id);
    }

    public function generateNewPage(PageRepository $pageRepository): void
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        $newPage = $pageRepository->createNewPageForUser($user);

        $this->newPageLink = route('page', ['hash' => $newPage->hash]);
    }

    public function play(PlayService $playService): void
    {
        $this->resultGame = $playService->play();

        $this->addResultToHistory();

        /**
         * @var GameRepository $gameRepository
         */
        $gameRepository = app(GameRepository::class);

        $this->historyGames = $gameRepository->getHistoryGamesForPage($this->page->id);
    }

    public function deactivateLink(PageRepository $pageRepository)
    {
        $pageRepository->deactivate($this->page->hash);

        return redirect()->route('main');
    }

    protected function addResultToHistory(): void
    {
        /**
         * @var GameRepository $gameRepository
         */
        $gameRepository = app(GameRepository::class);

        $gameRepository->createForPage(
            $this->page,
            $this->resultGame['randomNumber'],
            $this->resultGame['winAmount'],
            $this->resultGame['isWin']
        );
    }

    public function render()
    {
        return view('livewire.page', ['hash' => $this->hash]);
    }
}
