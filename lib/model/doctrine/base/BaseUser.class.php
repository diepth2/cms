<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('User', 'doctrine');

/**
 * BaseUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $userid
 * @property string $username
 * @property string $password
 * @property string $displayname
 * @property string $identity
 * @property string $address
 * @property string $email
 * @property string $mobile
 * @property date $birthday
 * @property integer $sex
 * @property timestamp $registedtime
 * @property integer $age
 * @property integer $status
 * @property UserInfo $UserInfo
 * @property Doctrine_Collection $LogPayment
 * 
 * @method integer             getUserid()       Returns the current record's "userid" value
 * @method string              getUsername()     Returns the current record's "username" value
 * @method string              getPassword()     Returns the current record's "password" value
 * @method string              getDisplayname()  Returns the current record's "displayname" value
 * @method string              getIdentity()     Returns the current record's "identity" value
 * @method string              getAddress()      Returns the current record's "address" value
 * @method string              getEmail()        Returns the current record's "email" value
 * @method string              getMobile()       Returns the current record's "mobile" value
 * @method date                getBirthday()     Returns the current record's "birthday" value
 * @method integer             getSex()          Returns the current record's "sex" value
 * @method timestamp           getRegistedtime() Returns the current record's "registedtime" value
 * @method integer             getAge()          Returns the current record's "age" value
 * @method integer             getStatus()       Returns the current record's "status" value
 * @method UserInfo            getUserInfo()     Returns the current record's "UserInfo" value
 * @method Doctrine_Collection getLogPayment()   Returns the current record's "LogPayment" collection
 * @method User                setUserid()       Sets the current record's "userid" value
 * @method User                setUsername()     Sets the current record's "username" value
 * @method User                setPassword()     Sets the current record's "password" value
 * @method User                setDisplayname()  Sets the current record's "displayname" value
 * @method User                setIdentity()     Sets the current record's "identity" value
 * @method User                setAddress()      Sets the current record's "address" value
 * @method User                setEmail()        Sets the current record's "email" value
 * @method User                setMobile()       Sets the current record's "mobile" value
 * @method User                setBirthday()     Sets the current record's "birthday" value
 * @method User                setSex()          Sets the current record's "sex" value
 * @method User                setRegistedtime() Sets the current record's "registedtime" value
 * @method User                setAge()          Sets the current record's "age" value
 * @method User                setStatus()       Sets the current record's "status" value
 * @method User                setUserInfo()     Sets the current record's "UserInfo" value
 * @method User                setLogPayment()   Sets the current record's "LogPayment" collection
 * 
 * @package    Vt_Portals
 * @subpackage model
 * @author     diepth2
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('userid', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('username', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('password', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('displayname', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('identity', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('address', 'string', 200, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 200,
             ));
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('mobile', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('birthday', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('sex', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('registedtime', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('age', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '20',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '1',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UserInfo', array(
             'local' => 'userId',
             'foreign' => 'userId'));

        $this->hasMany('LogPayment', array(
             'local' => 'userId',
             'foreign' => 'userId'));
    }
}