<?php

namespace App\Services\Sectional;

use App\Models\Sectional\Sectional;
use Illuminate\support\Arr;

/**
 * Servicio para gestionar las Seccionales.
 * Representa la unidad regional principal de la organización.
 */
class SectionalService
{
    /**
     * Obtiene el listado de todas las seccionales registradas.
     */
    public static function getAll()
    {
        $sectional = Sectional::all();
        if ($sectional->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay seccionales registradas",
                "data" => $sectional,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccionales obtenidas exitosamente",
            "data" => $sectional,
        ];
    }

    /**
     * Obtiene una seccional por su ID.
     */
    public function getById($id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional obtenida exitosamente",
            "data" => $sectional,
        ];
    }

    /**
     * Registra una nueva seccional.
     */
    public function create(array $data)
    {
        $sectional = Sectional::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Seccional creada exitosamente",
            "data" => $sectional,
        ];
    }

    /**
     * Actualiza todos los campos de una seccional.
     */
    public function update(array $data, $id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        $sectional->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional actualizada exitosamente",
            "data" => $sectional,
        ];
    }

    /**
     * Actualización parcial de datos de la seccional.
     */
    public function partialUpdate(array $data,$id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        $sectional->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional actualizado parcialmente exitosamente",
            "data" => $sectional,
        ];
    }

    /**
     * Cambia el estado (habilitado/deshabilitado) de la seccional.
     */
    public function changeState(array $data,$id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        $sectional->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de seccional actualizado correctamente",
            "data" => $sectional,
        ];
    }

    /**
     * Elimina una seccional validando que no tenga organizaciones dependientes.
     * Esta validación previene errores de clave foránea y pérdida de integridad.
     */
    public function delete($id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        // Verifica si hay organizaciones vinculadas (relación hasMany)
        if ($sectional->organization->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la seccional porque tiene registros relacionados",
            ];
        }

        $sectional->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional eliminado exitosamente",
        ];
    }
}