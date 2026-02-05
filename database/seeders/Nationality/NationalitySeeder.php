<?php

namespace Database\Seeders\Nationality;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nationality\Nationality;

class NationalitySeeder extends Seeder
{
public function run(): void
{
    // América del Sur
    Nationality::create(['name' => 'Colombiana']);
    Nationality::create(['name' => 'Venezolana']);
    Nationality::create(['name' => 'Peruana']);
    Nationality::create(['name' => 'Argentina']);
    Nationality::create(['name' => 'Chilena']);
    Nationality::create(['name' => 'Ecuatoriana']);
    Nationality::create(['name' => 'Boliviana']);
    Nationality::create(['name' => 'Uruguaya']);
    Nationality::create(['name' => 'Paraguaya']);
    Nationality::create(['name' => 'Brasileña']);

    // América Central
    Nationality::create(['name' => 'Panameña']);
    Nationality::create(['name' => 'Costarricense']);
    Nationality::create(['name' => 'Nicaragüense']);
    Nationality::create(['name' => 'Hondureña']);
    Nationality::create(['name' => 'Salvadoreña']);
    Nationality::create(['name' => 'Guatemalteca']);

    // Caribe
    Nationality::create(['name' => 'Cubana']);
    Nationality::create(['name' => 'Dominicana']);
    Nationality::create(['name' => 'Puertorriqueña']);

    // América del Norte
    Nationality::create(['name' => 'Mexicana']);
    Nationality::create(['name' => 'Estadounidense']);
    Nationality::create(['name' => 'Canadiense']);
    
    //resto del mundo sin especificar
    Nationality::create(['name' => 'Europea']);
    Nationality::create(['name' => 'Asiática']);
    Nationality::create(['name' => 'Africana']);
    }   
}
