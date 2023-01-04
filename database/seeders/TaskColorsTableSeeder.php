<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskColor;

class TaskColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskColor::create([
            "color"       => "blue",
            "description" => "タスク",
        ]);
    }
}
