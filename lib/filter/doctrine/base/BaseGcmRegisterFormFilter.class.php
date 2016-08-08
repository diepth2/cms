<?php

/**
 * GcmRegister filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGcmRegisterFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gcmid'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'os'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'modifiedtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cp'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'gcmid'         => new sfValidatorPass(array('required' => false)),
      'os'            => new sfValidatorPass(array('required' => false)),
      'createdtime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cp'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gcm_register_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GcmRegister';
  }

  public function getFields()
  {
    return array(
      'gcmregisterid' => 'Number',
      'gcmid'         => 'Text',
      'os'            => 'Text',
      'createdtime'   => 'Date',
      'modifiedtime'  => 'Date',
      'cp'            => 'Text',
    );
  }
}
