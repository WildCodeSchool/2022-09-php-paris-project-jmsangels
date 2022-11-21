<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\NotionManager;

class SubjectController extends AbstractController
{
    private SubjectManager $subjectManager;

    public function __construct()
    {
        $this->subjectManager = new SubjectManager();
        parent::__construct();
    }

    public function show(string $subjectId): string
    {
        if (!is_numeric($subjectId) || $subjectId == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
             header("HTTP/1.0 404 Not Found");
        }

        $themeId = $_SESSION['theme_id'];
        $themeName = $_SESSION['theme_name'];

        $subjects = $this->subjectManager->selectAllByThemeId((int)$themeId);

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
