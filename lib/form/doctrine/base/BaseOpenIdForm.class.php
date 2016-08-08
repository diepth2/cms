<?php

/**
 * OpenId form base class.
 *
 * @method OpenId getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenIdForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'      => new sfWidgetFormInputHidden(),
      'channel'     => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
      'openid'      => new sfWidgetFormInputText(),
      'displayname' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'userid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('userid')), 'empty_value' => $this->getObject()->get('userid'), 'required' => false)),
      'channel'     => new sfValidatorInteger(),
      'createdtime' => new sfValidatorDateTime(),
      'openid'      => new sfValidatorString(array('max_length' => 255)),
      'displayname' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('open_id[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OpenId';
  }

}
