<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Lead::class;
    
    public function definition() {

        return [
            'title' => $this->faker->jobTitle,
            'contact' => $this->faker->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['web', 'walkin', 'store']),
        ];
    }
}
