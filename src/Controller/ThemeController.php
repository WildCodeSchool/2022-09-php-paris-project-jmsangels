<?php

namespace App\Controller;

use App\Model\ThemeManager;

class ThemeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $themeManager = new ThemeManager();
        return $this->twig->render(
            'Theme/theme.html.twig',
            [
                'headertitle' => 'KNOWLEDGE',
                'themes'=> $themeManager->selectAll()
            ]
        );
    }
}
    