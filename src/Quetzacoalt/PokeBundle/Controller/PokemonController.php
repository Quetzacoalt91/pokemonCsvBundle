<?php

namespace Quetzacoalt\PokeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonController extends Controller
{
    public function indexAction(Request $request)
    {
        $type = $request->query->get('type');

        /**
         * @var \Quetzacoalt\PokeBundle\Api\ApiLoaderInterface
         */
        $entityLoader = $this->get('poke.loader.'.$type);
        $entityManager = $this->get('poke.updater.'.$type);
        
        // Get from API and load in datbase
        $entityManager->addFromSources($entityLoader->load());
        $entityRepository = $this->get('poke.repository.'.$type);
        
        // Dump to check
        $entities = $entityRepository->findAll();
        // CSV export of categories
        $writer = $this->get('poke.csv.writer');
        $writer->export($entities);
        return $this->render('QuetzacoaltPokeBundle:Default:index.html.twig');
    }
    
    public function downloadAction()
    {
        $type = $request->query->get('type');
        $entityRepository = $this->get('poke.repository.'.$type);
        $response = new Response($entityRepository->findAll());
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename=filename.csv');
        return $response;
    }
}
