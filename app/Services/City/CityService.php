<?php

namespace App\Services\City;

use App\Models\City\City;
use App\Models\Apartment\Apartment;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de ciudades y sus relaciones con apartamentos y planes familiares.
 */
class CityService
{
    /**
     * Obtiene el listado completo de ciudades registradas.
     * @return array Respuesta estructurada con la colección de ciudades.
     */
    public static function getAll()
    {
        $city = City::all();

        if ($city->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay ciudades registradas",
                "data" => $city,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "ciudades obtenidos exitosamente",
            "data" => $city,
        ];
    }

    /**
     * Busca una ciudad específica por su identificador único.
     * @param int|string $id ID de la ciudad.
     */
    public function getById($id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad obtenida exitosamente",
            "data" => $city,
        ];
    }

    /**
     * Registra una nueva ciudad en el sistema.
     * @param array $data Datos de la ciudad (nombre, apartment_id, etc).
     */
    public function create(array $data)
    {
        $city = City::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Ciudades creada exitosamente",
            "data" => $city,
        ];
    }

    /**
     * Actualiza todos los campos de una ciudad existente.
     */
    public function update(array $data, $id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad actualizada exitosamente",
            "data" => $city,
        ];
    }

    /**
     * Actualiza parcialmente los datos de una ciudad (PATCH).
     */
    public function partialUpdate(array $data,$id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudadad actualizada parcialmente exitosamente",
            "data" => $city,
        ];
    }

    /**
     * Modifica el estado de activación de la ciudad.
     */
    public function changeState(array $data,$id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de la ciudad actualizado correctamente",
            "data" => $city,
        ];
    }

    /**
     * Elimina una ciudad si no tiene planes familiares asociados.
     * @return array Error 409 si existen registros relacionados.
     */
    public function delete($id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }
        
        // Verificación de integridad referencial con el Plan Familiar
        if ($city->familyPlan->count()){
            return [
                "error" => true,
                "code" => 409, // Conflict: Existen dependencias
                "message" => "No se puede eliminar la ciudad porque tiene registros relacionados",
            ];
        }

        $city->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad eliminado exitosamente",
        ];
    }

    /**
     * Obtiene todas las ciudades que pertenecen a un apartamento específico.
     * @param int|string $id ID del apartamento.
     */
    public static function getAllForApartments($id)
    {
        // Buscamos primero el apartamento para acceder a su relación
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No existe este apartamento",
                "data" => $apartment,
            ];
        }
        
        // Accedemos a la relación 'city' definida en el modelo Apartment
        $city = $apartment->city;

        if (!$city){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No existen ciudades relacionadas al apartamento",
                "data" => $city,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "ciudades obtenidos exitosamente",
            "data" => $city,
        ];
    }
}