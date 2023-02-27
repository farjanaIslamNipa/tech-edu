<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'package_id',
        'type',
        'discount_percentage',
        'minimum_course_count',
        'status',
        'payment_link',
    ];

    /**
     * BelongsTo relation with Package.
     *
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(related: Package::class, foreignKey: 'package_id', ownerKey: 'id');
    }
}
