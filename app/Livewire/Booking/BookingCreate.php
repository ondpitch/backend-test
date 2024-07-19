<?php

namespace App\Livewire\Booking;

use App\Mail\BookingMailToAdmin;
use DateTime;
use Exception;
use App\Models\Booking;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\Mail;

class BookingCreate extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data;

    // #[Layout()]
    public function render()
    {
        return view('livewire.booking.booking-create');
    }

    public function mount()
    {
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('firstname')->required(),
                TextInput::make('email')->required(),
                DateTimePicker::make('date_of_booking')->required()
            ])->statePath('data');
    }

    public function booking()
    {
        try {
            DB::beginTransaction();
            $data = $this->form->getState();

            $data['user_id'] = auth()->id();

            $res = Booking::create($data);

            Mail::send(new BookingMailToAdmin($res))->to('admin@bookings.com')->send();

            Notification::make()->title('Booking created')->send();

            DB::commit();

            return redirect('/bookings');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return Notification::make()->title('Ooops')->send();
        }
    }
}
