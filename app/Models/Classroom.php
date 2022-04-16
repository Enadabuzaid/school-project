<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Classroom extends Model
{
    use HasTranslations;
    protected $fillable = ['name_class','grade'];

    public $translatable = ['name_class'];
    protected $table = 'classrooms';
    public $timestamps = true;

    public function grades()
    {
        return $this->belongsTo('App\Models\Grade\Grade', 'grade_id');
    }

}
