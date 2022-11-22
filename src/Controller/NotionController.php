<?php

namespace App\Controller;

use App\Model\ExerciseManager;
use App\Model\SubjectManager;
use App\Model\NotionManager;

class NotionController extends AbstractController
{
    private NotionManager $notionManager;
    private SubjectManager $subjectManager;

    public function __construct()
    {
        $this->notionManager = new NotionManager();
        $this->subjectManager = new SubjectManager();
        parent::__construct();
    }

    public function list(string $subjectId): string
    {
        if (!is_numeric($subjectId) || $subjectId == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            header("Location: /");
        }

        $notions = $this->notionManager->selectAllBySubjectId((int)$subjectId);
        $subjects = $this->subjectManager->selectAllByThemeId((int)$_SESSION['theme_id']);

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => $_SESSION['theme_name'],
                'subjects' => $subjects,
                'notions' => $notions,
                'idSubjectSelected' => $subjectId
            ]
        );
    }

    public function show(string $notionId): string
    {
        if (!is_numeric($notionId) || $notionId == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            header("Location: /");
        }

        $notion = $this->notionManager->selectOneById((int)$notionId);

        $notions = $this->notionManager->selectAllBySubjectId((int)$notion['subject_id']);
        $subjects = $this->subjectManager->selectAllByThemeId((int)$_SESSION['theme_id']);

        $exerciseManager = new ExerciseManager();
        $exercises = $exerciseManager->selectAllByNotion((int)$notionId);

        return $this->twig->render(
            'Theme/index.html.twig',
            [
                'headerTitle' => $_SESSION['theme_name'],
                'subjects' => $subjects,
                'notions' => $notions,
                'notion' => $notion,
                'exercises' => $exercises,
                'idSubjectSelected' => $notion['subject_id'],
                'idNotionSelected' => $notionId
            ]
        );
    }

    public function add(string $subjectId): string
    {
        if (!is_numeric((int)$subjectId)) {
            header("Location: /");
        }

        $errors = [];

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            header("Location: /");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $errors[] = "Champ name obligatoire";
            }

            if (empty($_POST["lesson"])) {
                $errors[] = "Champ lesson obligatoire";
            }

            if (empty($_POST["sample"])) {
                $errors[] = "Champ sample obligatoire";
            }

            $fileNameImg = "";

            if (isset($_FILES['filename']) && $_FILES['filename']['name'] != "") {
                $uploadDir = '../upload/';
                $fileNameImg = $uploadDir . basename($_FILES['filename']['name']);
                $extension = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
                $authorizedExtensions = ['jpg', 'jpeg', 'png'];
                $maxFileSize = 1000000;

                if ((!in_array($extension, $authorizedExtensions))) {
                    $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
                }

                if (
                    file_exists($_FILES['filename']['tmp_name']) &&
                    filesize($_FILES['filename']['tmp_name']) > $maxFileSize
                ) {
                    $errors[] = "Votre fichier doit faire moins de 1M !";
                }
            }

            if (empty($errors)) {
                date_default_timezone_set('Europe/Paris');
                $notion = [
                    "created_at" => date_create()->format('Y-m-d H:i:s'),
                    "subject_id" => $subjectId,
                    "name" => trim($_POST['name']),
                    "lesson" => trim($_POST['lesson']),
                    "sample" => trim($_POST['sample']),
                    "file_image" => $fileNameImg
                ];

                $this->notionManager->add($notion);
                header("Location: /notion/list?id_subject=" . $subjectId);
                return "";
            }
        }
        return $this->twig->render(
            'Notion/add.html.twig',
            [
                'headerTitle' => $_SESSION['theme_name'],
                'subjectId' => $subjectId,
                'errors' => $errors,
                'titleForm' => "Ajouter une nouvelle notion"
            ]
        );
    }
}
