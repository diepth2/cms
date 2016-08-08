<?php

/**
 * Level filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLevelFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'maxexp'      => new sfWidgetFormFilterInput(),
      'cashgift'    => new sfWidgetFormFilterInput(),
      'goldgift'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'maxexp'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cashgift'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'goldgift'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('level_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Level';
  }

  public function getFields()
  {
    return array(
      'level'       => 'Number',
      'name'        => 'Text',
      'description' => 'Text',
      'maxexp'      => 'Number',
      'cashgift'    => 'Number',
      'goldgift'    => 'Number',
    );
  }
}
