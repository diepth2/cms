<?php

/**
 * CmsRole form base class.
 *
 * @method CmsRole getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCmsRoleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'role_id'       => new sfWidgetFormInputHidden(),
      'user_id'       => new sfWidgetFormInputText(),
      'user_name'     => new sfWidgetFormInputText(),
      'create_date'   => new sfWidgetFormDateTime(),
      'modified_date' => new sfWidgetFormDateTime(),
      'role_name'     => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'status'        => new sfWidgetFormInputText(),
      'immune'        => new sfWidgetFormInputText(),
      'shareable'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'role_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('role_id')), 'empty_value' => $this->getObject()->get('role_id'), 'required' => false)),
      'user_id'       => new sfValidatorInteger(array('required' => false)),
      'user_name'     => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'create_date'   => new sfValidatorDateTime(array('required' => false)),
      'modified_date' => new sfValidatorDateTime(array('required' => false)),
      'role_name'     => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'status'        => new sfValidatorInteger(array('required' => false)),
      'immune'        => new sfValidatorInteger(array('required' => false)),
      'shareable'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cms_role[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsRole';
  }

}
