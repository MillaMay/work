<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MemberCourse;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB; //Алиясы не работают в командной строке, поэтому здесь полный путь указан

$factory->define(MemberCourse::class, function (Faker $faker) {
    $course_ids = DB::table('courses')->select('id')->get();
    $course_id = $faker->unique()->randomElement($course_ids)->id; //unique() - указан, чтобы не было ошибки: "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '38-4' for key 'PRIMARY'"

    return [
        'course_id' => $course_id,
    ];
});
