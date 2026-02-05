<?php

namespace App\Services\Gender;

use App\Models\Gender\Gender;
use Illuminate\support\Arr;

/**
 * Servicio encargado de la gestión de los géneros del sistema.
 */
class GenderService
{
    /**
     * Obtiene la lista completa de géneros registrados.
     * @return array Respuesta con la colección de géneros.
     */
    public static function getAll()
    {
        $gender = Gender::all();

        if ($gender->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay generos registrados",
                "data" => $gender,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Generos obtenidos exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Busca un género específico por su ID.
     * @param int|string $id
     * @return array
     */
    public function getById($id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero obtenido exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Crea un nuevo registro de género.
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $gender = Gender::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Genero creado exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Actualización total de la información de un género.
     */
    public function update(array $data, $id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero actualizado exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Actualización parcial de los datos del género.
     */
    public function partialUpdate(array $data,$id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero actualizado parcialmente exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Modifica el estado de habilitación del género.
     */
    public function changeState(array $data,$id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de genero actualizado correctamente",
            "data" => $gender,
        ];
    }

    /**
     * Elimina un género, validando primero que no esté en uso por ningún perfil.
     * @param int|string $id
     * @return array
     */
    public function delete($id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }
        
        // Verificación de integridad: No permite eliminar si existen perfiles vinculados
        if ($gender->profile->count()) {
            return [
                "error" => true,
                "code" => 409, // Conflict: Indica que la petición no se puede completar por conflictos
                "message" => "No se puede eliminar el genero porque tiene registros relacionados",
            ];
        }

        $gender->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero eliminado exitosamente",
        ];
    }
}