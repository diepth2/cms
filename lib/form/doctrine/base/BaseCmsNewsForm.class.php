<?php

/**
 * CmsNews form base class.
 *
 * @method CmsNews getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCmsNewsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'newid'        => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormTextarea(),
      'description'  => new sfWidgetFormTextarea(),
      'content'      => new sfWidgetFormTextarea(),
      'photo'        => new sfWidgetFormInputText(),
      'createdtime'  => new sfWidgetFormDateTime(),
      'categoryid'   => new sfWidgetFormInputText(),
      'author'       => new sfWidgetFormInputText(),
      'views'        => new sfWidgetFormInputText(),
      'spotlight'    => new sfWidgetFormInputText(),
      'modifiedtime' => new sfWidgetFormDateTime(),
      'order'        => new sfWidgetFormInputText(),
      'slider'       => new sfWidgetFormInputText(),
      'website'      => new sfWidgetFormInputText(),
      'ispopup'      => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'newid'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('newid')), 'empty_value' => $this->getObject()->get('newid'), 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 500)),
      'description'  => new sfValidatorString(array('required' => false)),
      'content'      => new sfValidatorString(array('required' => false)),
      'photo'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'createdtime'  => new sfValidatorDateTime(),
      'categoryid'   => new sfValidatorInteger(array('required' => false)),
      'author'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'views'        => new sfValidatorInteger(array('required' => false)),
      'spotlight'    => new sfValidatorInteger(array('required' => false)),
      'modifiedtime' => new sfValidatorDateTime(array('required' => false)),
      'order'        => new sfValidatorInteger(array('required' => false)),
      'slider'       => new sfValidatorInteger(array('required' => false)),
      'website'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ispopup'      => new sfValidatorInteger(array('required' => false)),
      'status'       => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('cms_news[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsNews';
  }

}
