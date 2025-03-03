<?php

namespace App\Livewire;

use App\Repositories\PageRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public ?string $name = null;
    public ?string $phone = null;
    public ?string $error = null;

    public function register(UserRepository $userRepository, PageRepository $pageRepository)
    {
        $this->validateRegistration();

        try {
            $user = $userRepository->create($this->name, $this->phone);

            Auth::login($user);

            $page = $pageRepository->createNewOrReturnActivePage($user);

            return redirect()->route('page', ['hash' => $page->hash]);
        } catch (\Throwable $exception) {
            logger('Error registering user: ' . $exception->getMessage());
            $this->error = 'Error while registering';
        }
    }

    protected function validateRegistration(): void
    {
        $this->validate([
            'name' => ['required', 'min:1', 'max:191'],
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);
    }

    protected function messages(): array
    {
        return [
            'phone.regex' => 'Phone number must be in the format +XXXXXXXXXXX, where X is a digit (e.g. +1234567890). It should be between 10 and 15 digits long.',
        ];
    }

    public function render()
    {
        return view('livewire.register');
    }
}
