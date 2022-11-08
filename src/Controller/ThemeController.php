<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\ThemeManager;
use App\Model\NotionManager;

class ThemeController extends AbstractController
{
    /**
     * Display Subject List, Notion List & select first element
     */
    public function index(int $theme_id): string
    {
        // if (!is_numeric($theme_id)) return ("Lost!");

        $themeObj = new ThemeManager();
        $subjectsObj = new SubjectManager();
        $notionsObj = new NotionManager();

        $subject_id = 0;
        $notion = $notions = $subjects = [];

        $subjects = $subjectsObj->selectAllByThemeId($theme_id);

        if (!empty($subjects)) {
            $subject_id = (int)$subjects[0]['id'];
            $notions = $notionsObj->selectAllBySubjectId($subject_id);
        }
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
