<?php

/**
 * EpayLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEpayLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'time'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'    => new sfWidgetFormFilterInput(),
      'code'      => new sfWidgetFormFilterInput(),
      'success'   => new sfWidgetFormFilterInput(),
      'type'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'time'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'    => new sfValidatorPass(array('required' => false)),
      'code'      => new sfValidatorPass(array('required' => false)),
      'success'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('epay_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EpayLog';
  }

  public function getFields()
  {
    return array(
      'epaylogid' => 'Number',
      'time'      => 'Date',
      'status'    => 'Text',
      'code'      => 'Text',
      'success'   => 'Number',
      'type'      => 'Number',
    );
  }
}
