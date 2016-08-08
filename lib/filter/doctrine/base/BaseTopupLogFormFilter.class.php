<?php

/**
 * TopupLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTopupLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'timetopup'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'username'     => new sfWidgetFormFilterInput(),
      'cardserial'   => new sfWidgetFormFilterInput(),
      'cardpin'      => new sfWidgetFormFilterInput(),
      'value'        => new sfWidgetFormFilterInput(),
      'providercard' => new sfWidgetFormFilterInput(),
      'currentcash'  => new sfWidgetFormFilterInput(),
      'currentgold'  => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormFilterInput(),
      'userid'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'timetopup'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'username'     => new sfValidatorPass(array('required' => false)),
      'cardserial'   => new sfValidatorPass(array('required' => false)),
      'cardpin'      => new sfValidatorPass(array('required' => false)),
      'value'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'providercard' => new sfValidatorPass(array('required' => false)),
      'currentcash'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'currentgold'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'userid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('topup_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TopupLog';
  }

  public function getFields()
  {
    return array(
      'topupid'      => 'Number',
      'timetopup'    => 'Date',
      'username'     => 'Text',
      'cardserial'   => 'Text',
      'cardpin'      => 'Text',
      'value'        => 'Number',
      'providercard' => 'Text',
      'currentcash'  => 'Number',
      'currentgold'  => 'Number',
      'status'       => 'Number',
      'userid'       => 'Number',
    );
  }
}
