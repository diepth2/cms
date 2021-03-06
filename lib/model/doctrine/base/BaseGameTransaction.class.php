<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('GameTransaction', 'doctrine');

/**
 * BaseGameTransaction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $gametransactionid
 * @property string $type
 * @property string $code
 * 
 * @method integer         getId()                Returns the current record's "id" value
 * @method integer         getGametransactionid() Returns the current record's "gametransactionid" value
 * @method string          getType()              Returns the current record's "type" value
 * @method string          getCode()              Returns the current record's "code" value
 * @method GameTransaction setId()                Sets the current record's "id" value
 * @method GameTransaction setGametransactionid() Sets the current record's "gametransactionid" value
 * @method GameTransaction setType()              Sets the current record's "type" value
 * @method GameTransaction setCode()              Sets the current record's "code" value
 * 
 * @package    Vt_Portals
 * @subpackage model
 * @author     ngoctv1
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGameTransaction extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('game_transaction');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('gametransactionid', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('type', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 40,
             ));
        $this->hasColumn('code', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 40,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}