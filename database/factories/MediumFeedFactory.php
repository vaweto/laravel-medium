<?php

namespace Vaweto\Medium\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Vaweto\Medium\Definitions\MediumFeedType;
use Vaweto\Medium\Models\MediumFeed;

class MediumFeedFactory extends Factory
{
    protected $model = MediumFeed::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => MediumFeedType::TAG->value,
            'user_id' => $this->faker->randomNumber(),
        ];
    }
}
