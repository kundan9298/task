<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $subjects = ['Math', 'English', 'Science', 'History', 'Geography'];
        return [
            'name' => $this->faker->name,
            'subject' => $this->faker->randomElement($subjects),
            'mark' => $this->faker->numberBetween(50, 100),
        ];
    }
}
