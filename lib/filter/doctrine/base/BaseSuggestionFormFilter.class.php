<?php

/**
 * Suggestion filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSuggestionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'       => new sfWidgetFormFilterInput(),
      'username'     => new sfWidgetFormFilterInput(),
      'posttime'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'note'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'userid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'     => new sfValidatorPass(array('required' => false)),
      'posttime'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'note'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('suggestion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }

  public function getFields()
  {
    return array(
      'suggestionid' => 'Number',
      'userid'       => 'Number',
      'username'     => 'Text',
      'posttime'     => 'Date',
      'note'         => 'Text',
    );
  }
}
