<?php

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word . '.jpg',
            'mime_type' => 'image/jpeg',
            'path' => 'attachment/' . $this->faker->word . '.jpg',
        ];
    }
}
