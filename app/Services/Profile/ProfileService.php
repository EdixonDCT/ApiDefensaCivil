<?php

namespace App\Services\Profile;

use App\Models\Profile\Profile;
use Illuminate\support\Arr;

/**
 * Servicio para gestionar la información de perfil de los usuarios.
 * Maneja datos extendidos como organización, género y detalles personales.
 */
class ProfileService
{
    /**
     * Obtiene todos los perfiles registrados en el sistema.
     */
    public static function getAll()
    {
        $profile = Profile::all();

        if ($profile->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay estados de perfiles registrados",
                "data" => $profile,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfiles obtenidos exitosamente",
            "data" => $profile,
        ];
    }

    /**
     * Obtiene un perfil específico por su ID.
     */
    public function getById($id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil obtenido exitosamente",
            "data" => $profile,
        ];
    }

    /**
     * Crea un perfil para un usuario.
     * Generalmente se llama durante el proceso de registro.
     */
    public function create(array $data)
    {
        $profile = Profile::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Perfil creado exitosamente",
            "data" => $profile,
        ];
    }

    /**
     * Actualización total de los datos del perfil.
     */
    public function update(array $data, $id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado",
            ];
        }

        $profile->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil actualizado exitosamente",
            "data" => $profile,
        ];
    }

    /**
     * Actualización parcial del perfil.
     * Útil para actualizar solo un campo (como el teléfono o la dirección).
     */
    public function partialUpdate(array $data,$id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado", // Corregido: decía 'Organización'
            ];
        }

        $profile->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil actualizado parcialmente exitosamente",
            "data" => $profile,
        ];
    }

    /**
     * Elimina un perfil del sistema.
     */
    public function delete($id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado",
            ];
        }
        
        $profile->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil eliminado exitosamente",
        ];
    }
}