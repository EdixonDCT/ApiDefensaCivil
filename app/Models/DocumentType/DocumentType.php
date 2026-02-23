<?php

namespace App\Models\DocumentType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Profile\Profile;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

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
        'name',
        'acronym',
        'is_active'
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Un tipo de documento puede ser utilizado por muchos perfiles.
     */
    public function profile()
    {
        return $this->hasMany(Profile::class, 'document_type_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     * Permite registrar creación, edición, activación,
     * desactivación o eliminación del tipo de documento.
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
