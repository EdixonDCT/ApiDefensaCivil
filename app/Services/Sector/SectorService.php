<?php

namespace App\Services\Sector;

use App\Models\Sector\Sector;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de Sectores.
 * Los sectores permiten categorizar la ubicación o el área de influencia de los planes familiares.
 */
class SectorService
{
    /**
     * Obtiene todos los sectores registrados.
     */
    public static function getAll()
    {
        $sector = Sector::all();

        if ($sector->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay sectores registrados",
                "data" => $sector,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sectores obtenidos exitosamente",
            "data" => $sector,
        ];
    }

    /**
     * Obtiene un sector específico por su ID.
     */
    public function getById($id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector obtenido exitosamente",
            "data" => $sector,
        ];
    }

    /**
     * Crea un nuevo sector.
     */
    public function create(array $data)
    {
        $sector = Sector::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Sector creado exitosamente",
            "data" => $sector,
        ];
    }

    /**
     * Actualización completa de un sector.
     */
    public function update(array $data, $id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        $sector->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector actualizado exitosamente",
            "data" => $sector,
        ];
    }

    /**
     * Actualización parcial de los datos del sector.
     */
    public function partialUpdate(array $data,$id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        $sector->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector actualizado parcialmente exitosamente",
            "data" => $sector,
        ];
    }

    /**
     * Modifica el estado de activación del sector.
     */
    public function changeState(array $data,$id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        $sector->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de sector actualizado correctamente",
            "data" => $sector,
        ];
    }

    /**
     * Elimina un sector si no tiene Planes Familiares vinculados.
     */
    public function delete($id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }
        
        // Validación de integridad para evitar errores en cascada
        if ($sector->familyPlan->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el sector porque tiene registros relacionados",
            ];
        }

        $sector->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector eliminado exitosamente",
        ];
    }
}