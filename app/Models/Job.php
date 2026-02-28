<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Job extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'location_id',
        'salary_min',
        'salary_max',
        'job_type',
        'experience',
        'apply_link',
        'status',
        'is_featured',
        'apply_method',
        'apply_value',
        'nationality',
        'company_name',
        'company_logo',
        'job_role',
        'qualification',
        'primary_country_code',
        'primary_mobile',
        'alternate_country_code',
        'alternate_mobile',
        'contact_email',
        'slug',
    ];

    /**
     * Boot method to auto-generate slugs
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = static::generateUniqueSlug($job->title);
            }
        });

        static::updating(function ($job) {
            if ($job->isDirty('title') && empty($job->slug)) {
                $job->slug = static::generateUniqueSlug($job->title);
            }
        });
    }

    /**
     * Generate a unique slug from title
     */
    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    /**
     * Use slug for route model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
