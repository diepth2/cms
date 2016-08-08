<?php

/**
 * HistoryFilter form base class.
 *
 * @method HistoryFilter getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoryFilterForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'historyfilterid' => new sfWidgetFormInputHidden(),
      'textview'        => new sfWidgetFormTextarea(),
      '_sql'            => new sfWidgetFormTextarea(),
      'role'            => new sfWidgetFormTextarea(),
      '_order'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'historyfilterid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('historyfilterid')), 'empty_value' => $this->getObject()->get('historyfilterid'), 'required' => false)),
      'textview'        => new sfValidatorString(array('max_length' => 5000)),
      '_sql'            => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'role'            => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      '_order'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('history_filter[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HistoryFilter';
  }

}
