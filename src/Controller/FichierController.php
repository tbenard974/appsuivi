<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FichierController extends Controller
{
	/**
     * @Route("/download/image/{nomImage}", name="downloadImage")
     */
    public function download(Request $request, $nomImage)
    {
        $imagePath = $this->getParameter('uploaded_files_directory').'/'.$nomImage;

        return $this->file($imagePath);
    }
}