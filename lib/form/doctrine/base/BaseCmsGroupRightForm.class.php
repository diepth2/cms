<?php

/**
 * CmsGroupRight form base class.
 *
 * @method CmsGroupRight getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCmsGroupRightForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id' => new sfWidgetFormInputHidden(),
      'right_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('group_id')), 'empty_value' => $this->getObject()->get('group_id'), 'required' => false)),
      'right_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('right_id')), 'empty_value' => $this->getObject()->get('right_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cms_group_right[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsGroupRight';
  }

}
