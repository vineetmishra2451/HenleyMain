<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'group' => 'general',
            'key' => 'store_tagline',
            'value' => 'Pure leaf. Pure intent.',
            'type' => 'string',
        ];
    }
}
