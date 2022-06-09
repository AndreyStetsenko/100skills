<?php

namespace App\Http\Requests\Panel\Course;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => 'required',
            
            "category_id" => '',
            "school_id" => '',
            "gallery_id" => '',

            "body_short" => "",
            "body_long" => "",
            "body_goals" => "",
            "body_course" => "",
            
            "author" => "",
            "duration" => "required",
            "price" => "required|integer",
            "link" => "",
            
            "meta_title" => "",
            "meta_description" => "",
            "meta_keywords" => "",
            "meta_canonical" => "",

            "is_action" => "",
            "is_recomended" => "",
            "is_jobable" => "",
            "is_certificate" => "",
            "is_proffession" => "",
            "is_online" => "",
            "is_popular" => "",
            "is_active_gallery" => "",
            "is_visible" => "",
            "sort" => "",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => "Поле 'Заголовок' обязательно для заполнения.",
            'duration.required' => "Поле 'Длительность' обязательно для заполнения.",
            'duration.integer' => "Поле 'Длительность' должно быть числом.",
            'price.required' => "Поле 'Стоимость' обязательно для заполнения.",
            'price.integer' => "Поле 'Стоимость' должно быть числом.",
        ];
    }
}
