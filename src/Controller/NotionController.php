<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\NotionManager;

class NotionController extends AbstractController
{
    private NotionManager $notionManager;
    private SubjectManager $subjectManager;

    public function __construct()
    {
        $this->notionManager = new NotionManager();
        $this->subjectManager = new SubjectManager();
        parent::__construct();
    }

    public function list(string $subjectId): string
    {
        if (!is_numeric($subjectId) || $subjectId == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            header("Location: /");
        }

        $notions = $this->notionManager->selectAllBySubjectId((int)$subjectId);

        $subjects = $this->subjectManager->selectAllByThemeId((int)$_SESSION['theme_id']);

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => $_SESSION['theme_name'],
                'subjects' => $subjects,
                'notions' => $notions,
                'subjectSelected' => $subjectId
            ]
        );
    }
}
