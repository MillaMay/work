<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Trainer::class, 3)->create()->each(function ($trainer) {
            $trainer->courses()->saveMany(factory(App\Models\Course::class, 6)->create(array('trainer_id' => $trainer->id))->each(function($course) {
                $course->lessons()->saveMany(factory(App\Models\Lesson::class, 5)->create(array('course_id' => $course->id))->each(function ($lesson) {
                    $lesson->materials()->saveMany(factory(App\Models\Material::class, 2)->create(array('lesson_id' => $lesson->id)));
                    $lesson->tests()->saveMany(factory(App\Models\Test::class, 1)->create(array('lesson_id' => $lesson->id))->each(function ($test) {
                        $test->questions()->saveMany(factory(App\Models\Question::class, 5)->create(array('test_id' => $test->id))->each(function ($question) {
                            $question->answers()->saveMany(factory(App\Models\Answer::class, 3)->create(array('question_id' => $question->id)));
                        }));
                    }));
                    $lesson->tasks()->save(factory(App\Models\Task::class)->create(array('lesson_id' => $lesson->id)));
                }));
            }));
        });

        DB::table('trainers')->insert([ //Это 1 тренер для авторизации
            'name' => 'Иванов Иван Иванович',
            'avatar' => '',
            'email' => 'trainer@example.com',
            'phone' => '+79197776655',
            'password' => md5('password'),
            'department' => '356800, Кировская область, город Киров, Советская, 33',
        ]);
    }
}
