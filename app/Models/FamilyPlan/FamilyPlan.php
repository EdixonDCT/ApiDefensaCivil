<?php

namespace App\Models\FamilyPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Audit\Audit; // 🔹 Importar Audit para la relación

/** * Importación de modelos relacionados para definir las relaciones Eloquent 
 */
use App\Models\Zone\Zone;
use App\Models\City\City;
use App\Models\HousingQuality\HousingQuality;
use App\Models\Sector\Sector;
use App\Models\StatusPlan\StatusPlan;
use App\Models\Sectional\Sectional;
use App\Models\VulnerableTest\VulnerableTest;
use App\Models\FamilyMember\FamilyMember;
use App\Models\Pet\Pet;

/**
 * Clase FamilyPlan
 * * Este modelo es la entidad central del sistema. Coordina la información de 
 * los planes de intervención familiar, vinculando datos geográficos, 
 * socioeconómicos y el historial de acciones ejecutadas.
 */
class FamilyPlan extends Model
{
    use HasFactory;

    /**
     * Atributos que pueden ser asignados de forma masiva (Mass Assignment).
     * Se incluyen todos los campos necesarios para la creación y edición del plan.
     * * @var array
     */
    protected $fillable = [
        'id',
        'name',               // Nombre identificador del plan
        'last_names',         // Apellidos del grupo familiar
        'zone_id',            // Referencia a la zona geográfica
        'address',            // Dirección física de residencia
        'landline_phone',     // Teléfono fijo de contacto
        'georeference',       // Coordenadas o datos de ubicación GPS
        'city_id',            // Ciudad de residencia
        'housing_quality_id', // Calidad de la vivienda (maestra)
        'sector_id',          // ID del sector económico/social
        'sector_name',        // Nombre del sector (en caso de ser manual)
        'status_plan_id',     // Estado actual del plan (ej. Activo, Cerrado)
        'sectional_id',       // Seccional a la que pertenece el registro
        'user_id',            // Usuario responsable o creador del plan
        'comentary',          // Comentarios adicionales o notas del plan
        'authorization'       // Consentimiento o autorización (booleano)
    ];

    /**
     * Valores predeterminados para los atributos del modelo.
     * * Al instanciar un nuevo Plan Familiar, se asigna automáticamente 
     * el status_plan_id con valor 5 ya que es incompleto y apenas se esta realizando.
     * * @var array
     */
    protected $attributes = [
        'status_plan_id' => 1, // Valor predeterminado para "Registrado pero solo para que el voluntario lo vea"
    ];

    /**
     * --- RELACIONES BELONGS TO (Muchos a Uno) ---
     * Cada Plan Familiar pertenece a una única categoría de las siguientes tablas:
     */

    // Relación con la Zona geográfica
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    // Relación con la Ciudad
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    // Relación con la Calidad de Vivienda
    public function housingQuality()
    {
        return $this->belongsTo(HousingQuality::class, 'housing_quality_id');
    }

    // Relación con el Sector (Nótese el nombre en mayúscula según tu código original)
    public function Sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    // Relación con el Estado del Plan
    public function StatusPlan()
    {
        return $this->belongsTo(StatusPlan::class, 'status_plan_id');
    }

    // Relación con la Seccional administrativa
    public function Sectional()
    {
        return $this->belongsTo(Sectional::class, 'sectional_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * Un Plan Familiar puede tener múltiples registros asociados en las siguientes tablas:
     */

    /**
     * Obtiene todos los tests de vulnerabilidad aplicados a esta familia.
     */
    public function vulnerableTest()
    {
        return $this->hasMany(VulnerableTest::class, 'family_plan_id');
    }

    /**
     * Obtiene el historial completo de acciones y movimientos realizados sobre este plan.
     */
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'family_plan_id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'family_plan_id');
    }
    public function riskFactors()
    {
        return $this->hasMany(RiskFactor::class, 'family_plan_id');
    }
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}