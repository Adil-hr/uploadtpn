<?php

namespace App\Controller;

use DateTime;
use App\Form\UploadType;
use App\Entity\Tbltranscriptionupload;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjoutuploadController extends AbstractController
{
    #[Route('/ajout', name: 'app_ajoutupload')]
    public function index(Request $request): Response
    {
        echo $fileName;
        $upload = new Tbltranscriptionupload;
        $form = $this->createForm(UploadType::class, $upload, ['attr' => ['id' => 'form']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($_REQUEST);
            dump($this->getUser());
            dump(pathinfo($form['itmTitreLg1']->getData(), PATHINFO_EXTENSION));
            dump($form['itmDate']->getData());
            dump($upload);
            $dtnow = new DateTime();
            echo $dtnow->format('Y-m-d H: i: s');
            $upload->setItmTitreLg1($form['itmTitreLg1']->getData());
            $upload->setItmType(pathinfo($form['itmTitreLg1']->getData(), PATHINFO_EXTENSION));
            $upload->setItmDate(new DateTime());
            // $upload->setItmTaille();
            // $upload->setItmDuree();
            // $upload->setItmATranscrire($form['itmATranscrire']->getData());
            // $upload->setItmDeadlineRequise();
            // $upload->setTblclient($this->getUser());
            // $upload->setItmFichier();

            // $em = $this->getDoctrine()->getManager();
            // $em->persist($upload);
            // $em->flush();


            //return $this->redirectToRoute('app_upload');
        }

        return $this->render('ajoutupload/index.html.twig', [
            'controller_name' => 'AjoutuploadController',
            'form' => $form->createView(),

        ]);
    }
}
