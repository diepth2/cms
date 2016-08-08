<?php

/**
 * CardProvider filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCardProviderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cardid'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cardname'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'submenu'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'len1'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'len2'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cardmsg'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'cardid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cardname'       => new sfValidatorPass(array('required' => false)),
      'submenu'        => new sfValidatorPass(array('required' => false)),
      'len1'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'len2'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cardmsg'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('card_provider_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CardProvider';
  }

  public function getFields()
  {
    return array(
      'cardproviderid' => 'Number',
      'cardid'         => 'Number',
      'cardname'       => 'Text',
      'submenu'        => 'Text',
      'len1'           => 'Number',
      'len2'           => 'Number',
      'cardmsg'        => 'Text',
    );
  }
}
