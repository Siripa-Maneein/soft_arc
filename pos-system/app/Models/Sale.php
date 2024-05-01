<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = ['total', 'payment_time', 'payment_status', 'member_id'];

    public function saleLineItems()
    {
        return $this->hasMany(SaleLineItem::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
