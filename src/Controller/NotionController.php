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
    public function index(string $notion_id): string
    {

        return $this->twig->render(
            'Theme/index.html.twig',
            $this->renderNotionOutput('notion', (int)$notion_id)
        );
    }
}
