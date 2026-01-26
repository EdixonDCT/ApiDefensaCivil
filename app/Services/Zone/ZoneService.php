<?php

namespace App\Services\Zone;

use App\Models\Zone\Zone;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de Tipos de Zonas.
 * Clasifica la ubicación de los planes familiares (ej. Urbano, Rural, Periurbano).
 */
class ZoneService
{
    /**
     * Obtiene todos los tipos de zonas registrados en el sistema.
     */
    public static function getAll()
    {
        $zone = Zone::all();

        if ($zone->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tipos de zonas registrados",
                "data" => $zone,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipos de zonas obtenidos exitosamente",
            "data" => $zone,
        ];
    }

    /**
     * Busca un tipo de zona específico por su ID.
     */
    public function getById($id)
    {
        $zone = Zone::find($id);

        if (!$zone){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de zona no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de zona obtenida exitosamente",
            "data" => $zone,
        ];
    }

    /**
     * Registra una nueva categoría de zona.
     */
    public function create(array $data)
    {
        $zone = Zone::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Tipo de zona creada exitosamente",
            "data" => $zone,
        ];
    }

    /**
     * Actualiza la información de una zona existente.
     */
    public function update(array $data, $id)
    {
        $zone = Zone::find($id);

        if (!$zone){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de zona no encontrada",
            ];
        }

        $zone->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de zona actualizada exitosamente",
            "data" => $zone,
        ];
    }

    /**
     * Elimina un tipo de zona siempre que no tenga planes familiares asociados.
     * Mantiene la integridad referencial de la base de datos.
     */
    public function delete($id)
    {
        $zone = Zone::find($id);

        if (!$zone){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de zona no encontrada",
            ];
        }
        
        // Verificación de relaciones con planes familiares
        if ($zone->familyPlan->count()){
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el tipo de zona porque tiene registros relacionados",
            ];
        }

        $zone->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de zona eliminada exitosamente",
        ];
    }
}