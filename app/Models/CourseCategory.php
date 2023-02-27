<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CourseCategory extends Model implements HasMedia
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
        'name',
        'slug',
        'status',
        'short_description',
        'course_color_code',
        'background_color_code',
        'is_primary',
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
     * Define media collection for course category model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(name: 'course-category-image')
            ->useFallbackUrl(url(path: 'default/images/backend/no-image.png'))
            ->useFallbackPath(public_path(path: 'default/images/backend/no-image.png'))
            ->singleFile()
            ->useDisk(diskName: 'courseCategoryImage')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion(name: 'image')
                    ->width(width: 470)
                    ->height(height: 300);
            });
    }

    /** Get the course category image.
     */
    public function getImageAttribute(): ?string
    {
        return $this->relationLoaded(key: 'media') ? $this->getFirstMediaUrl(collectionName: 'course-category-image', conversionName: 'image') : url(path: 'default/images/backend/no-image.png');
    }

    /** Get the course category image.
     */
    public function getThumbnailAttribute(): ?string
    {
        return $this->relationLoaded(key: 'media') ? $this->getFirstMediaUrl(collectionName: 'course-category-image', conversionName: 'thumbnail') : url(path: 'default/images/backend/no-image.png');
    }

    /**
     * HasMany relation with course module.
     *
     */
    public function courseModules(): HasMany
    {
        return $this->hasMany(related: CourseModule::class, foreignKey: 'course_category_id', localKey: 'id');
    }
}
