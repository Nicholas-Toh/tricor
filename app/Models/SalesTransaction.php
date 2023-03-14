<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sales_item',
        'user_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'float'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
