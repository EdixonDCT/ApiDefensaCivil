<?php

namespace App\Services\ConditionType;

use App\Models\ConditionType\ConditionType;

/**
 * Servicio para gestionar la lógica de negocio
 * de los registros de ConditionType.
 */
class ConditionTypeService
{
    /**
     * Obtiene la lista completa de ConditionType.
     *
     * @return array
     */
    public static function getAll()
    {
        $conditionTypes = ConditionType::all();

        if ($conditionTypes->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de tipos de condición",
                "data" => $conditionTypes,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipos de condición obtenidos exitosamente",
            "data" => $conditionTypes,
        ];
    }

    /**
     * Obtiene un registro específico por su ID.
     *
     * @param int|string $id
     * @return array
     */
    public function getById($id)
    {
        $conditionType = ConditionType::find($id);

        if (!$conditionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de condición no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de condición obtenido exitosamente",
            "data" => $conditionType,
        ];
    }

    /**
     * Crea un nuevo registro de ConditionType.
     *
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $conditionType = ConditionType::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Tipo de condición creado exitosamente",
            "data" => $conditionType,
        ];
    }

    /**
     * Actualización total de un registro (PUT).
     *
     * @param array $data
     * @param int|string $id
     * @return array
     */
    public function update(array $data, $id)
    {
        $conditionType = ConditionType::find($id);

        if (!$conditionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de condición no encontrado",
            ];
        }

        $conditionType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de condición actualizado exitosamente",
            "data" => $conditionType,
        ];
    }

    /**
     * Actualización parcial de un registro (PATCH).
     *
     * @param array $data
     * @param int|string $id
     * @return array
     */
    public function partialUpdate(array $data, $id)
    {
        $conditionType = ConditionType::find($id);

        if (!$conditionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de condición no encontrado",
            ];
        }

        $conditionType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de condición actualizado parcialmente exitosamente",
            "data" => $conditionType,
        ];
    }

    /**
     * Elimina un registro de ConditionType.
     *
     * @param int|string $id
     * @return array
     */
    public function delete($id)
    {
        $conditionType = ConditionType::find($id);

        if (!$conditionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de condición no encontrado",
            ];
        }

        $conditionType->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de condición eliminado exitosamente",
        ];
    }
}
