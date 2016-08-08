<?php
/**
 * Created by JetBrains PhpStorm.
 * User: conghuyvn8x
 * Date: 2/8/15
 * Time: 10:01 AM
 * To change this template use File | Settings | File Templates.
 */
class UserFormLogin extends UserForm
{
    public function configure()
    {
        parent::configure();
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['username'] = new sfWidgetFormInputText(array(), array('id' => 'username', 'style' => 'border: 0px; font-size: 11px; background: none 0% 0% repeat transparent;', 'placeholder' => "Tài khoản"));
        // pass
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('id' => 'pass', 'placeholder' => "Password", 'style' => 'border: 0;background: transparent;font-size: 11px;'));

        $this->validatorSchema['username'] = new sfValidatorString(array('required' => true), array('required' => $i18n->__('Tên đăng nhập không được để trống!')));

        $this->validatorSchema['password'] = new sfValidatorString(array('required' => true), array('required' => $i18n->__('Mật khẩu không được để trống!')));

        $this->useFields(array('username', 'password'));

        $this->widgetSchema->setNameFormat('g_login[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}
