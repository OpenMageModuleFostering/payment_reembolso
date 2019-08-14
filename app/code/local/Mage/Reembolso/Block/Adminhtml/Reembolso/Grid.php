<?php

class Mage_Reembolso_Block_Adminhtml_Reembolso_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
	  parent::__construct();
	  $this->setId('reembolsoGrid');
	  $this->setDefaultSort('reembolso_id');
	  $this->setDefaultDir('ASC');
	  $this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
	  $collection = Mage::getModel('reembolso/adminhtml_reembolso')->getCollection()->prepareSummary();
	  $this->setCollection($collection);
	  return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('reembolso_id', array(
		  'header'    => Mage::helper('reembolso')->__('ID'),
		  'align'     =>'right',
		  'width'     => '50px',
		  'index'     => 'reembolso_id',
		));
		
		$this->addColumn('title', array(
		  'header'    => Mage::helper('reembolso')->__('Title'),
		  'align'     =>'left',
		  'index'     => 'title',
		));
		
		$this->addColumn('descript', array(
		  'header'    => Mage::helper('reembolso')->__('Description'),
		  'align'     =>'left',
		  'index'     => 'descript',
		));
		
		$this->addColumn('above', array(
		  'header'    => Mage::helper('reembolso')->__('Above'),
		  'align'     =>'left',
		  'width'     => '100px',
		  'index'     => 'above',
		));

		$this->addColumn('shipping_method', array(
		  'header'    => Mage::helper('reembolso')->__('Shipping Method'),
		  'align'     => 'left',
		  'width'     => '150px',
		  'index'     => 'shipping_method',
		  'type'      => 'options',
		  'options'   => Mage::getResourceModel('reembolso/reembolso_collection')->getShippingMethods(),
		));
		
		$this->addColumn('type', array(
		  'header'    => Mage::helper('reembolso')->__('Type'),
		  'align'     => 'left',
		  'width'     => '100px',
		  'index'     => 'type',
		  'type'      => 'options',
		  'options'   => array(
			  1 => 'Fixed',
			  2 => 'Percent',
		  ),
		));
		
		$this->addColumn('value', array(
		  'header'    => Mage::helper('reembolso')->__('Value'),
		  'align'     =>'left',
		  'width'     => '100px',
		  'index'     => 'value',
		  'type'      => 'number',
		));
	  
		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('reembolso')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getReembolsoId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('reembolso')->__('Edit'),
						'url'       => array('base'=> '*/*/edit'),
						'field'     => 'i'
					)
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('reembolso')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('reembolso')->__('XML'));
	  
		return parent::_prepareColumns();
	}

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('reembolso_id');
        $this->getMassactionBlock()->setFormFieldName('reembolso');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('reembolso')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('reembolso')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('reembolso/adminhtml_status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('reembolso')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('reembolso')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getReembolsoId()));
	}

}