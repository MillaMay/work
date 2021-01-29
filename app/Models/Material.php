<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\MaterialController;

class Material extends Model
{
    protected $fillable = ['title', 'description', 'image', 'URL', 'lesson_id'];
    public $timestamps = false;

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
    public function memberMaterial()
    {
        return $this->hasOne('App\Models\MemberMaterial','material_id','id');
    }
}
