<?php

/**
 * Room form base class.
 *
 * @method Room getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRoomForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'roomid'            => new sfWidgetFormInputHidden(),
      'gameid'            => new sfWidgetFormInputText(),
      'roomname'          => new sfWidgetFormInputText(),
      'viproom'           => new sfWidgetFormInputText(),
      'mincash'           => new sfWidgetFormInputText(),
      'mingold'           => new sfWidgetFormInputText(),
      'minlevel'          => new sfWidgetFormInputText(),
      'roomcapacity'      => new sfWidgetFormInputText(),
      'playersize'        => new sfWidgetFormInputText(),
      'minbet'            => new sfWidgetFormInputText(),
      'tax'               => new sfWidgetFormInputText(),
      'maxroomplay'       => new sfWidgetFormInputText(),
      'permanentroomplay' => new sfWidgetFormInputText(),
      'kicklimit'         => new sfWidgetFormInputText(),
      'starttime'         => new sfWidgetFormDateTime(),
      'endtime'           => new sfWidgetFormDateTime(),
      'status'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'roomid'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('roomid')), 'empty_value' => $this->getObject()->get('roomid'), 'required' => false)),
      'gameid'            => new sfValidatorInteger(array('required' => false)),
      'roomname'          => new sfValidatorString(array('max_length' => 20)),
      'viproom'           => new sfValidatorInteger(array('required' => false)),
      'mincash'           => new sfValidatorInteger(array('required' => false)),
      'mingold'           => new sfValidatorInteger(array('required' => false)),
      'minlevel'          => new sfValidatorInteger(array('required' => false)),
      'roomcapacity'      => new sfValidatorInteger(array('required' => false)),
      'playersize'        => new sfValidatorInteger(),
      'minbet'            => new sfValidatorInteger(array('required' => false)),
      'tax'               => new sfValidatorInteger(array('required' => false)),
      'maxroomplay'       => new sfValidatorInteger(array('required' => false)),
      'permanentroomplay' => new sfValidatorInteger(array('required' => false)),
      'kicklimit'         => new sfValidatorInteger(array('required' => false)),
      'starttime'         => new sfValidatorDateTime(array('required' => false)),
      'endtime'           => new sfValidatorDateTime(array('required' => false)),
      'status'            => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('room[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Room';
  }

}
