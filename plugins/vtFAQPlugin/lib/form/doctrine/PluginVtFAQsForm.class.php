<?php

/**
 * PluginVtFAQs form.
 * @subpackage form
 * @author     dongvt1
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginVtFAQsForm extends BaseVtFAQsForm
{
  public function setup()
  {
    parent::setup();
    $i18n=  sfContext::getInstance()->getI18N();
    unset($this['created_at'],$this['updated_at']);
    // Question
    $this->widgetSchema['question'] = new sfWidgetFormTextarea();
    $this->validatorSchema['question'] = new sfValidatorString(array(
      'required'   => true,
      'max_length' => 255,
      'trim'       => true,
    ));

    // Answer
    $this->widgetSchema['answer'] = new sfWidgetFormCKEditor(array(
      'jsoptions' => array('toolbar' => 'Basic')
    ));
    $this->validatorSchema['answer'] = new sfValidatorString(array(
      'required'   => true,
      'max_length' => 10000,
      'trim'       => true,
    ));

    $this->widgetSchema['priority'] = new sfWidgetFormInputText();
    $this->validatorSchema ['priority'] = new sfValidatorInteger(array(
        'required' => false,
        'max'      => 999999,
        'min'      => 0,
      ),
      array('invalid' => $i18n->__('invalid ( only number and max string 6 )')
      ));
  }

  /**
   * Xu ly du lieu trc khi save
   * @param array $values
   */
  protected function doBind(array $values)
  {
    // loai bo loi XSS va cat khoang trong trc khi luu DB
    $values['answer'] = trim($values['answer']);
    $answer = trim(VtHelper::strip_html_tags(str_replace('&nbsp;', ' ', $values['answer'])));

    if (!$answer) {
      $values['answer'] = '';
    }

    $values['question'] = VtHelper::strip_html_tags(trim($values['question']));

    // Gan lai gia tri da bind truoc do
    $this->taintedValues = $values;
    parent::doBind($values);
  }
}
