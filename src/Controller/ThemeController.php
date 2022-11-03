<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;

// use App\Model\ThemeManager;

class ThemeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index($theme_id): string
    {
        $theme = new ThemeManager();

        $subject = new SubjectManager();

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headertitle' => $theme->getThemeName($theme_id),
                'subjects' => $subject->selectAll($theme_id)
            ]
        );
    }
}
