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
        $themeManager = new ThemeManager();
        $thems = $themeManager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['thems' => $thems]);
    }
}
