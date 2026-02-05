<?php

namespace App\Services\HousingQuality;

use App\Models\HousingQuality\HousingQuality;
use Illuminate\support\Arr;

/**
 * Servicio para gestionar los parámetros de calidad de la vivienda.
 */
class HousingQualityService
{
    /**
     * Obtiene todos los registros de calidad de vivienda.
     */
    public static function getAll()
    {
        $housingQuality = HousingQuality::all();

        if ($housingQuality->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay calidades de vivienda registradas",
                "data" => $housingQuality,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidades de vivienda obtenidos exitosamente",
            "data" => $housingQuality,
        ];
    }

    /**
     * Obtiene un registro específico por ID.
     */
    public function getById($id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda obtenida exitosamente",
            "data" => $housingQuality,
        ];
    }

    /**
     * Crea un nuevo parámetro de calidad de vivienda.
     */
    public function create(array $data)
    {
        $housingQuality = HousingQuality::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Calidad de vivienda creado exitosamente",
            "data" => $housingQuality,
        ];
    }

    /**
     * Actualización total del registro.
     */
    public function update(array $data, $id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $housingQuality->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda actualizada exitosamente",
            "data" => $housingQuality,
        ];
    }

    /**
     * Actualización parcial del registro.
     */
    public function partialUpdate(array $data, $id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $housingQuality->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda actualizada parcialmente exitosamente",
            "data" => $housingQuality,
        ];
    }

    /**
     * Activa o desactiva el parámetro de calidad.
     */
    public function changeState(array $data, $id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $housingQuality->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de calidad de vivienda actualizado correctamente",
            "data" => $housingQuality,
        ];
    }

    /**
     * Elimina el registro si no está vinculado a planes familiares.
     */
    public function delete($id)
    {
        // Corrección: Usamos la variable correcta $housingQuality
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }
        
        // Validación de integridad referencial
        if ($housingQuality->familyPlan->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la calidad de vivienda porque tiene registros relacionados",
            ];
        }

        $housingQuality->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda eliminada exitosamente",
        ];
    }
}