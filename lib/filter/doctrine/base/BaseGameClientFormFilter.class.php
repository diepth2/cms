<?php

/**
 * GameClient filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGameClientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clientname' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'clientname' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_client_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameClient';
  }

  public function getFields()
  {
    return array(
      'clientid'   => 'Number',
      'clientname' => 'Text',
    );
  }
}
