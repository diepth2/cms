<?php

/**
 * MoneyLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMoneyLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uuid'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logstamp'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'userid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'      => new sfWidgetFormFilterInput(),
      'transactionid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lastcash'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'changecash'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currentcash'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lastgold'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'changegold'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currentgold'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'taxpercent'    => new sfWidgetFormFilterInput(),
      'taxvalue'      => new sfWidgetFormFilterInput(),
      'gameid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'insertedtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cp'            => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'uuid'          => new sfValidatorPass(array('required' => false)),
      'logstamp'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'userid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'      => new sfValidatorPass(array('required' => false)),
      'transactionid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lastcash'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'changecash'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'currentcash'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lastgold'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'changegold'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'currentgold'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'taxpercent'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'taxvalue'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gameid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'insertedtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cp'            => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('money_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MoneyLog';
  }

  public function getFields()
  {
    return array(
      'logid'         => 'Number',
      'uuid'          => 'Text',
      'logstamp'      => 'Number',
      'userid'        => 'Number',
      'username'      => 'Text',
      'transactionid' => 'Number',
      'lastcash'      => 'Number',
      'changecash'    => 'Number',
      'currentcash'   => 'Number',
      'lastgold'      => 'Number',
      'changegold'    => 'Number',
      'currentgold'   => 'Number',
      'taxpercent'    => 'Number',
      'taxvalue'      => 'Number',
      'gameid'        => 'Number',
      'insertedtime'  => 'Date',
      'cp'            => 'Text',
      'description'   => 'Text',
    );
  }
}
