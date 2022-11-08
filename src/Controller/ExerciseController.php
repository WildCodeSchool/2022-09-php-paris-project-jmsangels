<?php

namespace App\Controller;

class ExerciseController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(int $notion_id): string
    {
        return $this->twig->render(
            'Exercise/index.html.twig',
            []
        );
    }
}
