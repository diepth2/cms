<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('GcmRegister', 'doctrine');

/**
 * BaseGcmRegister
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $gcmregisterid
 * @property string $gcmid
 * @property string $os
 * @property timestamp $createdtime
 * @property timestamp $modifiedtime
 * @property string $cp
 * 
 * @method integer     getGcmregisterid() Returns the current record's "gcmregisterid" value
 * @method string      getGcmid()         Returns the current record's "gcmid" value
 * @method string      getOs()            Returns the current record's "os" value
 * @method timestamp   getCreatedtime()   Returns the current record's "createdtime" value
 * @method timestamp   getModifiedtime()  Returns the current record's "modifiedtime" value
 * @method string      getCp()            Returns the current record's "cp" value
 * @method GcmRegister setGcmregisterid() Sets the current record's "gcmregisterid" value
 * @method GcmRegister setGcmid()         Sets the current record's "gcmid" value
 * @method GcmRegister setOs()            Sets the current record's "os" value
 * @method GcmRegister setCreatedtime()   Sets the current record's "createdtime" value
 * @method GcmRegister setModifiedtime()  Sets the current record's "modifiedtime" value
 * @method GcmRegister setCp()            Sets the current record's "cp" value
 * 
 * @package    Vt_Portals
 * @subpackage model
 * @author     diepth2
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGcmRegister extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('gcm_register');
        $this->hasColumn('gcmregisterid', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('gcmid', 'string', 1000, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1000,
             ));
        $this->hasColumn('os', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('createdtime', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('modifiedtime', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('cp', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}