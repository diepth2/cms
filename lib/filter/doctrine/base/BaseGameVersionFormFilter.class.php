<?php

/**
 * GameVersion filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGameVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clientid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'versioncode'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'versionmsg'      => new sfWidgetFormFilterInput(),
      'forceupdate'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lastupdatedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'clientid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'versioncode'     => new sfValidatorPass(array('required' => false)),
      'versionmsg'      => new sfValidatorPass(array('required' => false)),
      'forceupdate'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lastupdatedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('game_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameVersion';
  }

  public function getFields()
  {
    return array(
      'versionid'       => 'Number',
      'clientid'        => 'Number',
      'versioncode'     => 'Text',
      'versionmsg'      => 'Text',
      'forceupdate'     => 'Number',
      'lastupdatedtime' => 'Date',
      'status'          => 'Number',
    );
  }
}
