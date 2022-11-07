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
    public function index(int $notion_id): string
    {

        if ($notion_id < 1) return ("Lost!");

        $themeObj = new ThemeManager();
        $subjectsObj = new SubjectManager();
        $notionsObj = new NotionManager();

        $subject_id = $theme_id  = 0;
        $notion = $notions = $subjects = [];

        $notion = $notionsObj->selectOneById((int)$notion_id);

        if (!empty($notion)) {
            $subject_id = (int)$notion['subject_id'];
            $notions = $notionsObj->selectAllBySubjectId((int)$subject_id);

            $themes = $subjectsObj->selectOneById((int)$subject_id);

            if (!empty($themes)) {
                $theme_id = $themes['theme_id'];
                $subjects = $subjectsObj->selectAllByThemeId($theme_id);
            }
        }

        $theme = $themeObj->selectOneById($theme_id)['name'];

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headertitle' => $theme,
                'subjects' => $subjects,
                'notions' => $notions,
                'notion' => $notion,
                'idsubject' => $subject_id
            ]
        );
    }
}
