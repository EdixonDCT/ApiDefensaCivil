<?php

namespace App\Models\DocumentType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile\Profile;

/**
 * Modelo DocumentType
 * Define los tipos de documentos de identidad permitidos (C.C., T.I., C.E., etc.).
 */
class DocumentType extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'id', 
        'name',      // Nombre completo (ej: 'Cédula de Ciudadanía')
        'acronym',   // Abreviatura (ej: 'CC')
        'is_active'  // Estado lógico del registro
    ];

    /**
     * Relación de Uno a Muchos (One-to-Many).
     * Un tipo de documento puede ser utilizado por muchos perfiles de usuario.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        // Conecta este tipo de documento con todos los perfiles que lo posean
        return $this->hasMany(Profile::class, 'document_type_id');
    }
}