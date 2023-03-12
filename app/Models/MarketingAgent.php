<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingAgent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manager_id',
    ];

    public function manager() {
        return $this->belongsTo(User::class);
    }
}
