<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'street',
        'suburb',
        'state',
        'post_code',
        'country',
    ];

    /**
     * HasOne relationship with Address to Client.
     */
    public function client(): HasOne
    {
        return $this->hasOne(related: Client::class, foreignKey: 'address_id', localKey: 'id');
    }
}
