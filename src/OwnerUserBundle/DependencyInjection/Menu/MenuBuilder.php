<?php

namespace OwnerUserBundle\DependencyInjection\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class MenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

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
        $menu = $this->factory->createItem('NavBar');

        $menu->setChildrenAttribute('class', 'nav navbar-top-links navbar-right');

        return $menu;
    }

    public function createSidebarMenu(array $options)
    {
        $menu = $this->factory->createItem('Admin');

        $menu->setChildrenAttribute('class', 'nav');
        $menu->setChildrenAttribute('id', 'side-menu');

        $menu->addChild('Dashboard', ['route' => 'owner_dashboard']);
        $menu->addChild('Campaigns', ['route' => 'owner_campaign_index']);
        $menu->addChild('Offers', ['route' => 'owner_offer_index']);
        $menu->addChild('Locations', ['route' => 'owner_location_index']);
        $menu->addChild('Payment and Invoice', ['route' => 'owner_invoice_index']);
        $menu->addChild('Validation Users', ['route' => 'owner_validatoruser_index']);

        return $menu;
    }    
}
