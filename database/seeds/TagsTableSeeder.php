<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['ミッキー','ミニー','ドナルド','グーフィー','ダッフィー','ぬいぐるみ','ぬいぐるみバッジ','Tシャツ','ピンバッジ','その他'];
        foreach ($names as $name) {
            DB::table('tags')->insert('name');
        }
    }
}
