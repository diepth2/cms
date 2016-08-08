<?php

/**
 * CmsCategoryFooter form base class.
 *
 * @method CmsCategoryFooter getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCmsCategoryFooterForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryfooterid' => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInputText(),
      'menutext'         => new sfWidgetFormInputText(),
      'parentid'         => new sfWidgetFormInputText(),
      'url'              => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'createdtime'      => new sfWidgetFormDateTime(),
      'modifiedtime'     => new sfWidgetFormDateTime(),
      'author'           => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'categoryfooterid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('categoryfooterid')), 'empty_value' => $this->getObject()->get('categoryfooterid'), 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'menutext'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parentid'         => new sfValidatorInteger(array('required' => false)),
      'url'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'createdtime'      => new sfValidatorDateTime(array('required' => false)),
      'modifiedtime'     => new sfValidatorDateTime(array('required' => false)),
      'author'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cms_category_footer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsCategoryFooter';
  }

}
