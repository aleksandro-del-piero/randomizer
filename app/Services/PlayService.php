<?php

namespace App\Services;

class PlayService
{
    public function randomNumber(): int
    {
        return random_int(1, 1000);
    }

    public function play(): array
    {
        $randomNumber = $this->randomNumber();

        $winAmount = match (true) {
            $randomNumber > 900 => $randomNumber * 0.7,
            $randomNumber > 600 => $randomNumber * 0.5,
            $randomNumber > 300 => $randomNumber * 0.3,
            default => $randomNumber * 0.1,
        };

        $isWin = $randomNumber % 2 === 0;

        $winAmount = $isWin ? $winAmount : 0;

        return [
            'randomNumber' => $randomNumber,
            'winAmount' => $winAmount,
            'isWin' => $isWin,
        ];
    }
}
