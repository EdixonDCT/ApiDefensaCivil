<?php

namespace App\Services\VulnerableQuestion;

use App\Models\VulnerableQuestion\VulnerableQuestion;

/**
 * Servicio para la gestión del banco de preguntas de vulnerabilidad.
 * Estas preguntas son la base para el diagnóstico de los Planes Familiares.
 */
class VulnerableQuestionService
{
    /**
     * Obtiene el listado completo de preguntas (histórico total).
     */
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

    /**
     * Obtiene una pregunta específica por su ID.
     */
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

    /**
     * Crea una nueva pregunta para el diagnóstico.
     */
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

    /**
     * Actualización total de la pregunta.
     */
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

    /**
     * Actualización parcial (ej. corregir un error tipográfico).
     */
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

    /**
     * Activa o desactiva una pregunta.
     * Útil para retirar preguntas sin borrarlas físicamente y perder el histórico.
     */
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

    /**
     * Elimina una pregunta.
     */
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

    /**
     * Obtiene preguntas activas de forma paginada para la interfaz del voluntario.
     * Ideal para mostrar el cuestionario paso a paso (ej. 3 preguntas por pantalla).
     */
    public function paginate()
    {
        $paginator = VulnerableQuestion::where('is_active', true)->paginate(3);

        $items = $paginator->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'description' => $item->description,
                'question_caution' => $item->question_caution,
            ];
        });

        return [
            "error"   => false,
            "code"    => 200,
            "message" => $items->isEmpty()
                ? "No hay preguntas vulnerables activas disponibles"
                : "Preguntas vulnerables obtenidas exitosamente",
            "data"    => $items,
            'paginate' => [
                'current_page' => $paginator->currentPage(), //pagina actual
                'per_page' => $paginator->perPage(),    //cuantos registros se muestran por pagina
                'total' => $paginator->total(), //total de registros
                'last_page' => $paginator->lastPage(), //ultima pagina
                'from' => $paginator->firstItem(), //numero del primer registro de la pagina
                'to' => $paginator->lastItem(), //numero del ultimo registro de la pagina
            ],
        ];
    }
}