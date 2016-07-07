<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\Router;

/**
 * @author Christopher LOUËT.
 *
 */
class MenuBuilder
{
    protected $factory;
    protected $router;

	/**
	 * @param FactoryInterface $factory
	 * @param Router $router
	 */
    public function __construct(FactoryInterface $factory, Router $router)
    {
        $this->factory = $factory;
        $this->router = $router;
    }

    /**
     * Menu accueil.
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createHomeMenu()
    {
    	$menu = $this->factory->createItem('root');
    	
    	# profile
    	$menu->addChild('profile')
    	->setLabel('menu.profile')
    	->setUri($this->getUrl('index').'#profil');
    	
    	# experience
    	$menu->addChild('experience')
	    	->setLabel('menu.experience')
	    	->setUri($this->getUrl('index').'#experience');

	    # expertise
    	$menu->addChild('expertise')
	    	->setLabel('menu.expertise')
	    	->setUri($this->getUrl('index').'#competence');

		# education
		$menu->addChild('education')
			->setLabel('menu.education')
			->setUri($this->getUrl('index').'#formation');
    	
    	return $menu;
    }

    /**
     * Génerer l'URL à partir de la route.
     * 
     * @param string $route
     * @return string
     */
    private function getUrl($route)
    {
    	return $this->router->generate($route);
    }
    
}