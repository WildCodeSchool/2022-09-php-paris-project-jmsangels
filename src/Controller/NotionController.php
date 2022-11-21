<?php

namespace App\Controller;

use App\Model\SubjectManager;
use App\Model\NotionManager;

class NotionController extends AbstractController
{
    public function show(string $notionId): string
    {
        if (is_numeric($notionId) == null) {
            header("Location: /");
        }

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            return "Session undefined";
        }

        $themeId = $_SESSION['theme_id'];
        $themeName = $_SESSION['theme_name'];

        $notionManager = new NotionManager();
        $notion = $notionManager->selectOneById((int)$notionId);
        $subjectId = $notion['subject_id'];
        $notions = $notionManager->selectAllBySubjectId((int)$subjectId);

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAllByThemeId((int)$themeId);

        return $this->twig->render(
            'Notion/index.html.twig',
            [
                'headerTitle' => $themeName,
                'subjects' => $subjects,
                'notions' => $notions,
                'subjectId' => $subjectId,
                'notion' => $notion
            ]
        );
    }

    public function add(int $subjectId): string
    {
        if (!is_numeric((int)$subjectId)) {
            header("Location: /");
        }

        $errors = [];

        if (!isset($_SESSION['theme_id']) || (!isset($_SESSION['theme_name']))) {
            return "Session undefined";
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

                $notionManager = new NotionManager();
                $notionManager->add($notion);
                header("Location: /subject/show?id=" . $subjectId);
                return "";
            }
        }

        return $this->twig->render(
            'Notion/add.html.twig',
            [
                'subjectId' => $subjectId,
                'errors' => $errors
            ]
        );
    }
}
