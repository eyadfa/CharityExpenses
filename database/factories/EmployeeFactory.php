<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         return [
             'fname' => $this->faker->firstName(),
             'sname' => $this->faker->firstNameMale(),
             'thname' => $this->faker->firstNameMale(),
             'lname' => $this->faker->lastName(),
             'employee_no' => $this->faker->unique()->numberBetween(1 ,20),
             'id_card' => $this->faker->numerify("#####"),
             'passport' => $this->faker->numerify("#####"),
             'nationality_id' => $this->faker->numberBetween(1,4),
             'country_id' => $this->faker->numberBetween(1,4),
             'city_id' => $this->faker->numberBetween(1,7),
             'gender_cd' => $this->faker->numberBetween(1,2),
             'is_active' => $this->faker->numberBetween(1,2),
             'current_address' => $this->faker->address(),
             'mobile' => $this->faker->phoneNumber(),
             'phone' => $this->faker->phoneNumber(),
             'internal_phone' => $this->faker->phoneNumber(),
             'email' => $this->faker->email(),
             'dob'=>$this->faker->date(),
             'motives'=>$this->faker->text(50),
             'ambition'=>$this->faker->text(50),
             'talent'=>$this->faker->text(50),
             'start_date'=>$this->faker->date(),

         ];

    }
}
