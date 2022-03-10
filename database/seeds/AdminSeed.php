<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::create([
            'name'=>['ar'=>['اتش تاسك'],'en'=>['HTask']],
            'description'=>['ar'=>['اتش تاسك'],'en'=>['HTask']],
        ]);
        User::create([
            'name'=>'ahmed',
            'email'=>'am9514994@gmail.com',
            'phone'=>'01208982815',
            'password'=>bcrypt('123456789'),
            'type'=>'1',
            'hotel_id'=>'1',

        ]);
    }
}
