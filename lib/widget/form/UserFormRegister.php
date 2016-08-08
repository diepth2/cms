<?php
/**
 * Created by JetBrains PhpStorm.
 * User: conghuyvn8x
 * Date: 2/8/15
 * Time: 10:01 AM
 * To change this template use File | Settings | File Templates.
 */
class UserFormRegister extends UserForm
{
    public function configure()
    {
        parent::configure();
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['username'] = new sfWidgetFormInputText(array(), array('max_length' => 3, 'class' => 'input_large', 'id' => 'userreg'));
        // pass
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(), array('class' => 'input_large', 'id' => 'passreg'));
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(array(), array('class' => 'input_large', 'id' => 'repassword'));

        $this->validatorSchema['username'] = new sfValidatorString(array('required' => true), array('required' => $i18n->__('Tên đăng nhập không được để trống!'), 'max_length' => $i18n->__("Tên đăng nhập phải lớn hơn 3 kí tự!")));

        $this->validatorSchema['password'] = new sfValidatorString(array('required' => true), array('required' => $i18n->__('Mật khẩu không được để trống!'), 'max_length' => $i18n->__("Mật khẩu phải lớn hơn 6 kí tự!")));
        $this->validatorSchema['password_again'] = new sfValidatorString(array('required' => true), array('required' => $i18n->__('Mật khẩu không được để trống'), 'max_length' => $i18n->__("Mật khẩu phải lớn hơn 6 kí tự!")));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkValidator'))));

        $this->widgetSchema['agreeCheck'] = new sfWidgetFormInputCheckbox(array(), array('id' => 'checkbox'));
        $this->validatorSchema['agreeCheck'] = new sfValidatorBoolean(array('required' => true), array('required' => 'Bạn chưa đồng ý với các điều khoản sử dụng dịch vụ!'));

        $this->useFields(array('username', 'password', 'password_again', 'agreeCheck'));
//        $this->useFields('username', 'password', 'password_again', 'agreeCheck');

        $this->widgetSchema->setNameFormat('g_register[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    public function checkValidator($validator, $values)
    {
        //
        $i18n = sfContext::getInstance()->getI18N();

        if ($values['password_again'] != null && $values['password'] != null) {
            if ($values['password_again'] != $values['password']) {
                $error1 = new sfValidatorError($validator, $i18n->__('Mật khẩu không khớp nhau, vui lòng nhập lại.'));
                throw new sfValidatorErrorSchema($validator, array('password_again' => $error1));
            }
        }

        return $values;
    }
}
