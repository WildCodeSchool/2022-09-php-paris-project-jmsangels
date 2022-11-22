<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;

class SubjectController extends AbstractController
{
    private SubjectManager $subjectManager;

    public function __construct()
    {
        $this->subjectManager = new SubjectManager();
        parent::__construct();
    }

    public function list(string $themeId): string
    {
        if (!is_numeric($themeId) || $themeId == null) {
            header("Location: /");
        }

        $themeManager = new ThemeManager();
        $themeName = $themeManager->selectOneById((int)$themeId)['name'];

        $_SESSION['theme_id'] = $themeId;
        $_SESSION['theme_name'] = $themeName;

        $subjects = $this->subjectManager->selectAllByThemeId((int)$themeId);

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => $themeName,
                'subjects' => $subjects,
            ]
        );
    }
}
