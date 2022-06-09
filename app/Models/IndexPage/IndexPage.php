<?php

namespace App\Models\IndexPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;


use App\Models\Gallery\Gallery;
use App\Models\Presets\Presets;

class IndexPage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "index_page_information";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "meta_title",
        "meta_description",
        "meta_keywords",

        "body",

        'is_active_presets',
        'catalog_presets_id',

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
     * 
     * Relations
     *
     */
    public function presets()
    {
        # ссылка на галлерею || слайдер  
        return $this->hasMany(Presets::class, "catalog_index_page_id");
    }

}
