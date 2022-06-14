<?php

namespace App\Controller;

use App\Form\UploadType;
use App\Entity\Tbltranscriptionupload;
use DateTime;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index()
    {

        // $upload = new Tbltranscriptionupload;
        // $form = $this->createForm(UploadType::class, $upload, ['attr' => ['id' => 'form']]);

        // $form->handleRequest($request);

        //     if ($form->isSubmitted() && $form->isValid()) {
        dump($_REQUEST);
        dump($_FILES);
        //         dump($this->getUser());
        //         dump(pathinfo($form['itmTitreLg1']->getData(), PATHINFO_EXTENSION));
        //         dump($form['itmDate']->getData());
        //         dump($upload);
        //         $dtnow = new DateTime();
        //         echo $dtnow->format('Y-m-d H: i: s');
        //         $upload->setItmTitreLg1($form['itmTitreLg1']->getData());
        //         $upload->setItmType(pathinfo($form['itmTitreLg1']->getData(), PATHINFO_EXTENSION));
        //         $upload->setItmDate(new DateTime());
        //         // $upload->setItmTaille();
        //         // $upload->setItmDuree();
        //         // $upload->setItmATranscrire($form['itmATranscrire']->getData());
        //         // $upload->setItmDeadlineRequise();
        //         // $upload->setTblclient($this->getUser());
        //         // $upload->setItmFichier();

        //         // $em = $this->getDoctrine()->getManager();
        //         // $em->persist($upload);
        //         // $em->flush();


        //         //return $this->redirectToRoute('app_upload');
        //     }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            // 'form' => $form->createView(),
        ]);
    }

    #[Route("home/ajout", name: "app_upload_ajout")]
    public function AjoutUpload(Request $request): Response
    {
        dump($_FILES);
        dump($_REQUEST);
        $upload = new Tbltranscriptionupload;
        $form = $this->createForm(UploadType::class, $upload, ['attr' => ['id' => 'form']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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


            return $this->redirectToRoute('app_upload');
        }
    }

    #[Route('/uploadtoserver', name: 'app_upload')]
    public function uploadtoserver()
    {
        dump($_FILES);
        dump($_REQUEST);
        // 5 minutes execution time
        @set_time_limit(5 * 60);
        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings

        $targetDir =  "uploads";
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        //echo $filePath . ' test filepath';
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


        // Remove old temp files	
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);
        }




        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }
}
