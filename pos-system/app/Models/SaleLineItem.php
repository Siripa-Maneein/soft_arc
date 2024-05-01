<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleLineItem extends Model
{
    protected $table = 'sale_line_items';

    protected $fillable = ['sale_id', 'quantity', 'item_id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
