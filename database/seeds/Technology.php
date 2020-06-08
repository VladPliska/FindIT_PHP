<?php

use Illuminate\Database\Seeder;
//use app\Models\Technology as tech;
use App\Models\Technology as tech;

class Technology extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technology = [
            'PHP','NodeJs','Python','Ruby','Java','C++','C','C#','JavaScript','CSS','HTML','ReactJs','Vue','SQL','Git','MySql','PostgreSQL','NoSQL'
        ];
        foreach($technology as $v){
            tech::create([
                'name'=>$v
            ]);
        }
    }
}
