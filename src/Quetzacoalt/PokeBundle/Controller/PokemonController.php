<?php

namespace Quetzacoalt\PokeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PokemonController extends Controller
{
    public function indexAction($type)
    {
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
        return $this->render(
            'QuetzacoaltPokeBundle:Default:list.html.twig',
            array(
                'type' => $type,
                'entities' => $entities,
                'downloadLink' => $this->generateUrl('poke_dl_pokemon', array('type' => $type)),
            )
        );
    }
    
    public function downloadAction($type)
    {
        $entityRepository = $this->get('poke.repository.'.$type);
        $response = new Response($entityRepository->findAll());
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename=filename.csv');
        return $response;
    }
}
