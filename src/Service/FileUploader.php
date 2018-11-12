<?php
// src/Service/FileUploader.php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Fichier;
use App\Entity\Utilisateur;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file, Utilisateur $utilisateur)
    {
        $fichier = new Fichier();
        $fichier->setFicFkutilisateur($utilisateur);
        $fichier->setUpdateFields($utilisateur->getUtiNom());
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        $fichier->setFicChemin($fileName);
        return $fichier;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}