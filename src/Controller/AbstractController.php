<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

use App\Model\SubjectManager;
use App\Model\ThemeManager;
use App\Model\NotionManager;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }

    public function renderNotionOutput(string $idname, int $id): array
    {

        $themeObj = new ThemeManager();
        $subjectsObj = new SubjectManager();
        $notionsObj = new NotionManager();

        $idsubject = $idtheme = $idnotion = 0;
        $notion = $notions = $subjects = [];

        switch ($idname) {
            case 'theme':
                $idtheme = $id;

                $subjects = $subjectsObj->selectAll($idtheme);

                if (!empty($subjects)) {
                    $idsubject = $subjects[0]['id'];
                    $notions = $notionsObj->selectAll($idsubject);
                }
                if (!empty($notions)) {
                    $idnotion = $notions[0]['id'];
                    $notion = $notions[0];
                }
                break;
            case 'subject':
                $idsubject = $id;
                $idtheme = $subjectsObj->getThemeId($idsubject);
                $subjects = $subjectsObj->selectAll($idtheme);
                $notions = $notionsObj->selectAll($idsubject);
                if (!empty($notions)) {
                    $idnotion = $notions[0]['id'];
                    $notion = $notions[0];
                }
                break;
            case 'notion':
                $idnotion = $id;
                $idsubject = $notionsObj->getSubjectId($idnotion);
                if ($idsubject) {
                    $idtheme = $subjectsObj->getThemeId($idsubject);
                    $subjects = $subjectsObj->selectAll($idtheme);
                    $notions = $notionsObj->selectAll($idsubject);
                    $notion = $notions[$id - 1];
                }
                break;
        }

        // var_dump($subjects);
        // exit();

        return ([
            'headertitle' => $themeObj->getThemeName($idtheme),
            'subjects' => $subjects,
            'notions' => $notions,
            'notion' => $notion,
            'idsubject' => $idsubject
        ]
        );
    }
}
