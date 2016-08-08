<?php

/**
 * SmsText filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSmsTextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gameid'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'partnerid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'txref'          => new sfWidgetFormFilterInput(),
      'operatornumber' => new sfWidgetFormFilterInput(),
      'cmdcode'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'msisdn'         => new sfWidgetFormFilterInput(),
      'mobody'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mtbody'         => new sfWidgetFormFilterInput(),
      'targetuserid'   => new sfWidgetFormFilterInput(),
      'targetusername' => new sfWidgetFormFilterInput(),
      'receivedtime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'responedtime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'gameid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'partnerid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'txref'          => new sfValidatorPass(array('required' => false)),
      'operatornumber' => new sfValidatorPass(array('required' => false)),
      'cmdcode'        => new sfValidatorPass(array('required' => false)),
      'msisdn'         => new sfValidatorPass(array('required' => false)),
      'mobody'         => new sfValidatorPass(array('required' => false)),
      'mtbody'         => new sfValidatorPass(array('required' => false)),
      'targetuserid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'targetusername' => new sfValidatorPass(array('required' => false)),
      'receivedtime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'responedtime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sms_text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SmsText';
  }

  public function getFields()
  {
    return array(
      'smstextid'      => 'Number',
      'gameid'         => 'Number',
      'partnerid'      => 'Number',
      'txref'          => 'Text',
      'operatornumber' => 'Text',
      'cmdcode'        => 'Text',
      'msisdn'         => 'Text',
      'mobody'         => 'Text',
      'mtbody'         => 'Text',
      'targetuserid'   => 'Number',
      'targetusername' => 'Text',
      'receivedtime'   => 'Date',
      'responedtime'   => 'Date',
      'status'         => 'Number',
    );
  }
}
