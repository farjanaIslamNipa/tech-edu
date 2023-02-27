<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'client_id',
        'reference',
        'subject',
        'message',
        'read_status',
    ];

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
