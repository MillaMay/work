<?php

use Illuminate\Database\Seeder;

class TrainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainers')->insert([ //Можно и так, если нужно одного тренера добавить.
            'name' => Str::random(10),
            'avatar' => Str::random(10),
            'email' => 'trainer@gmail.com',
            'phone' => Str::random(10).'',
            'password' => bcrypt('password'),
            'department' => Str::random(20),
        ]);
        factory(App\Models\Trainer::class, 10)->create(); //Создание 10 тренеров
    }
}
