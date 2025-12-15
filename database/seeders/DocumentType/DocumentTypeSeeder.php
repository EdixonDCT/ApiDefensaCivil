<?php

namespace Database\Seeders\DocumentType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        DocumentType::create([
            'name' => 'Registro Civil',
            'acronym' => 'RC',
            'state' => 1
        ]);
        DocumentType::create([
            'name' => 'Tarjeta de Identidad',
            'acronym' => 'TI',
            'state' => 1
        ]);
        DocumentType::create([
            'name' => 'Cédula de Ciudadanía',
            'acronym' => 'CC',
            'state' => 1
        ]);
        DocumentType::create([
            'name' => 'Cédula de Extranjería',
            'acronym' => 'CE',
            'state' => 1
        ]);
        DocumentType::create([
            'name' => 'Pasaporte',
            'acronym' => 'PP',
            'state' => 1
        ]);
        DocumentType::create([
            'name' => 'Permiso Especial de Permanencia  ',
            'acronym' => 'PEP',
            'state' => 1
        ]);
    }
}
