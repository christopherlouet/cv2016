<?php

namespace AppBundle\Controller;

use AppBundle\Manager\CVManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController.
 * @package AppBundle\Controller
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $twig = 'index.html.twig';
        $paramTwig = $this->getParamTwig(false);

        return $this->render ( $twig, $paramTwig );
    }

    /**
     * @Route("/pdf", name="index_pdf")
     */
    public function indexPdfAction()
    {
        $twig = 'index_pdf.html.twig';
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
     * @Route("/pdf_html", name="index_pdf_html")
     */
    public function indexPdfHtmlAction()
    {
        $twig = 'index_pdf.html.twig';
        $paramTwig = $this->getParamTwig(true);

        return $this->render ( $twig, $paramTwig );
    }

    /**
     * @param $pdf
     * @return array
     */
    private function getParamTwig($pdf)
    {
        /** @var CVManager $manager */
        $manager = $this->get('app.manager');
        $prefix = $this->getPrefix($pdf);

        $paramTwig = array (
            'profil' => $manager->getProfil(),
            'domaines' => $manager->getDomaines(),
            'experiences' => $manager->getExperiences(),
            'formations' => $manager->getFormations(),
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
                if ($pdf)
                    $prefix = $scheme . '://172.17.0.1';
                break;
            case 'prod':
                if ($pdf)
                    $prefix = $scheme . '\'://\'' . $host;
                break;
            default:
                $prefix = null;
        }

        return $prefix;
    }
}
