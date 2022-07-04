<?php

namespace App\Controller;


use DateTime;
use DateTimeInterface;
use App\Form\UploadType;
use App\Entity\Tblclient;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Mime\Email;
use App\Entity\Tbltranscriptionupload;
use App\Repository\TblclientRepository;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\TbltranscriptionuploadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(TblclientRepository $tblclientRepository, MailerInterface $mailer)
    {
        /** @var User $user */
        $user = $this->getUser();

        $userId = $user->getClientId();
        //dd($userId);




        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'clients' => $tblclientRepository->find($userId),
        ]);
    }

    #[Route("/home/ajout", name: "app_upload_ajout")]
    public function AjoutUpload(Request $request, TbltranscriptionuploadRepository $tbltranscriptionupload, MailerInterface $mailer)
    {

        //dd($_FILES);
        //dd($request);

        if (isset($request->request)) {
            //var_dump($request->request->get('myFiles')[0]);

            //dd(json_decode($request));

            //dd(json_decode(stripslashes($request->request)));
            $arr = $request->request->get('myFiles');
            foreach ($arr as $mefiles) {
                $entityManager = $this->getDoctrine()->getManager();
                $upload = new Tbltranscriptionupload;

                //var_dump(json_decode($mefiles)->totranscript);
                $filename = json_decode($mefiles)->name;
                $details = json_decode($mefiles)->details;
                //var_dump($details);
                $deadline = json_decode($mefiles)->deadline;
                $deadlin = json_decode($mefiles)->deadline;
                $deadline = new \DateTime($deadlin);

                $type = json_decode($mefiles)->type;
                if (str_starts_with($type, "audio") || str_starts_with($type, "video")) {
                    $duree = json_decode($mefiles)->duration;
                }
                // else {
                //     $duree = null;
                // }
                $totranscript = json_decode($mefiles)->totranscript;
                $taille = json_decode($mefiles)->taille;
                $filefichier = json_decode($mefiles)->fichier;


                $upload->setItmTitreLg1(uniqid() . 'pref' . htmlentities($filename));
                if ($details !== '') {
                    $upload->setItmTxtClientLg1(htmlentities($details));
                }
                $upload->setItmType(htmlentities(pathinfo($filename, PATHINFO_EXTENSION)));
                $upload->setItmDate(new DateTime());
                $upload->setItmTaille(htmlentities($taille));
                if (str_starts_with($type, "audio") || str_starts_with($type, "video")) {
                    $upload->setItmDuree(htmlentities($duree));
                }
                //$upload->setItmATranscrire($totranscript);
                if ($totranscript === 'true') {
                    $upload->setItmATranscrire(1);
                } else {
                    $upload->setItmATranscrire(0);
                }
                $upload->setItmDeadlineRequise($deadline);
                $upload->setTblclient($this->getUser());
                $upload->setItmFichier(htmlentities($filefichier));

                $em = $this->getDoctrine()->getManager();
                $em->persist($upload);
                $em->flush();



                //envoie mail liste des fichiers

            }
            //dd($this->getUser()->getClientId());

            $today = new DateTime();
            $today = $today->format('Y-m-d');
            //dd($today);
            $myFiles = $tbltranscriptionupload->findFilesSentToday($this->getUser()->getClientId(), $today);
            $array = $request->request->get('myFiles');
            $devisArr = [];
            foreach ($array as $item) {
                //var_dump(json_decode($item));
                $decoded = json_decode($item);
                array_push($devisArr, $decoded);
            }
            //var_dump($devisArr);

            $email = (new TemplatedEmail())
                ->from("test@test.fr")
                ->to("test@test.fr")
                ->subject("fichier envoyer de la part de ")
                ->htmlTemplate('email/file_transfered.html.twig')

                ->context([
                    'user' => $this->getUser(),
                    'files' => $myFiles,
                    'devis' => $devisArr,

                ]);
            $mailer->send($email);
            //dd($arr);
        }


        return $this->redirectToRoute('app_home');
    }

    #[Route('/uploadtoserver', name: 'app_upload')]
    public function uploadtoserver()
    {

        // 5 minutes execution time
        @set_time_limit(5 * 60);
        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings

        $targetDir =  "uploads";
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
