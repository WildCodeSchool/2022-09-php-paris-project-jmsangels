<?php

namespace App\Controller;

use App\Model\ThemeManager;

class HomeController extends AbstractController
{
    private ThemeManager $themeManager;

    public const HEADERTITLE = 'KNOWLEDGE';
    /**
     * Display home page
     */
    public function __construct()
    {
        $this->themeManager = new ThemeManager();
        parent::__construct();
    }

    public function index(): string
    {
        return $this->twig->render(
            'Home/index.html.twig',
            [
                'headerTitle' => self::HEADERTITLE,
                'themes' => $this->themeManager->selectAll()
            ]
        );
    }
}
