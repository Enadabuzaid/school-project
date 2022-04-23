<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class Classroom extends Model
{
    use HasTranslations,SoftDeletes;
    protected $fillable = ['name_class','grade'];
    protected $dates = ['deleted_at'];

    public $translatable = ['name_class'];
    protected $table = 'classrooms';
    public $timestamps = true;

    public function grades()
    {
        return $this->belongsTo('App\Models\Grade\Grade', 'grade_id');
    }

}
