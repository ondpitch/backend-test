<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Login extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data;

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')->required(),
                TextInput::make('password')->revealable()->required(),
            ])->statePath('data');
    }

    public function login()
    {
        try {
            $data = $this->form->getState();
            if (Auth::attempt($data)) {

                Notification::make()->title('Welcome')->success()->send();
                if ($data['email'] === 'admin@bookings.com') {
                    return redirect();
                }

                return redirect('/bookings');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Notification::make()->title('Ooops!')->send();
        }
    }
}
