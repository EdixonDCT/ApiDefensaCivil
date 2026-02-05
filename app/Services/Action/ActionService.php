<?php

namespace App\Services\Action;

use App\Models\Action\Action;

/**
 * Servicio encargado de gestionar la lógica de negocio para el modelo Action.
 */
class ActionService
{
    /**
     * Obtiene todos los registros de acciones.
     * * @return array Respuesta estructurada con la colección de acciones.
     */
    public function getAll()
    {
        // Recuperamos todas las acciones desde la base de datos
        $actions = Action::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => $actions->isEmpty()
                ? "No hay acciones registradas"
                : "Acciones obtenidas exitosamente",
            "data" => $actions,
        ];
    }

    /**
     * Busca una acción específica por su ID.
     * * @param int|string $id Identificador de la acción.
     * @return array Respuesta con los datos de la acción o mensaje de error 404.
     */
    public function getById($id)
    {
        $action = Action::find($id);

        // Validamos si el registro existe antes de continuar
        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción obtenida exitosamente",
            "data" => $action,
        ];
    }

    /**
     * Crea un nuevo registro de acción en la base de datos.
     * * @param array $data Datos validados para la creación.
     * @return array Respuesta con el objeto recién creado.
     */
    public function create(array $data)
    {
        $action = Action::create($data);

        return [
            "error" => false,
            "code" => 201, // 201 significa "Created"
            "message" => "Acción creada exitosamente",
            "data" => $action,
        ];
    }

    /**
     * Actualiza una acción existente.
     * * @param array $data Nuevos datos para el registro.
     * @param int|string $id ID de la acción a modificar.
     * @return array Respuesta confirmando la actualización o error si no existe.
     */
    public function update(array $data, $id)
    {
        $action = Action::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción no encontrada",
            ];
        }

        // Aplicamos los cambios y guardamos
        $action->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción actualizada exitosamente",
            "data" => $action,
        ];
    }

    /**
     * Elimina una acción de la base de datos.
     * * @param int|string $id ID de la acción a eliminar.
     * @return array Respuesta confirmando la eliminación.
     */
    public function delete($id)
    {
        $action = Action::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción no encontrada",
            ];
        }

        // Ejecutamos la eliminación física (o lógica si usas SoftDeletes)
        $action->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción eliminada exitosamente",
        ];
    }
}