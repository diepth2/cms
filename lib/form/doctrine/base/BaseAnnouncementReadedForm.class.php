<?php

/**
 * AnnouncementReaded form base class.
 *
 * @method AnnouncementReaded getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAnnouncementReadedForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'announcementreadedid' => new sfWidgetFormInputHidden(),
      'userid'               => new sfWidgetFormInputText(),
      'announcementid'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'announcementreadedid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('announcementreadedid')), 'empty_value' => $this->getObject()->get('announcementreadedid'), 'required' => false)),
      'userid'               => new sfValidatorInteger(array('required' => false)),
      'announcementid'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('announcement_readed[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AnnouncementReaded';
  }

}
