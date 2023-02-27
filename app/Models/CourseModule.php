<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CourseModule extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'course_category_id',
        'name',
        'code',
        'slug',
        'rating',
        'status',
        'short_description',
        'description',
        'payment_link',
        'price',
        'training_type',
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

    public function courseCategory(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
    }

    /**
     * Define media collection for course module model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(name: 'course-module-image')
            ->useFallbackUrl(url(path: 'default/images/backend/no-image.png'))
            ->useFallbackPath(public_path(path: 'default/images/backend/no-image.png'))
            ->singleFile()
            ->useDisk(diskName: 'courseModuleImage')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion(name: 'image')
                    ->width(width: 470)
                    ->height(height: 300);
            });
    }

    /** Get the course module image.
     */
    public function getImageAttribute(): ?string
    {
        return $this->relationLoaded(key: 'media') ? $this->getFirstMediaUrl(collectionName: 'course-module-image', conversionName: 'image') : url(path: 'default/images/backend/no-image.png');
    }

    /** Get the course module image.
     */
    public function getThumbnailAttribute(): ?string
    {
        return $this->relationLoaded(key: 'media') ? $this->getFirstMediaUrl(collectionName: 'course-module-image', conversionName: 'thumbnail') : url(path: 'default/images/backend/no-image.png');
    }

    /**
     * BelongsToMany relation with Course Module.
     *
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(related: Package::class, table: 'course_module_package', foreignPivotKey: 'course_module_id', relatedPivotKey: 'package_id');
    }

}
