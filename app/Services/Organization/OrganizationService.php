<?php

namespace App\Services\Organization;

use App\Models\Organization\Organization;
use App\Models\Sectional\Sectional;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de Organizaciones (Unidades locales/Grupos).
 * Vincula la estructura administrativa con los usuarios finales.
 */
class OrganizationService
{
    /**
     * Obtiene el listado global de todas las organizaciones.
     */
    public static function getAll()
    {
        $organization = Organization::all();

        if ($organization->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay organizaciones registradas",
                "data" => $organization,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "organizaciones obtenidos exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Obtiene una organización específica por su ID.
     */
    public function getById($id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion obtenido exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Crea una nueva organización vinculada a una seccional.
     */
    public function create(array $data)
    {
        $organization = Organization::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Organizacion creado exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Actualización total de los datos de la organización.
     */
    public function update(array $data, $id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $organization->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion actualizado exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Actualización parcial (solo campos enviados).
     */
    public function partialUpdate(array $data,$id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $organization->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion actualizado parcialmente exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Cambia el estado (Activo/Inactivo) de la organización.
     */
    public function changeState(array $data,$id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $organization->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de organizacion actualizado correctamente",
            "data" => $organization,
        ];
    }

    /**
     * Elimina la organización validando que no tenga usuarios (perfiles) asociados.
     */
    public function delete($id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }
        
        // Bloqueo de eliminación si hay perfiles vinculados
        if ($organization->profile->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la organizacion porque tiene registros relacionados",
            ];
        }

        $organization->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion eliminado exitosamente",
        ];
    }

    /**
     * Filtra y obtiene las organizaciones pertenecientes a una seccional específica.
     * Útil para desplegables dependientes en el registro.
     * @param int $id ID de la Seccional.
     */
    public static function getAllForSectional($id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No existe esta seccional",
                "data" => null,
            ];
        }
        
        // Asumiendo relación hasMany en el modelo Sectional
        $organization = $sectional->organization;

        if (!$organization || $organization->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No existen organizaciones relacionadas a la seccional",
                "data" => [],
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "organizaciones obtenidos exitosamente",
            "data" => $organization,
        ];
    }
}