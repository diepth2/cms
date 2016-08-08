<?php

/**
 * GameLog filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGameLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gameid'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hostuserid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'winnerid'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'roomid'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cash'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gold'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'uniqueid'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'inserttime'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'roomname'     => new sfWidgetFormFilterInput(),
      'playernumber' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'playercount'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'gameid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hostuserid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'winnerid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'roomid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cash'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gold'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'uniqueid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'inserttime'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'roomname'     => new sfValidatorPass(array('required' => false)),
      'playernumber' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'playercount'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('game_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameLog';
  }

  public function getFields()
  {
    return array(
      'gamelogid'    => 'Number',
      'gameid'       => 'Number',
      'hostuserid'   => 'Number',
      'winnerid'     => 'Number',
      'roomid'       => 'Number',
      'cash'         => 'Number',
      'gold'         => 'Number',
      'uniqueid'     => 'Number',
      'inserttime'   => 'Date',
      'roomname'     => 'Text',
      'playernumber' => 'Number',
      'playercount'  => 'Number',
    );
  }
}
