<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TrainersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(MaterialsTableSeeder::class);
        $this->call(TestsTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(MemberCoursesTableSeeder::class);
        $this->call(MemberAnswersTableSeeder::class);
        $this->call(MemberMaterialsTableSeeder::class);
        $this->call(MemberTasksTableSeeder::class);
    }
}
