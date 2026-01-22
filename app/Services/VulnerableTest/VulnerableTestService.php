<?php

namespace App\Services\VulnerableTest;

use App\Models\VulnerableTest\VulnerableTest;

class VulnerableTestService
{
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
