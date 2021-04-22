<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrData = ['Client','Moder','Admin'];
        foreach ($arrData as $value){
            Role::create([
                'name' => $value
            ]);
        }
    }
}
