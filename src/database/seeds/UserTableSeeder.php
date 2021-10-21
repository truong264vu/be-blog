<?php

use Illuminate\Database\Seeder;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'avatar' => 'https://firebasestorage.googleapis.com/v0/b/my-blog-image.appspot.com/o/avatar.jpg?alt=media&token=a4abed2a-bc04-4cec-bcc0-4579d7d68f41',
                'name' => 'truong' , 
                'email' => 'truong@gmail.com', 
                'password' => Hash::make('111111') , 
                'role' => 'admin'
            ],
        ]);
    }
}