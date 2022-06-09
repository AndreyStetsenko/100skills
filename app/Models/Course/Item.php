<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

use App\Models\School\Item as School;
use App\Models\Action\Item as Action;
use App\Models\Course\Category;
use App\Models\Gallery\Gallery;

class Item extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = "catalog_course";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title",


        "body_short",
        "body_long",
        "body_goals",
        "body_course",
        "author",
        "duration",
        "price",
        "link",
        
        "meta_title",
        "meta_description",
        "meta_keywords",
        "meta_canonical",

        "school_id",
        "category_id",
        "gallery_id",
        "is_jobable" => "",
        "is_action" => "",
        "is_recomended" => "",
        "is_certificate" => "",
        "is_proffession" => "",
        "is_online" => "",
        "is_popular" => "",
        "is_active_gallery" => "",
        "is_visible" => "",
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
        return $this->hasOne(Category::class, "id");
    }
    public function gallery()
    {
        # ссылка на галлерею
        return $this->belongsToMany(Gallery::class, "gallery_course");
    }
    public function similar()
    {
        # ссылка на галлерею
        return $this->belongsToMany(Item::class, "catalog_course_similar", "similar_id", "course_id");
    }
    public function school()
    {
        # ссылка на галлерею
        return $this->hasOne(School::class, "id", "school_id");
    }


}
