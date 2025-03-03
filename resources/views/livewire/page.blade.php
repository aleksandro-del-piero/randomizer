<div class="container">
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom justify-content-center">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"/>
                </svg>
                <span class="fs-4">Randomizer Lucky</span>
            </a>
        </header>

        <main>
            <div class="mb-4 text-center">
                <div>@if($newPageLink)
                        <a href="{{ $newPageLink }}" class="btn btn-outline-primary mb-2">New page link</a>
                    @endif</div>
                <div class="text-muted mb-3">{{ $newPageLink }}</div>
            </div>

            <div class="text-center mb-4">
                <button type="button" class="btn btn-primary mx-2" wire:click="generateNewPage">Generate New Page</button>
                <button type="button" class="btn btn-danger mx-2" wire:click="deactivateLink">Deactivate Link</button>
            </div>

            <div class="row g-5">
                <div class="col-md-6">
                    <h2 class="text-body-emphasis">Play With Me</h2>
                    <button type="button" class="btn btn-primary mb-3" wire:click="play">I'm Feeling Lucky</button>

                    @if(!empty($resultGame))
                        <div class="alert alert-info">
                            <p><strong>Result Game:</strong></p>
                            <p>Your result random number: <strong>{{ $resultGame['randomNumber'] }}</strong></p>
                            <p>Result: <strong>@if($resultGame['isWin']) Win @else Lose @endif</strong></p>
                            <p>Your win amount: <strong>{{ $resultGame['winAmount'] }}</strong></p>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <h2 class="text-body-emphasis">History of Games</h2>

                    @if($historyGames && $historyGames->isNotEmpty())
                        <div class="list-group" style="max-height: 300px; overflow-y: auto;">
                            @foreach($historyGames as $game)
                                <div class="list-group-item">
                                    <h5 class="mb-1">Game #{{ $game->id }}</h5>
                                    <p class="mb-1"><strong>Win Amount:</strong> {{ $game->amount }}</p>
                                    <p class="mb-1"><strong>Random Number:</strong> {{ $game->random_number }}</p>
                                    <p><strong>Result:</strong> {{ $game->is_win ? 'Win' : 'Lose' }}</p>
                                    <small class="text-muted">Played at {{ $game->created_at->format('M d, Y H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No game history available.</p>
                    @endif
                </div>
            </div>
        </main>

        <footer class="pt-5 my-5 text-body-secondary border-top text-center">
            Created by Alex &middot; &copy; {{ now()->format('Y') }}
        </footer>
    </div>
</div>
