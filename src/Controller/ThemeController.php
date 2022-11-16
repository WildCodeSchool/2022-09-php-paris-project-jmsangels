<?php

namespace App\Controller;

use App\Model\SubjectManager;
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

    public function show(string $themeId): string
    {

        if (is_numeric($themeId) == null) {
            header("Location: /");
        }


        $themeManager = new ThemeManager();
<<<<<<< HEAD
        $theme = $themeManager->selectOneById((int) $themeId);
        $name = $theme['name'];

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int) $themeId);
=======
        $theme = $themeManager->selectOneById((int)$themeId);
        $name = $theme['name'];

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int)$themeId);
>>>>>>> c3376e7230aa0c46ff97039daff0cbe8554fa1bf

        return $this->twig->render(
            'Notion/index.html.twig',
            [
                'headerTitle' => $name,
                'subjects' => $subjects
            ]
        );
    }
}
