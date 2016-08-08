<?php

/**
 * AvatarResource form base class.
 *
 * @method AvatarResource getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAvatarResourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'avatarresourceid' => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'path'             => new sfWidgetFormInputText(),
      'cash'             => new sfWidgetFormInputText(),
      'gold'             => new sfWidgetFormInputText(),
      'buynumber'        => new sfWidgetFormInputText(),
      'createdtime'      => new sfWidgetFormDateTime(),
      'modifiedtime'     => new sfWidgetFormDateTime(),
      'width'            => new sfWidgetFormInputText(),
      'height'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'avatarresourceid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('avatarresourceid')), 'empty_value' => $this->getObject()->get('avatarresourceid'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 200)),
      'description'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'path'             => new sfValidatorString(array('max_length' => 200)),
      'cash'             => new sfValidatorInteger(array('required' => false)),
      'gold'             => new sfValidatorInteger(array('required' => false)),
      'buynumber'        => new sfValidatorInteger(array('required' => false)),
      'createdtime'      => new sfValidatorDateTime(array('required' => false)),
      'modifiedtime'     => new sfValidatorDateTime(array('required' => false)),
      'width'            => new sfValidatorInteger(array('required' => false)),
      'height'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('avatar_resource[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AvatarResource';
  }

}
