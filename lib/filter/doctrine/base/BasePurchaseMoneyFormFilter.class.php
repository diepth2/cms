<?php

/**
 * PurchaseMoney filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePurchaseMoneyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'     => new sfWidgetFormFilterInput(),
      'provider'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cardserial'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cardpin'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'securitykey'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'senttime'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'receivedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cardvalue'    => new sfWidgetFormFilterInput(),
      'gamemoney'    => new sfWidgetFormFilterInput(),
      'tocash'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'userid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'     => new sfValidatorPass(array('required' => false)),
      'provider'     => new sfValidatorPass(array('required' => false)),
      'cardserial'   => new sfValidatorPass(array('required' => false)),
      'cardpin'      => new sfValidatorPass(array('required' => false)),
      'securitykey'  => new sfValidatorPass(array('required' => false)),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'senttime'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'receivedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cardvalue'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gamemoney'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tocash'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('purchase_money_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PurchaseMoney';
  }

  public function getFields()
  {
    return array(
      'purchaseid'   => 'Number',
      'userid'       => 'Number',
      'username'     => 'Text',
      'provider'     => 'Text',
      'cardserial'   => 'Text',
      'cardpin'      => 'Text',
      'securitykey'  => 'Text',
      'status'       => 'Number',
      'senttime'     => 'Date',
      'receivedtime' => 'Date',
      'cardvalue'    => 'Number',
      'gamemoney'    => 'Number',
      'tocash'       => 'Number',
    );
  }
}
