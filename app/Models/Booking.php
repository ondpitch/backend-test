<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    private $startDate = false;
    private $endDate = false;

    //scope filters
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%');
            });
        });

        if (isset($filters['start']) && isset($filters['end'])) {
            $this->startDate = Carbon::createFromFormat('Y-m-d', $filters['start'])->startOfDay();
            $this->endDate = Carbon::createFromFormat('Y-m-d', $filters['end'])->endOfDay();
        }
        $query
            ->when(
                $this->startDate && $this->endDate,
                fn ($query) =>
                $query->where(
                    fn ($query) =>
                    $query->whereBetween('date', [$this->startDate, $this->endDate])
                )

            );
    }
    protected $guarded = [];

    // define relationship with User model
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
