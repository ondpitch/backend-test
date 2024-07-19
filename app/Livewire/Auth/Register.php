<?php

namespace App\Livewire\Auth;

use Exception;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Register extends Component implements HasForms
{
    use InteractsWithForms;
    public array $data;

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->revealable()->required(),
            ])->statePath('data');
    }

    public function register()
    {
        try {
            $data = $this->form->getState();

            DB::beginTransaction();

            $user = User::create($data);

            auth()->login($user);

            Notification::make()->title('Hello!')->send();
            DB::commit();
            return redirect('/bookings');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return Notification::make()->title('Ooops!')->body($e->getMessage())->success()->send();
        }
    }
}
