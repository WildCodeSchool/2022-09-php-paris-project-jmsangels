<?php

namespace App\Controller;

use App\Model\ThemeManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $theme = new ThemeManager();
        return $this->twig->render(
            'Home/index.html.twig',
            [
                'headerTitle' => 'KNOWLEDGE',
                'themes' => $theme->selectAll()
            ]
        );
    }
}
