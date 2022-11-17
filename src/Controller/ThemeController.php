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

        if (!is_numeric($themeId) || $themeId == null) {
            header("Location: /");
        }

        $_SESSION['theme_id'] = $themeId;

        $themeManager = new ThemeManager();
        $theme = $themeManager->selectOneById((int)$themeId);
        $themeName = $theme['name'];
        $_SESSION['theme_name'] = $themeName;

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int)$themeId);


        return $this->twig->render(
            'Notion/index.html.twig',
            [
                'headerTitle' => $themeName,
                'subjects' => $subjects
            ]
        );
    }
}
