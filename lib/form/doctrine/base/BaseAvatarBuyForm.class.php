<?php

/**
 * AvatarBuy form base class.
 *
 * @method AvatarBuy getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAvatarBuyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'avatarbuyid' => new sfWidgetFormInputHidden(),
      'userid'      => new sfWidgetFormInputText(),
      'username'    => new sfWidgetFormInputText(),
      'avatarid'    => new sfWidgetFormInputText(),
      'boughttime'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'avatarbuyid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('avatarbuyid')), 'empty_value' => $this->getObject()->get('avatarbuyid'), 'required' => false)),
      'userid'      => new sfValidatorInteger(),
      'username'    => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'avatarid'    => new sfValidatorInteger(),
      'boughttime'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('avatar_buy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AvatarBuy';
  }

}
