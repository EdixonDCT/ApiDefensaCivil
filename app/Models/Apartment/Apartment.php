<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\City\City;

/**
 * Modelo Apartment
 * Gestiona la información de las unidades habitacionales (Apartamentos).
 */
class Apartment extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'id',   // Identificador único
        'name'  // Nombre o número del apartamento (ej: 'Apto 101')
    ];

    /**
     * Relación de Uno a Muchos (One-to-Many).
     * Según la estructura definida, un apartamento puede tener asociadas varias ciudades.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function city()
    {
        // Define que este apartamento es la "llave" para encontrar ciudades
        return $this->hasMany(City::class, 'apartment_id');
    }
}