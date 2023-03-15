<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingAgent extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manager_id',
    ];

    protected $with = [
        'user'
    ];

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
