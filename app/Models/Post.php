<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'website_id',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function scopeRecent(Builder $query) {
        return $query->where('created_at', '>', Carbon::now()->subtract('hours', 24));
    }

    protected static function boot()
    {
        parent::boot();
        Post::creating(function($model) {
            $baseSlug = $slug = str($model->title)->slug();
            $i = 1;
            while(Post::where('slug', $slug)->count()) {
                $slug = $baseSlug . '-' . $i++;
            }
            $model->slug = $slug;
        });
    }
}
