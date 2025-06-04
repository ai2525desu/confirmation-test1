<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 書いてる順番でシーダーの実行順が変わるので、これでcategory_idがないというエラーが解消される。
        // $this->call(ContactsTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // エラー解消後
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}
