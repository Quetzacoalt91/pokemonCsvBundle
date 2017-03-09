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
        /*$categoryLoader = $this->get('poke.loader.category');
        $categoryManager = $this->get('poke.updater.category');
        
        // Get from API and load in datbase
        $categoryManager->addFromSources($categoryLoader->load());
        $categoryRepository = $this->get('poke.repository.category');
        
        // Dump to check
        $categories = $categoryRepository->findAll();
        dump($categories);
        dump($this->get('translator')->trans('flying', array(), 'pokemon'));*/
        
        $productLoader = $this->get('poke.loader.product');
        $productManager = $this->get('poke.updater.product');
        
        // Get from API and load in datbase
        $productManager->addFromSources($productLoader->load());
        $productRepository = $this->get('poke.repository.category');
        
        // Dump to check
        $pokemons = $productRepository->findAll();
        dump($pokemons);
        
        // CSV export of categories
        $writer = $this->get('poke.csv.writer');
        //$writer->export($categories);
        $writer->export($pokemons);
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
