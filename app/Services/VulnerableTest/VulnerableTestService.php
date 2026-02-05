<?php

namespace App\Services\VulnerableTest;

use App\Models\VulnerableTest\VulnerableTest;

/**
 * Servicio para gestionar la aplicación de los tests de vulnerabilidad.
 * Almacena las respuestas del diagnóstico realizado a cada plan familiar.
 */
class VulnerableTestService
{
    /**
     * Obtiene el historial de todos los tests aplicados en el sistema.
     */
     public function index()
    {
        $tests = VulnerableTest::all();

        if ($tests->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tests vulnerables registrados",
                "data" => $tests,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tests vulnerables obtenidos exitosamente",
            "data" => $tests,
        ];
    }

    /**
     * Obtiene todas las respuestas (items del test) de un Plan Familiar específico.
     * @param int $familyPlan_id
     */
    public function show($familyPlan_id)
    {
        $tests = VulnerableTest::where('family_plan_id', $familyPlan_id)->get();

        if ($tests->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay tests vulnerables para este plan familiar",
                "data" => $tests,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tests vulnerables obtenidos exitosamente",
            "data" => $tests,
        ];
    }

    /**
     * Registra una respuesta individual dentro de un test.
     * Generalmente se ejecuta en un bucle dentro del controlador.
     */
    public function create(array $data)
    {
        $test = VulnerableTest::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Test vulnerable creado exitosamente",
            "data" => $test,
        ];
    }

    /**
     * Elimina todas las respuestas asociadas a un Plan Familiar.
     * Útil para reiniciar un diagnóstico o limpiar datos huérfanos.
     */
    public function delete($familyPlan_id)
    {
        $test = VulnerableTest::where('family_plan_id', $familyPlan_id)->delete();

        if ($test === 0) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No se encontraron tests vulnerables para eliminar",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tests vulnerables eliminados exitosamente",
            "deleted_rows" => $test,
        ];
    }
}