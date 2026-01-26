<?php

namespace App\Services\DocumentType;

use App\Models\DocumentType\DocumentType;
use Illuminate\support\Arr;

/**
 * Servicio para gestionar los tipos de documentos de identidad.
 */
class DocumentTypeService
{
    /**
     * Obtiene todos los tipos de documento registrados.
     * @return array
     */
    public static function getAll()
    {
        $documentType = DocumentType::all();

        if ($documentType->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tipos de documento registrados",
                "data" => $documentType,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipos de documento obtenidos exitosamente",
            "data" => $documentType,
        ];
    }

    /**
     * Obtiene un tipo de documento por su ID.
     * @param int|string $id
     * @return array
     */
    public function getById($id)
    {
        $documentType = DocumentType::find($id);

        if (!$documentType){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de documento no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de documento obtenido exitosamente",
            "data" => $documentType,
        ];
    }

    /**
     * Crea un nuevo registro de tipo de documento.
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $documentType = DocumentType::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Tipo de documento creado exitosamente",
            "data" => $documentType,
        ];
    }

    /**
     * Actualización total de un tipo de documento.
     */
    public function update(array $data, $id)
    {
        $documentType = DocumentType::find($id);

        if (!$documentType){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de documento no encontrado",
            ];
        }

        $documentType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de documento actualizado exitosamente",
            "data" => $documentType,
        ];
    }

    /**
     * Actualización parcial de campos específicos.
     */
    public function partialUpdate(array $data,$id)
    {
        $documentType = DocumentType::find($id);

        if (!$documentType){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de documento no encontrado",
            ];
        }

        $documentType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de documento actualizado parcialmente exitosamente",
            "data" => $documentType,
        ];
    }

    /**
     * Cambia el estado (activo/inactivo) del tipo de documento.
     */
    public function changeState(array $data,$id)
    {
        $documentType = DocumentType::find($id);

        if (!$documentType){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de documento no encontrado",
            ];
        }

        $documentType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado del Tipo de documento actualizado correctamente",
            "data" => $documentType,
        ];
    }

    /**
     * Elimina el registro, validando que no esté asignado a ningún perfil de usuario.
     */
    public function delete($id)
    {
        $documentType = DocumentType::find($id);

        if (!$documentType){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de documento no encontrado",
            ];
        }
        
        // Validación de integridad: No borrar si hay perfiles que usan este tipo de documento
        if ($documentType->profile->count()) {
            return [
                "error" => true,
                "code" => 409, // Conflicto por registros relacionados
                "message" => "No se puede eliminar el Tipo de documento porque tiene registros relacionados",
            ];
        }

        $documentType->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de documento eliminado exitosamente",
        ];
    }
}