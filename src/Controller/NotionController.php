<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;
use App\Model\NotionManager;

class NotionController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(string $theme_id, string $subject_id, string $notion_id): string
    {
        $theme = new ThemeManager();

        $subjects = new SubjectManager();

        $notions = new NotionManager();

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headertitle' => $theme->getThemeName((int)$theme_id),
                'subjects' => $subjects->selectAll((int)$theme_id),
                'notions' => $notions->selectAll((int)$subject_id),
                'notion' => $notions->select((int)$notion_id),
                'idtheme' => $theme_id,
                'idsubject' => $subject_id
            ]
        );
    }
}
