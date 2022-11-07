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

        // if (!is_numeric($notion_id)) return ("Lost!");

        $themeObj = new ThemeManager();
        $subjectsObj = new SubjectManager();
        $notionsObj = new NotionManager();

        $subject_id = $theme_id  = 0;
        $notion = $notions = $subjects = [];

        $subject_id = $notionsObj->getSubjectId((int)$notion_id);
        if ($subject_id) {
            $theme_id = $subjectsObj->getThemeId((int)$subject_id);
            $subjects = $subjectsObj->selectAll((int)$theme_id);
            $notions = $notionsObj->selectAll((int)$subject_id);

            foreach ($notions as $notionItem) {
                if ($notionItem['id'] === $notion_id) {
                    $notion = $notionItem;
                    break;
                }
            }
        }

        // var_dump($subjects);
        // exit();
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
