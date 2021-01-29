<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Member::class, 5)->create()->each(function ($member) {

            $courses = $member->seedCourses()->saveMany(factory(App\Models\MemberCourse::class, 2)->create(array('member_id' => $member->id)));

            foreach ($courses as $course) {
                $lessons = \App\Models\Lesson::where('course_id', $course->course_id)->get();

                foreach ($lessons as $lesson) {
                    $materials = \App\Models\Material::where('lesson_id', $lesson->id)->get();
                    foreach ($materials as $material) {
                        $member->materials()->save(factory(App\Models\MemberMaterial::class)->create(array('member_id' => $member->id, 'material_id' => $material->id)));
                    }
                }

                foreach ($lessons as $lesson) {
                    $tasks = \App\Models\Task::where('lesson_id', $lesson->id)->get();
                    foreach ($tasks as $task) {
                        $member->tasks()->save(factory(App\Models\MemberTask::class)->create(array('member_id' => $member->id, 'task_id' => $task->id)));
                    }
                }

                foreach ($lessons as $lesson) {
                    $tests = \App\Models\Test::where('lesson_id', $lesson->id)->get();
                    foreach ($tests as $test) {
                        $questions = \App\Models\Question::where('test_id', $test->id)->get();
                        foreach ($questions as $question) {
                            $answers = \App\Models\Answer::where('question_id', $question->id)->get();
                            foreach ($answers as $answer) {
                                $member->answers()->save(factory(App\Models\MemberAnswer::class)->create(array('member_id' => $member->id, 'test_id' => $test->id, 'question_id' => $question->id, 'answer_id' => $answer->id)));
                            }
                        }
                    }
                }

            }
        });

        DB::table('members')->insert([ //Это 1 участник для авторизации
            'name' => 'Федор',
            'avatar' => '',
            'email' => 'member@example.com',
            'phone' => '+79097776655',
            'password' => md5('password'),
            'city' => 'Курск',
            'store' => 'Милка',
            'post' => 'Ленинская, 33',
            'type' => 0,
        ]);
    }
}
