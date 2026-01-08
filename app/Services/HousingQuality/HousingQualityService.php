<?php

namespace App\Services\HousingQuality;

use App\Models\HousingQuality\HousingQuality;
use Illuminate\support\Arr;

class HousingQualityService
{
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

    public function partialUpdate(array $data,$id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Caldiad de vivienda no encontrada",
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

    public function changeState(array $data,$id)
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

    public function delete($id)
    {
        $housingQuality = housingQuality::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }
        
        if ($housingQuality->familyPlan->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la calidad de vivienda porque tiene registros relacionados",
            ];
        }

        $gender->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda eliminada exitosamente",
        ];
    }
}
