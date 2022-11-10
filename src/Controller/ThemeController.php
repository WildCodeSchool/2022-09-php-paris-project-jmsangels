<?php

namespace App\Controller;

use App\Model\ThemeManager;

class ThemeController extends AbstractController
{
    public const HEADERTITLE = 'KNOWLEDGE';
    /**
     * Display home page
     */
    public function index(): string
    {
        $themeManager = new ThemeManager();
        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => self::HEADERTITLE,
                'themes' => $themeManager->selectAll()
            ]
        );
    }
}
