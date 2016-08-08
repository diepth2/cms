<?php

/**
 * CmsGroup form base class.
 *
 * @method CmsGroup getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCmsGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'      => new sfWidgetFormInputHidden(),
      'user_id'       => new sfWidgetFormInputText(),
      'user_name'     => new sfWidgetFormInputText(),
      'create_date'   => new sfWidgetFormDateTime(),
      'category_id'   => new sfWidgetFormInputText(),
      'modified_date' => new sfWidgetFormDateTime(),
      'group_name'    => new sfWidgetFormInputText(),
      'status'        => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'group_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('group_id')), 'empty_value' => $this->getObject()->get('group_id'), 'required' => false)),
      'user_id'       => new sfValidatorInteger(array('required' => false)),
      'user_name'     => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'create_date'   => new sfValidatorDateTime(array('required' => false)),
      'category_id'   => new sfValidatorInteger(array('required' => false)),
      'modified_date' => new sfValidatorDateTime(array('required' => false)),
      'group_name'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'        => new sfValidatorInteger(array('required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cms_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsGroup';
  }

}
