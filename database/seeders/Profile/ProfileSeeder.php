<?php

namespace Database\Seeders\Profile;

use Illuminate\Database\Seeder;
use App\Models\Profile\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'user_id' => 1,
            'names' => 'Edixon',
            'last_names' => 'Perez',
            'birth_date' => '1995-01-01',
            'document_type_id' => 1,
            'document_number' => '12345678',
            'phone' => '1234567892',
            'gender_id' => 1,
            'organization_id' => 1,
        ]);

        Profile::create([
            'user_id' => 2,
            'names' => 'Bruno',
            'last_names' => 'Diaz',
            'birth_date' => '1990-05-10',
            'document_type_id' => 1,
            'document_number' => '87654321',
            'phone' => '1234567891',
            'gender_id' => 1,
            'organization_id' => 1,
        ]);

        Profile::create([
            'user_id' => 3,
            'names' => 'Dann',
            'last_names' => 'Silva',
            'birth_date' => '1998-11-20',
            'document_type_id' => 1,
            'document_number' => '11223344',
            'phone' => '1234567893',
            'gender_id' => 2,
            'organization_id' => 1,
        ]);

        Profile::create([
            'user_id' => 4,
            'names' => 'Usuario',
            'last_names' => 'Prueba',
            'birth_date' => '2000-01-01',
            'document_type_id' => 1,
            'document_number' => '00000000',
            'phone' => '1234567890',
            'gender_id' => 1,
            'organization_id' => 1,
        ]);
    }
}