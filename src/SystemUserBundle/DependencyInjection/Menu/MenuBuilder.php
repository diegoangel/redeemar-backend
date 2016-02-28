<?php

namespace SystemUserBundle\DependencyInjection\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Home', array('route' => 'redeemar_dashboard'));
        $menu->addChild('Dashboard', array('route' => 'redeemar_dashboard'));

        // ... add more children

        return $menu;
    }

    public function createSidebarMenu(array $options)
    {
        $menu = $this->factory->createItem('sidebar');

        if (isset($options['include_homepage']) && $options['include_homepage']) {
            $menu->addChild('Home', array('route' => 'redeemar_dashboard'));
        }

        // ... add more children

        return $menu;
    }    
}