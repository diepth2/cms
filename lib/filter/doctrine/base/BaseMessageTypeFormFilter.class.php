<?php

/**
 * MessageType filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMessageTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'messagetypeid' => new sfWidgetFormFilterInput(),
      'name'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'messagetypeid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('message_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MessageType';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'messagetypeid' => 'Number',
      'name'          => 'Text',
    );
  }
}
