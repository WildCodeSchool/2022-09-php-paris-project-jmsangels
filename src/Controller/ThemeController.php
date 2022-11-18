<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;

class ThemeController extends AbstractController
{
    private ThemeManager $themeManager;

    public const HEADERTITLE = 'KNOWLEDGE';
    /**
     * Display home page
     */
    public function __construct()
    {
        $this->themeManager = new ThemeManager();
        parent::__construct();
    }

    public function index(): string
    {
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

        if (!is_numeric($themeId) || $themeId == null) {
            header("Location: /");
        }

        $themeManager = $this->themeManager;
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
