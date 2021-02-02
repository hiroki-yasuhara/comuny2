<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            // テーブルのクリア
    DB::table('categories')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // 初期データ用意（列名をキーとする連想配列）
    $categories = [
              ['category' => 'スポーツ'],
              ['category' => '勉強会'],
              ['category' => '室内']
             ];

    // 登録
    foreach($categories as $category) {
      \App\Models\Category::create($category);
    }
    }
}
