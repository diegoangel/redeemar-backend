<?php

namespace SystemUserBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class InvoiceDatatable
 *
 * @package SystemUserBundle\Datatables
 */
class InvoiceDatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('system_invoice_new'),
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
            'url' => $this->router->generate('system_invoice_results'),
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
            ->add('referenceNumber', 'column', array(
                'title' => 'ReferenceNumber',
            ))
            ->add('invoiceDate', 'datetime', array(
                'title' => 'InvoiceDate',
            ))
            ->add('statusId', 'column', array(
                'title' => 'StatusId',
            ))
            ->add('totalAmount', 'column', array(
                'title' => 'TotalAmount',
            ))
            ->add('user.id', 'column', array(
                'title' => 'User Id',
            ))
            ->add('user.name', 'column', array(
                'title' => 'User Name',
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'system_invoice_show',
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
                        'route' => 'system_invoice_edit',
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
        return 'Redeemar\Entity\Invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'system_invoice_datatable';
    }
}
