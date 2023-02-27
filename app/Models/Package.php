<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Package extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'status',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fieldName: 'name')
            ->saveSlugsTo(fieldName: 'slug')
            ->slugsShouldBeNoLongerThan(maximumLength: 120);
    }

    /**
     * Define media collection for package model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(name: 'package-image')
            ->useFallbackUrl(url(path: 'default/images/backend/no-image.png'))
            ->useFallbackPath(public_path(path: 'default/images/backend/no-image.png'))
            ->singleFile()
            ->useDisk(diskName: 'packageImage')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion(name: 'image')
                    ->width(width: 470)
                    ->height(height: 300);
            });
    }

    /** Get the package image.
     */
    public function getImageAttribute(): ?string
    {
        return $this->relationLoaded(key: 'media') ? $this->getFirstMediaUrl(collectionName: 'package-image', conversionName: 'image') : url(path: 'default/images/backend/no-image.png');
    }

    /** Get the package image.
     */
    public function getThumbnailAttribute(): ?string
    {
        return $this->relationLoaded(key: 'media') ? $this->getFirstMediaUrl(collectionName: 'package-image', conversionName: 'thumbnail') : url(path: 'default/images/backend/no-image.png');
    }

    /**
     * HasMany relation with Package Type.
     *
     */
    public function packageTypes(): HasMany
    {
        return $this->hasMany(related: PackageType::class, foreignKey: 'package_id', localKey: 'id');
    }
    /**
     * HasMany relation with Course Module.
     *
     */
    public function courseModules(): BelongsToMany
    {
        return $this->belongsToMany(related: CourseModule::class, table:'course_module_package', foreignPivotKey: 'package_id', relatedPivotKey: 'course_module_id');
    }

    /**
     * HasMany relation.
     *
     */
    public function packageSubscriptions(): HasMany
    {
        return $this->hasMany(related: PackageSubscription::class, foreignKey: 'package_subscription_id', localKey: 'id');
    }

}
