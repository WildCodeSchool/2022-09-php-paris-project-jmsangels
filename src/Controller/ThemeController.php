<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;

class ThemeController extends AbstractController
{
    private $themeManager;
    public const HEADERTITLE = 'KNOWLEDGE';
    /**
     * Display home page
     */
    public function index(): string
    {

        $this->themeManager = new ThemeManager();

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => self::HEADERTITLE,
                'themes' => $this->themeManager->selectAll()
            ]
        );
    }

    public function show(string $themeId): string
    {

        if (is_numeric($themeId) == null) {
            header("Location: /");
        }


        $themeManager = new ThemeManager();
        $theme = $themeManager->selectOneById((int)$themeId);
    
        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int)$themeId);

        return $this->twig->render(
            'Notion/index.html.twig',
            [
                'headerTitle' => $theme['name'],
                'subjects' => $subjects
            ]
        );
    }
}
