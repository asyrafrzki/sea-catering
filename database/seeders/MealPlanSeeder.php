<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealPlan;

class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Diet Plan',
                'price' => 30000,
                'description' => 'Perfect for those who want to lose weight without sacrificing nutrition.',
                'details' => 'Includes portion-controlled meals, low-calorie ingredients, and high-fiber vegetables. Ideal for calorie deficit diets and healthy eating routines.',
                'image' => '/images/plans/diet.jpg',
            ],
            [
                'name' => 'Protein Plan',
                'price' => 40000,
                'description' => 'Designed for muscle gain and active lifestyles.',
                'details' => 'High in lean protein such as chicken breast, eggs, tofu, and legumes. Comes with complex carbs and essential micronutrients to boost muscle recovery.',
                'image' => '/images/plans/protein.jpg',
            ],
            [
                'name' => 'Royal Plan',
                'price' => 60000,
                'description' => 'Premium gourmet-style meals for maximum satisfaction.',
                'details' => 'Chef-curated dishes with top-quality ingredients. Includes diverse international cuisine, healthy desserts, and premium beverages. Great for those who want luxury and health combined.',
                'image' => '/images/plans/icon.png',
            ],
        ];

        foreach ($plans as $plan) {
            MealPlan::create($plan);
        }
    }
}
