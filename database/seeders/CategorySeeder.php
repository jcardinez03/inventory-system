<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function run(): void
    {
        $categories = [
            ['name' => 'Snacks',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()],
            ['name' => 'Beverages',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()],
        ];

        $this->category->insert($categories);
    }
}
