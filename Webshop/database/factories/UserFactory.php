<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birth_date' => $this->faker->date(),
            'address_zip' => $this->faker->postcode(),
            'address_city' => $this->faker->city(),
            'address_street' => $this->faker->streetAddress(),
            'address_additional' => $this->faker->optional()->secondaryAddress(),
            'password' => Hash::make('password'), 
            'role' => 'user',
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
