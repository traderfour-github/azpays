<?php

namespace Database\Seeders;

use App\Enums\Category\CategoryBot;
use App\Enums\Category\CategoryFundedAccount;
use App\Enums\Category\CategoryType;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CategoryBot::cases() as $cat){
            $name = ucwords(strtolower(str_replace('_', ' ', $cat->name)));
            Category::firstOrCreate(['title' => $name],
                [
                    'type' => CategoryType::BOT
                ]
            );
        }
        foreach (CategoryFundedAccount::cases() as $cat){
            $name = ucwords(strtolower(str_replace('_', ' ', $cat->name)));
            Category::firstOrCreate(['title' => $name],
                [
                    'type' => CategoryType::FUNDED_ACCOUNT
                ]
            );
        }

    }
}
