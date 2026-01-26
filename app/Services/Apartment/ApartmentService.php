<?php

namespace App\Services\Apartment;

use App\Models\Apartment\Apartment;
use App\Models\Sectional\Sectional;
use Illuminate\Support\Arr;

/**
 * Servicio para gestionar la lógica de negocio de los Apartamentos.
 */
class ApartmentService
{
    /**
     * Obtiene la lista completa de apartamentos.
     * * @return array Respuesta con la colección de apartamentos.
     */
    public static function getAll()
    {
        $apartment = Apartment::all();

        if ($apartment->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay apartamentos registrados",
                "data" => $apartment,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamentos obtenidos exitosamente",
            "data" => $apartment,
        ];
    }

    /**
     * Obtiene un apartamento específico por su ID.
     * * @param int|string $id Identificador del apartamento.
     * @return array Datos del apartamento o error 404.
     */
    public function getById($id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento obtenido exitosamente",
            "data" => $apartment,
        ];
    }

    /**
     * Crea un nuevo apartamento.
     * * @param array $data Datos para la creación.
     * @return array Objeto creado con código 201.
     */
    public function create(array $data)
    {
        $apartment = Apartment::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Apartamento creado exitosamente",
            "data" => $apartment,
        ];
    }

    /**
     * Actualización total de un apartamento.
     * * @param array $data Datos a actualizar.
     * @param int|string $id ID del apartamento.
     * @return array Resultado de la actualización.
     */
    public function update(array $data, $id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        $apartment->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento actualizado exitosamente",
            "data" => $apartment,
        ];
    }

    /**
     * Actualización parcial (PATCH) de un apartamento.
     * * @param array $data Campos específicos a modificar.
     * @param int|string $id ID del apartamento.
     * @return array
     */
    public function partialUpdate(array $data, $id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        $apartment->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento actualizado parcialmente exitosamente",
            "data" => $apartment,
        ];
    }

    /**
     * Cambia exclusivamente el estado (activo/inactivo) del apartamento.
     * * @param array $data Debe contener el nuevo estado.
     * @param int|string $id ID del apartamento.
     * @return array
     */
    public function changeState(array $data, $id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        $apartment->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de apartamento actualizado correctamente",
            "data" => $apartment,
        ];
    }

    /**
     * Elimina un apartamento, validando que no tenga registros dependientes.
     * * @param int|string $id ID del apartamento a eliminar.
     * @return array Confirmación o error 409 si hay integridad referencial en juego.
     */
    public function delete($id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }
        
        // Verificación de integridad: Evita borrar si tiene ciudades relacionadas
        if ($apartment->city->count()) {
            return [
                "error" => true,
                "code" => 409, // Conflict
                "message" => "No se puede eliminar el Apartamento porque tiene registros relacionados",
            ];
        }

        $apartment->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento eliminado exitosamente",
        ];
    }
}