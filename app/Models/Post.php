<?php

namespace App\Models;

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
