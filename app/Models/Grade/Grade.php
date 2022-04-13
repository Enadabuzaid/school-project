<?php

namespace App\Models\Grade;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model
{
    use HasTranslations;

    protected $fillable = ['grade_name','notes'];

    public $translatable = ['grade_name','notes'];
    protected $table = 'Grades';
    public $timestamps = true;
    /**
     * @var array|mixed
     */

    public function sections()
    {
        return $this->hasMany('App\Models\Section','grade_id');
    }
}
