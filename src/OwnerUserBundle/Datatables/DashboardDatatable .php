<?php

namespace OwnerUserBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class DashboardDatatable
 *
 * @package OwnerUserBundle\Datatables
 */
class DashboardDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable($locale = null)
    {
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('owner_offer_new'),
                    'label' => $this->translator->trans('datatables.actions.new'),
                    'icon' => 'glyphicon glyphicon-plus',
                    //'role' => 'ROLE_USER',
                    'attributes' => array(
                        'rel' => 'tooltip',
                        'title' => $this->translator->trans('datatables.actions.new'),
                        'class' => 'btn btn-primary',
                        'role' => 'button'
                    ),
                )
            )
        ));

        $this->features->set(array(
            'auto_width' => true,
            'defer_render' => false,
            'info' => true,
            'jquery_ui' => false,
            'length_change' => true,
            'ordering' => true,
            'paging' => true,
            'processing' => true,
            'scroll_x' => false,
            'scroll_y' => '',
            'searching' => true,
            'server_side' => true,
            'state_save' => false,
            'delay' => 0,
            'extensions' => array()
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('owner_offer_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => 'lfrtip',
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => false,
            'individual_filtering_position' => 'foot',
            'use_integration_options' => true,
            'force_dom' => false
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
            ))
            ->add('imagePath', 'column', array(
                'title' => 'ImagePath',
            ))
            ->add('prepay', 'boolean', array(
                'title' => 'Prepay',
            ))
            ->add('payOnValidate', 'boolean', array(
                'title' => 'PayOnValidate',
            ))
            ->add('fixedAmount', 'column', array(
                'title' => 'FixedAmount',
            ))
            ->add('percentage', 'column', array(
                'title' => 'Percentage',
            ))
            ->add('redeemarsForValidation', 'column', array(
                'title' => 'RedeemarsForValidation',
            ))
            ->add('redeemarPrice', 'column', array(
                'title' => 'RedeemarPrice',
            ))
            ->add('redeemarsUsed', 'column', array(
                'title' => 'RedeemarsUsed',
            ))
            ->add('active', 'boolean', array(
                'title' => 'Active',
            ))
            ->add('startDate', 'datetime', array(
                'title' => 'StartDate',
            ))
            ->add('endDate', 'datetime', array(
                'title' => 'EndDate',
            ))
            ->add('highlighted', 'boolean', array(
                'title' => 'Highlighted',
            ))
            ->add('rating', 'column', array(
                'title' => 'Rating',
            ))
            ->add('campaign.id', 'column', array(
                'title' => 'Campaign Id',
            ))
            ->add('campaign.name', 'column', array(
                'title' => 'Campaign Name',
            ))
            ->add('campaign.startDate', 'column', array(
                'title' => 'Campaign StartDate',
            ))
            ->add('campaign.endDate', 'column', array(
                'title' => 'Campaign EndDate',
            ))
            ->add('campaign.active', 'column', array(
                'title' => 'Campaign Active',
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'owner_offer_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.show'),
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'owner_offer_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Redeemar\Entity\Offer';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'owner_dashboard_datatable';
    }
}
