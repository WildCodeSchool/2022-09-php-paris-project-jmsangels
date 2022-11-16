<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\NotionManager;

class NotionController extends AbstractController
{
    public function show(string $notionId): string
    {
        if (is_numeric($notionId) == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            return "Session undefined";
        }

        $themeId = $_SESSION['theme_id'];
        $themeName = $_SESSION['theme_name'];

        $notionManager = new NotionManager();
        $notion = $notionManager->selectOneById((int)$notionId);
        $subjectId = $notion ['subject_id'];
        $notions = $notionManager->selectAllBySubjectId((int)$subjectId);

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int)$themeId);

        return $this->twig->render(
            'Notion/index.html.twig',
            [
                'headerTitle' => $themeName,
                'subjects' => $subjects,
                'notions' => $notions,
                'subjectId' => $subjectId,
                'notion' => $notion
            ]
        );
    }
}
