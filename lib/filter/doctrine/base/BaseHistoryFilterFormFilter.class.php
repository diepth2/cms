<?php

/**
 * HistoryFilter filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoryFilterFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'textview'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      '_sql'            => new sfWidgetFormFilterInput(),
      'role'            => new sfWidgetFormFilterInput(),
      '_order'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'textview'        => new sfValidatorPass(array('required' => false)),
      '_sql'            => new sfValidatorPass(array('required' => false)),
      'role'            => new sfValidatorPass(array('required' => false)),
      '_order'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('history_filter_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HistoryFilter';
  }

  public function getFields()
  {
    return array(
      'historyfilterid' => 'Number',
      'textview'        => 'Text',
      '_sql'            => 'Text',
      'role'            => 'Text',
      '_order'          => 'Number',
    );
  }
}
