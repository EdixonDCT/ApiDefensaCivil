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
        ]);
        DocumentType::create([
            'name' => 'Tarjeta de Identidad',
            'acronym' => 'TI',
        ]);
        DocumentType::create([
            'name' => 'Cédula de Ciudadanía',
            'acronym' => 'CC',
        ]);
        DocumentType::create([
            'name' => 'Cédula de Extranjería',
            'acronym' => 'CE',
        ]);
        DocumentType::create([
            'name' => 'Pasaporte',
            'acronym' => 'PP',
        ]);
        DocumentType::create([
            'name' => 'Permiso Especial de Permanencia  ',
            'acronym' => 'PEP',
        ]);
    }
}
