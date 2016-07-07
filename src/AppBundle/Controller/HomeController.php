<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Domaine;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Profil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $twig = 'home/index.html.twig';
        $paramTwig = $this->getParamTwig(false);


        return $this->render ( $twig, $paramTwig );
    }

    /**
     * @Route("/pdf", name="index_pdf")
     */
    public function indexPdfAction()
    {
        $twig = 'home/index.html.twig';
        $paramTwig = $this->getParamTwig(true);

        $html = $this->renderView($twig, $paramTwig);
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="cv.pdf"'
            )
        );
    }

    /**
     * @param $pdf
     * @return array
     */
    private function getParamTwig($pdf)
    {
        $em = $this->getDoctrine()->getManager();

        $profil = current($em->getRepository(Profil::class)->findAll());
        $domaines = $em->getRepository(Domaine::class)->findAll();
        $experiences = $em->getRepository(Experience::class)->findAll();
        $formations = $em->getRepository(Formation::class)->findAll();
        $prefix = $this->getPrefix($pdf);

        $paramTwig = array (
            'profil' => $profil,
            'domaines' => $domaines,
            'experiences' => $experiences,
            'formations' => $formations,
            'pdf' => $pdf,
            'prefix' => $prefix,
        );

        return $paramTwig;
    }

    /**
     * Pour wkhtmltopdf.
     * 
     * @param $pdf
     * @return null|string
     */
    private function getPrefix($pdf)
    {
        $prefix = null;
        $environment = $this->get('kernel')->getEnvironment();
        $scheme = $this->get('router.request_context')->getScheme();
        $host = $this->get('router.request_context')->getHost();

        switch ($environment)
        {
            case 'dev':
                if ($pdf) {
                    $prefix = $scheme . '://172.17.0.1';
                }
                break;
            case 'prod':
                if ($pdf) {
                    $prefix = $scheme . '\'://\'' . $host;
                }
                break;
            default:
                $prefix = null;
        }

        return $prefix;
    }
}
