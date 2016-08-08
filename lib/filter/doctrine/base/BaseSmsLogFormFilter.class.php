<?php

/**
 * SmsLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSmsLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sender'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recipient'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mobody'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mtbody'      => new sfWidgetFormFilterInput(),
      'cp'          => new sfWidgetFormFilterInput(),
      'status'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'sendnumber'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sender'      => new sfValidatorPass(array('required' => false)),
      'recipient'   => new sfValidatorPass(array('required' => false)),
      'mobody'      => new sfValidatorPass(array('required' => false)),
      'mtbody'      => new sfValidatorPass(array('required' => false)),
      'cp'          => new sfValidatorPass(array('required' => false)),
      'status'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'createdtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'sendnumber'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sms_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SmsLog';
  }

  public function getFields()
  {
    return array(
      'smslogid'    => 'Number',
      'sender'      => 'Text',
      'recipient'   => 'Text',
      'mobody'      => 'Text',
      'mtbody'      => 'Text',
      'cp'          => 'Text',
      'status'      => 'Number',
      'createdtime' => 'Date',
      'sendnumber'  => 'Text',
    );
  }
}
