<?php

namespace App\Services\Nationality;

use App\Models\Nationality\Nationality;
use Illuminate\Support\Arr;

/**
 * Servicio encargado de la gestión de las nacionalidades del sistema.
 */
class NationalityService
{
    /**
     * Obtiene la lista completa de nacionalidades registradas.
     * @return array Respuesta con la colección de nacionalidades.
     */
    public static function getAll()
    {
        $nationality = Nationality::all();

        if ($nationality->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay nacionalidades registradas",
                "data" => $nationality,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Nacionalidades obtenidas exitosamente",
            "data" => $nationality,
        ];
    }

    /**
     * Busca una nacionalidad específica por su ID.
     * @param int|string $id
     * @return array
     */
    public function getById($id)
    {
        $nationality = Nationality::find($id);

        if (!$nationality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Nacionalidad no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Nacionalidad obtenida exitosamente",
            "data" => $nationality,
        ];
    }

    /**
     * Crea un nuevo registro de nacionalidad.
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $nationality = Nationality::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Nacionalidad creada exitosamente",
            "data" => $nationality,
        ];
    }

    /**
     * Actualización total de la información de una nacionalidad.
     */
    public function update(array $data, $id)
    {
        $nationality = Nationality::find($id);

        if (!$nationality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Nacionalidad no encontrada",
            ];
        }

        $nationality->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Nacionalidad actualizada exitosamente",
            "data" => $nationality,
        ];
    }

    /**
     * Actualización parcial de los datos de la nacionalidad.
     */
    public function partialUpdate(array $data, $id)
    {
        $nationality = Nationality::find($id);

        if (!$nationality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Nacionalidad no encontrada",
            ];
        }

        $nationality->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Nacionalidad actualizada parcialmente exitosamente",
            "data" => $nationality,
        ];
    }

    /**
     * Modifica el estado de habilitación de la nacionalidad.
     */
    public function changeState(array $data, $id)
    {
        $nationality = Nationality::find($id);

        if (!$nationality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Nacionalidad no encontrada",
            ];
        }

        $nationality->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de la nacionalidad actualizado correctamente",
            "data" => $nationality,
        ];
    }

    /**
     * Elimina una nacionalidad, validando primero que no esté en uso por ningún perfil.
     * @param int|string $id
     * @return array
     */
    public function delete($id)
    {
        $nationality = Nationality::find($id);

        if (!$nationality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Nacionalidad no encontrada",
            ];
        }
        
        $nationality->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Nacionalidad eliminada exitosamente",
        ];
    }
}
