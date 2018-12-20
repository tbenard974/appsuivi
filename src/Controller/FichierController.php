<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fichier;
use ZipArchive;
use Psr\Log\LoggerInterface;

class FichierController extends Controller
{

	/**
     * @Route("/download/image/{nomImage}", name="downloadOneImage")
     */
    public function download(Request $request, $nomImage)
    {
        $imagePath = $this->getParameter('uploaded_files_directory').'/'.$nomImage;

        return $this->file($imagePath);
    }

    /**
     * @Route("/download/allimage/{idPerformance}", name="downloadAllImage")
     */
    public function downloadAll(Request $request, $idPerformance, LoggerInterface $logger)
    {
        $appPath = $this->container->getParameter('kernel.root_dir');
        $zipPath = realpath($appPath.'/../public/zip');
        $photoPath = realpath($appPath . '/../public/uploads/photos');
        $allFiles = $this->getDoctrine()->getRepository(Fichier::class)->findByFicFkperformance($idPerformance);

        $zip = new ZipArchive();
        $nomZip = $zipPath.'/'.md5(uniqid()).'.zip';
        if ($zip->open($nomZip, ZipArchive::CREATE) === TRUE) {
            foreach($allFiles as $file)
            {
                $nomPhoto = $photoPath.'/'.$file->getFicChemin();
                if (!$zip->addFile($nomPhoto, $file->getFicChemin())){
                    $logger->info("Ajout de fichier impossible : ".$nomPhoto);
                }
                $logger->info('ok');
            }

            $logger->info('Nombre de fichiers : ' . $zip->numFiles . "\n");
            $logger->info("Statut :" . $zip->status . "\n");
            $zip->close();
            $logger->info('ok');
        } else {
            $logger->info('failed');
        }

        return $this->file($nomZip);
    }
}