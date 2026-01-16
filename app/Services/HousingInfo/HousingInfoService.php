<?php

namespace App\Services\HousingInfo;

use App\Models\HousingInfo\HousingInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class HousingInfoService
{
    public function getAll()
    {
        $images = HousingInfo::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => $images->isEmpty() 
                ? "No hay imágenes registradas" 
                : "Imágenes obtenidas exitosamente",
            "data" => $images,
        ];
    }

    public function getById(int $familyPlanId)
    {
        $images = HousingInfo::where('family_plan_id', $familyPlanId)->get();

        return [
            "error" => false,
            "code" => 200,
            "message" => $images->isEmpty() 
                ? "No hay imágenes para este plan familiar" 
                : "Imágenes obtenidas exitosamente",
            "data" => $images,
        ];
    }
    
    public function create(array $data)
    {
        /** @var UploadedFile $file */
        $file = $data['path'];
        $filePath = $file->store('imagenes', 'public');

        $image = HousingInfo::create([
            'family_plan_id' => $data['family_plan_id'],
            'path' => $filePath,
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Imagen creada exitosamente",
            "data" => $image,
        ];
    }

    public function delete(int $id)
    {
         $image = HousingInfo::where('family_plan_id', $id)->first();

        if (!$image) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "No hay imagen para este plan familiar",
            ];
        }

        if ($image->path && Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Imagen eliminada exitosamente",
        ];
    }

}
