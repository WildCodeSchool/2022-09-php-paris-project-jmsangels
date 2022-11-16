<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\NotionManager;

class SubjectController extends AbstractController
{
    public function show(string $subjectId): string
    {
        if (is_numeric($subjectId) == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            return "Session undefined";
        }

        $themeId = $_SESSION['theme_id'];
        $themeName = $_SESSION['theme_name'];

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int)$themeId);

        $notionManager = new NotionManager();
        $notions = $notionManager->selectAllBySubjectId((int)$subjectId);

        return $this->twig->render(
            'Notion/index.html.twig',
            [
                'headerTitle' => $themeName,
                'subjects' => $subjects,
                'notions' => $notions,
                'subjectId' => $subjectId
            ]
        );
    }
}
