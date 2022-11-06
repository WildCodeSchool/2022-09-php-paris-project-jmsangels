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

        $subjects = $subjectsObj->selectAll($theme_id);

        if (!empty($subjects)) {
            $subject_id = (int)$subjects[0]['id'];
            $notions = $notionsObj->selectAll($subject_id);
        }
        if (!empty($notions)) {
            // $idnotion = $notions[0]['id'];
            $notion = $notions[0];
        }

        // var_dump($subjects);
        // exit();

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headertitle' => $themeObj->getThemeName($theme_id),
                'subjects' => $subjects,
                'notions' => $notions,
                'notion' => $notion,
                'idsubject' => $subject_id
            ]
        );
    }
}
