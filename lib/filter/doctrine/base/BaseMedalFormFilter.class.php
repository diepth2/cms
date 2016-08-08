<?php

/**
 * Medal filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMedalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'maxlevel'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      '_bytes'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'maxlevel'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      '_bytes'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('medal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Medal';
  }

  public function getFields()
  {
    return array(
      'medal'       => 'Number',
      'name'        => 'Text',
      'description' => 'Text',
      'maxlevel'    => 'Number',
      '_bytes'      => 'Text',
    );
  }
}
