<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;
use App\Model\NotionManager;

class SubjectController extends AbstractController
{
    /**
     * Display Subject List, Notion List & select active subject
     */
    public function index(string $subject_id): string
    {

        if (!is_numeric($subject_id)) return ("Lost!");

        return $this->twig->render(
            'Theme/index.html.twig',
            $this->renderNotionOutput('subject', (int)$subject_id)
        );
    }
}
