<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'expired_date'];

    protected $casts = [
        'expired_date' => 'datetime', // Cast the expired_date attribute to a DateTime instance
    ];

    /**
     * Determine if the member is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        // Check if the expired_date is in the past compared to the current date
        return $this->expired_date < Carbon::now()->setTimezone('Asia/Bangkok');;
    }
}
