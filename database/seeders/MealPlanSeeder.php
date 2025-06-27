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
                'name' => 'Healthy Starter',
                'price' => 250000,
                'description' => 'A perfect 3-meal plan for beginners looking to improve their eating habits.',
                'details' => 'Includes healthy breakfast, lunch, and dinner. Balanced macros. Great for weight maintenance.',
                'image' => '/images/plans/starter.jpg',
            ],
            [
                'name' => 'Fitness Fuel',
                'price' => 350000,
                'description' => 'High-protein meals tailored for gym-goers and athletes.',
                'details' => 'Each meal is crafted with lean protein, complex carbs, and healthy fats to boost muscle growth and energy.',
                'image' => '/images/plans/fitness.jpg',
            ],
            [
                'name' => 'Vegan Delight',
                'price' => 300000,
                'description' => 'A full plant-based meal plan for a healthier lifestyle.',
                'details' => 'Includes a variety of vegan dishes rich in fiber, vitamins, and minerals. 100% animal-product free.',
                'image' => '/images/plans/vegan.jpg',
            ],
            [
                'name' => 'Low Carb Pack',
                'price' => 280000,
                'description' => 'Ideal for keto and low-carb dieters.',
                'details' => 'Low in carbohydrates, moderate in protein, and high in good fats. Helps in weight loss and energy balance.',
                'image' => '/images/plans/lowcarb.jpeg',
            ],
        ];

        foreach ($plans as $plan) {
            MealPlan::create($plan);
        }
    }
}
