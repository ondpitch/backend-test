<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class BookingIndexing extends Component implements HasForms, HasTable
{
    use InteractsWithTable, InteractsWithForms;
    public function render()
    {
        return view('livewire.booking.booking-indexing');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::query()->where('user_id', auth()->id())->orderBy('created_at', 'desc'))
            ->heading('Booking')
            ->description('Manage your Bookings here.')
            ->searchable()
            ->striped()
            ->columns([
                // ...
                TextColumn::make('title')->label('title'),
                TextColumn::make('firstname')->label('firstname'),
                TextColumn::make('email')->label('email'),
                TextColumn::make('date_of_booking')->label('Date of booking'),
            ])
            ->filters([
                // ...
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->headerActions([
                // ...
                Action::make('New Booking')
                    ->action(function () {
                    })
                    ->url(fn (): string => route('booking.create'))
                    ->color('info'),
            ]);
    }
}
