<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

use App\Models\Blog\Category;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\Video;

class Item extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = "catalog_blog";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title",

        "body_short",
        "body_long",
        
        "meta_title",
        "meta_description",
        "meta_keywords",
        "meta_canonical",

        "category_id",
        "gallery_id",
        "video_id",
        "is_active_gallery",
        "is_active_video",
        "is_visible",
        "is_index",
        "sort",
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'category_id' => null,
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    /**
     * The accessors & mutators
     *
     * @var string
     */

    # генерируем slug вместе с добавлением title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;



        if ( isset($this->attributes['slug']) && !is_null($this->attributes['slug']) ) {

            # 05.01.2022 - заменить на функцию
            if ( $this->where('slug', $this->attributes['slug'])->count() > 1 ) {
                # не уникальный slug
                $this->attributes['slug'] = $this->attributes['slug'] . "-" . time();
            }
            
        }else{

            # slug не заполнен при создании
            $this->attributes['slug'] = Str::slug($value);

            # проверка на уникальность slug 
            if ( $this->where('slug', $this->attributes['slug'])->count() != 0 ) {
                # не уникальный slug
                $this->attributes['slug'] = $this->attributes['slug'] . "-" . time();
            }
        }

    }

    /**
     * 
     * Relations
     *
     */
    public function category()
    {
        # ссылка на галлерею
        return $this->hasOne(Category::class, "id", "category_id");
    }
    public function gallery()
    {
        # ссылка на галлерею
        return $this->belongsToMany(Gallery::class, "gallery_blog");
    }
    public function video()
    {
        # ссылка на галлерею
        return $this->belongsToMany(Video::class, "video_blog");
    }


}
