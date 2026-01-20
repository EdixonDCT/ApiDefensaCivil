<?php

namespace App\Services\VulnerableQuestion;

use App\Models\VulnerableQuestion\VulnerableQuestion;

class VulnerableQuestionService
{
    public static function getAll()
    {
        $questions = VulnerableQuestion::all();

        if ($questions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay preguntas vulnerables registradas",
                "data" => $questions,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Preguntas vulnerables obtenidas exitosamente",
            "data" => $questions,
        ];
    }

    public function getById($id)
    {
        $question = VulnerableQuestion::find($id);

        if (!$question) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Pregunta vulnerable no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Pregunta vulnerable obtenida exitosamente",
            "data" => $question,
        ];
    }

    public function create(array $data)
    {
        $question = VulnerableQuestion::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Pregunta vulnerable creada exitosamente",
            "data" => $question,
        ];
    }

    public function update(array $data, $id)
    {
        $question = VulnerableQuestion::find($id);

        if (!$question) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Pregunta vulnerable no encontrada",
            ];
        }

        $question->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Pregunta vulnerable actualizada exitosamente",
            "data" => $question,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $question = VulnerableQuestion::find($id);

        if (!$question) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Pregunta vulnerable no encontrada",
            ];
        }

        $question->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Pregunta vulnerable actualizada parcialmente exitosamente",
            "data" => $question,
        ];
    }

    public function changeState(array $data, $id)
    {
        $question = VulnerableQuestion::find($id);

        if (!$question) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Pregunta vulnerable no encontrada",
            ];
        }

        $question->update([
            'is_active' => $data['is_active']
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de la pregunta vulnerable actualizado correctamente",
            "data" => $question,
        ];
    }

    public function delete($id)
    {
        $question = VulnerableQuestion::find($id);

        if (!$question) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Pregunta vulnerable no encontrada",
            ];
        }

        $question->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Pregunta vulnerable eliminada exitosamente",
        ];
    }
}
