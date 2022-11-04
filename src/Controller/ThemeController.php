<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;

class ThemeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index($theme_id): string
    {
        $theme = new ThemeManager();

        $subjects = new SubjectManager();

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headertitle' => $theme->getThemeName($theme_id),
                'subjects' => $subjects->selectAll($theme_id),
                'idtheme' => $theme_id
            ]
        );
    }
}
