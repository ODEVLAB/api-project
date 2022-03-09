<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'title'       =>   $this->faker->word,
          'task_code'   =>   'tsk'.$this->faker->numberBetween(10,201),
          'description' =>   $this->faker->text(200),
          'status'      =>   $this->faker->numberBetween(0,1),
          'deadline'    =>   $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
        ];
    }
}
