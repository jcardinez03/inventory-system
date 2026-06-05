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
            'created_at' => now(),
            'updated_at' => now()],
            ['name' => 'Beverages',
            'created_at' => now(),
            'updated_at' => now()],
        ];

        $this->category->insert($categories);
    }
}
