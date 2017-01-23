<?php

namespace Quetzacoalt\PokeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PokemonController extends Controller
{
    public function indexAction()
    {
        /**
         * @var \Quetzacoalt\PokeBundle\Api\PokemonTypesLoader
         */
        $categoryLoader = $this->get('poke.category.loader');
        $categoryManager = $this->get('poke.updater.category');
        $categoryManager->addFromSources($categoryLoader->load());
        $categoryRepository = $this->get('poke.repository.category');
        dump($categoryRepository->findAll());
        dump($this->get('translator')->trans('flying', array(), 'pokemon'));
        dump($this->get('poke.api.image.bing')->search('doge'));
        return $this->render('QuetzacoaltPokeBundle:Default:index.html.twig');
    }
    
    public function downloadAction()
    {
        $categoryRepository = $this->get('poke.repository.category');
        $response = new Response($categoryRepository->findAll());
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename=filename.csv');
        return $response;
    }
    
    public function updateAction()
    {
        return $this->redirectToRoute('poke_see_pokemon');
    }
}
