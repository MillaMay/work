<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMaterial extends Model
{
    protected $fillable = ['material_id', 'member_id', 'studied'];
}
