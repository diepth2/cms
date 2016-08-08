<?php

/**
 * DataLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDataLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'createdtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'insertedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'userid'       => new sfWidgetFormFilterInput(),
      'username'     => new sfWidgetFormFilterInput(),
      'matchid'      => new sfWidgetFormFilterInput(),
      'type'         => new sfWidgetFormFilterInput(),
      'content'      => new sfWidgetFormFilterInput(),
      'clienttype'   => new sfWidgetFormFilterInput(),
      'matchindex'   => new sfWidgetFormFilterInput(),
      'duration'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'createdtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'insertedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'userid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'     => new sfValidatorPass(array('required' => false)),
      'matchid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content'      => new sfValidatorPass(array('required' => false)),
      'clienttype'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'matchindex'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'duration'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('data_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DataLog';
  }

  public function getFields()
  {
    return array(
      'datalogid'    => 'Number',
      'createdtime'  => 'Date',
      'insertedtime' => 'Date',
      'userid'       => 'Number',
      'username'     => 'Text',
      'matchid'      => 'Number',
      'type'         => 'Number',
      'content'      => 'Text',
      'clienttype'   => 'Number',
      'matchindex'   => 'Number',
      'duration'     => 'Number',
    );
  }
}
