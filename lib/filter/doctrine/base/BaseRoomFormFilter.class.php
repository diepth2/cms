<?php

/**
 * Room filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRoomFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gameid'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'roomname'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'viproom'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mincash'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mingold'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'minlevel'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'roomcapacity'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'playersize'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'minbet'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tax'               => new sfWidgetFormFilterInput(),
      'maxroomplay'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'permanentroomplay' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'kicklimit'         => new sfWidgetFormFilterInput(),
      'starttime'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'endtime'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'gameid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'roomname'          => new sfValidatorPass(array('required' => false)),
      'viproom'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mincash'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mingold'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'minlevel'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'roomcapacity'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'playersize'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'minbet'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tax'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'maxroomplay'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'permanentroomplay' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kicklimit'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'starttime'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'endtime'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('room_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Room';
  }

  public function getFields()
  {
    return array(
      'roomid'            => 'Number',
      'gameid'            => 'Number',
      'roomname'          => 'Text',
      'viproom'           => 'Number',
      'mincash'           => 'Number',
      'mingold'           => 'Number',
      'minlevel'          => 'Number',
      'roomcapacity'      => 'Number',
      'playersize'        => 'Number',
      'minbet'            => 'Number',
      'tax'               => 'Number',
      'maxroomplay'       => 'Number',
      'permanentroomplay' => 'Number',
      'kicklimit'         => 'Number',
      'starttime'         => 'Date',
      'endtime'           => 'Date',
      'status'            => 'Number',
    );
  }
}
