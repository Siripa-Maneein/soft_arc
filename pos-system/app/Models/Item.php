<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'name', 'description', 'price', 'quantity',
    ];

    /**
     * Update the quantity of the item.
     *
     * @param int $quantity
     * @return bool
     */
    public function reduceQuantity($quantity)
    {
        $this->quantity -= $quantity;
        
        return $this->save();
    }

}