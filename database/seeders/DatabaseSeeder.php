<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\Pulso;
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
        //Paciente::factory(10)->create();
        $pulso=Pulso::find(1);
        if(!$pulso){
            $pulso=new Pulso();
            $pulso->data='[38,50,60,40,12,16]';
            $pulso->valor=0;
            $pulso->estado='';
            $pulso->save();
        }
    }
}
