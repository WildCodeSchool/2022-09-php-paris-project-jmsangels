<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;
use App\Model\NotionManager;

class SubjectController extends AbstractController
{
    /**
     * Display Subject List, Notion List & select active subject
     */
    public function index(int $subject_id): string
    {
        if ($subject_id < 1) return ("Lost!");

        $themeObj = new ThemeManager();
        $subjectsObj = new SubjectManager();
        $notionsObj = new NotionManager();

        $theme_id  = 0;
        $notion = $notions = $subjects = [];

        $themes = $subjectsObj->selectOneById((int)$subject_id);
        if (!empty($themes)) {
            $theme_id = $themes['theme_id'];
        }

        $subjects = $subjectsObj->selectAllByThemeId($theme_id);
        $notions = $notionsObj->selectAllBySubjectId($subject_id);

        if (!empty($notions)) {
            $notion = $notions[0];
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
