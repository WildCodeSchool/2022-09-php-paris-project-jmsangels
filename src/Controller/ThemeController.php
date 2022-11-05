<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;
use App\Model\NotionManager;

class ThemeController extends AbstractController
{
    /**
     * Display Subject List, Notion List & select first element
     */
    public function index(string $theme_id): string
    {
        return $this->twig->render(
            'Theme/index.html.twig',
            $this->renderNotionOutput('theme', (int)$theme_id)
        );
    }
}
