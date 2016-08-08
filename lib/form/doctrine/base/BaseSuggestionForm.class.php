<?php

/**
 * Suggestion form base class.
 *
 * @method Suggestion getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSuggestionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'suggestionid' => new sfWidgetFormInputHidden(),
      'userid'       => new sfWidgetFormInputText(),
      'username'     => new sfWidgetFormInputText(),
      'posttime'     => new sfWidgetFormDateTime(),
      'note'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'suggestionid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('suggestionid')), 'empty_value' => $this->getObject()->get('suggestionid'), 'required' => false)),
      'userid'       => new sfValidatorInteger(array('required' => false)),
      'username'     => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'posttime'     => new sfValidatorDateTime(array('required' => false)),
      'note'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('suggestion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }

}
