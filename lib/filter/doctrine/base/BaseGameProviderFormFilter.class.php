<?php

/**
 * GameProvider filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGameProviderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'providername' => new sfWidgetFormFilterInput(),
      'md5key'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'defaultcp'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'providername' => new sfValidatorPass(array('required' => false)),
      'md5key'       => new sfValidatorPass(array('required' => false)),
      'defaultcp'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_provider_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameProvider';
  }

  public function getFields()
  {
    return array(
      'providerid'   => 'Number',
      'providername' => 'Text',
      'md5key'       => 'Text',
      'defaultcp'    => 'Text',
    );
  }
}
