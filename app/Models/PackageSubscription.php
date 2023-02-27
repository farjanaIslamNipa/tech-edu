<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PackageSubscription extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'client_id',
        'package_id',
        'package_price',
        'discount_price',
        'gst_price',
        'total_price',
        'payment_status',
        'subscription_status',
        'subscription_end_date',
        'reference',
    ];

    /**
     * BelongsTo relation with Package Subscription Order.
     *
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(related: Client::class, foreignKey: 'client_id', ownerKey: 'id');
    }

    /**
     * BelongsTo relation.
     *
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(related: Package::class, foreignKey: 'package_id', ownerKey: 'id');
    }

    /**
     * BelongsToMany relation with Course Module.
     *
     */
    public function courseModules(): BelongsToMany
    {
        return $this->belongsToMany(related: CourseModule::class, table: 'course_subscription', foreignPivotKey: 'package_subscription_id', relatedPivotKey: 'course_module_id');
    }


}
