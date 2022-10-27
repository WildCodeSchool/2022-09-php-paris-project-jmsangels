<?php

namespace App\Controller;

use App\Model\SubjectManager;

class SubjectController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(int $id): string
    {
        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAll($id);

        return $this->twig->render('Subject/index.html.twig', ['subjects' => $subjects]);
    }
}
