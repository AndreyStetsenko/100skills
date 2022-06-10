<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

use App\Models\Gallery\Gallery;
use App\Models\Gallery\Video;
use App\Models\Course\Item as Course;
use App\Models\Action\Item as Action;
use App\Models\Tarif\Item as Tarif;
use App\Models\User;

class Item extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = "catalog_school";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title",

        "body_short",
        "link",
        "adress",
        "latitude",
        "longitude",
        "phone",
        "email",
        
        "meta_title",
        "meta_description",
        "meta_keywords",
        "meta_canonical",

        "user_id",

        "is_active_gallery",
        "is_visible",
        "sort",
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        
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

    # генерируем slug вместе с добавлением title: where
    private function getWhere($attr){
        $where = array();
        if ( isset($attr['id']) && !is_null($attr['id']) ) {
            $where[] = array("id", "!=", $attr['id']);
        }
        if ( isset($attr['slug']) && !is_null($attr['slug']) ) {
            $where[] = array("slug", "=", $attr['slug']);
        }
        return $where;
    }

    # генерируем slug вместе с добавлением title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value; 

        if ( isset($this->attributes['slug']) && !is_null($this->attributes['slug']) ) {
            # 05.01.2022 - заменить на функцию
            $where = $this->getWhere($this->attributes);
            if ( $this->where($where)->count() > 1 ) {
                # не уникальный slug
                $this->attributes['slug'] = $this->attributes['slug'] . "-" . time();
            }  
        }else{
            
            # slug не заполнен при создании
            if ( isset($this->attributes['id']) ) {
                $this->attributes['slug'] = $this->where("id", "=", $this->attributes['id'])->first()->slug;
            }else{
                $this->attributes['slug'] = Str::slug($value);

            }

            # проверка на уникальность slug 
            $where = $this->getWhere($this->attributes);
            # dd(__METHOD__, $where, $this->where($where)->count());
            if ( $this->where($where)->count() != 0 ) {
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
        return $this->belongsToMany(Gallery::class, "gallery_school");
    }
    // public function video()
    // {
    //     # ссылка на галлерею
    //     return $this->belongsToMany(Video::class, "video_blog");
    // }
    public function course()
    {
        # ссылка на галлерею
        return $this->hasMany(Course::class, "school_id")->orderBy('id', 'desc');
    }
    public function action()
    {
        # ссылка на галлерею
        return $this->belongsToMany(Action::class, "school_action", "school_id", "item_id");
    }
    
    public function tarif()
    {
        # ссылка на галлерею
        return $this->belongsTo(Tarif::class, "tarif_id");
    }
    public function user()
    {
        # ссылка на галлерею
        return $this->belongsTo(User::class, "user_id");
    }


}
