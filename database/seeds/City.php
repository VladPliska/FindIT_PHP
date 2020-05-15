<?php

use Illuminate\Database\Seeder;
use App\Models\City as C;
class City extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            'Київ',
            'Ужгород',
            "Одесса",
            "Львів",
            "Тернопіль",
            "Харків",
            "Чернігів",
            "Дніпропетровськ",
        ];

        foreach ($city as $item) {
                C::create([
                    'name'=>$item
            ]);
        }
    }
}
