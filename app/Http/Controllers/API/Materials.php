<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MemberMaterial;
use Illuminate\Http\Request;

class Materials
{
    public function addStudiedMaterial(Request $request)
    {
        $material_id = (int)$request->material_id;
        $user = session()->get('auth')['user'];
        $data = [
            'material_id' => $material_id,
            'member_id' => $user->id,
            'studied' => 1,
        ];
        MemberMaterial::updateOrCreate($data);
    }
}
