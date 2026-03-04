<?php

namespace App\Services\Department;

use App\Models\Department\Department;
use App\Models\Sectional\Sectional;
use Illuminate\Support\Arr;

/**
 * Servicio para gestionar la lógica de negocio de los departamentos.
 */
class DepartmentService
{
    /**
     * Obtiene la lista completa de departamentos.
     * * @return array Respuesta con la colección de departamentos.
     */
    public static function getAll()
    {
        $department = Department::all();

        if ($department->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay departamentos registrados",
                "data" => $department,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Departamentos obtenidos exitosamente",
            "data" => $department,
        ];
    }

    /**
     * Obtiene un departamento específico por su ID.
     * * @param int|string $id Identificador del departamento.
     * @return array Datos del departamento o error 404.
     */
    public function getById($id)
    {
        $department = Department::find($id);

        if (!$department){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Departamento no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Departamento obtenido exitosamente",
            "data" => $department,
        ];
    }

    /**
     * Crea un nuevo departamento.
     * * @param array $data Datos para la creación.
     * @return array Objeto creado con código 201.
     */
    public function create(array $data)
    {
        $department = Department::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Departamento creado exitosamente",
            "data" => $department,
        ];
    }

    /**
     * Actualización total de un departamento.
     * * @param array $data Datos a actualizar.
     * @param int|string $id ID del departamento.
     * @return array Resultado de la actualización.
     */
    public function update(array $data, $id)
    {
        $department = Department::find($id);

        if (!$department){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Departamento no encontrado",
            ];
        }

        $department->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Departamento actualizado exitosamente",
            "data" => $department,
        ];
    }

    /**
     * Elimina un departamento, validando que no tenga registros dependientes.
     * * @param int|string $id ID del departamento a eliminar.
     * @return array Confirmación o error 409 si hay integridad referencial en juego.
     */
    public function delete($id)
    {
        $department = Department::find($id);

        if (!$department){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Departamento no encontrado",
            ];
        }
        
        // Verificación de integridad: Evita borrar si tiene ciudades relacionadas
        if ($department->city->count()) {
            return [
                "error" => true,
                "code" => 409, // Conflict
                "message" => "No se puede eliminar el departamento porque tiene registros relacionados",
            ];
        }

        $department->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Departamento eliminado exitosamente",
        ];
    }
}