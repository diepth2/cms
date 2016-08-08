<?php

/**
 * MatchLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMatchLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'roomid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'matchindex'  => new sfWidgetFormFilterInput(),
      'gameid'      => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'roomid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'matchindex'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gameid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description' => new sfValidatorPass(array('required' => false)),
      'createdtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('match_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MatchLog';
  }

  public function getFields()
  {
    return array(
      'matchlogid'  => 'Number',
      'roomid'      => 'Number',
      'matchindex'  => 'Number',
      'gameid'      => 'Number',
      'description' => 'Text',
      'createdtime' => 'Date',
    );
  }
}
