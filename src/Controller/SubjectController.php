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

        $theme_id = $subjectsObj->getThemeId((int)$subject_id);
        $subjects = $subjectsObj->selectAll($theme_id);
        $notions = $notionsObj->selectAll($subject_id);

        if (!empty($notions)) {
            $notion = $notions[0];
        }

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => $themeObj->getThemeName((int)$theme_id),
                'subjects' => $subjects,
                'notions' => $notions,
                'notion' => $notion,
                'subjectid' => $subject_id
            ]
        );
    }
}
