<?php

/**
 * gvManagerUserRegister module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage gvManagerUserRegister
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseGvManagerUserRegisterGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  protected function compile()
  {
    $config = $this->getConfig();

    // inheritance rules:
    // new|edit < form < default
    // list < default
    // filter < default
    $this->configuration = array(
      'list'   => array(
        'fields'         => array(),
        'layout'         => $this->getListLayout(),
        'title'          => $this->getListTitle(),
        'actions'        => $this->getListActions(),
        'object_actions' => $this->getListObjectActions(),
        'params'         => $this->getListParams(),
      ),
      'filter' => array(
        'fields'  => array(),
      ),
      'form'   => array(
        'fields'  => array(),
      ),
      'new'    => array(
        'fields'  => array(),
        'title'   => $this->getNewTitle(),
        'actions' => $this->getNewActions() ? $this->getNewActions() : $this->getFormActions(),
      ),
      'edit'   => array(
        'fields'  => array(),
        'title'   => $this->getEditTitle(),
        'actions' => $this->getEditActions() ? $this->getEditActions() : $this->getFormActions(),
      ),
      'show'   => array(
        'fields'  => array(),
        'title'   => $this->getShowTitle(),
        'actions' => $this->getShowActions() ? $this->getShowActions() : $this->getFormActions(),
        'display' => $this->getShowDisplay(),
      ),
    );

    foreach (array_keys($config['default']) as $field)
    {
      $formConfig = array_merge($config['default'][$field], isset($config['form'][$field]) ? $config['form'][$field] : array());

      $this->configuration['list']['fields'][$field]   = new sfModelGeneratorConfigurationField($field, array_merge(array('label' => sfInflector::humanize(sfInflector::underscore($field))), $config['default'][$field], isset($config['list'][$field]) ? $config['list'][$field] : array()));
      $this->configuration['filter']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge($config['default'][$field], isset($config['filter'][$field]) ? $config['filter'][$field] : array()));
      $this->configuration['new']['fields'][$field]    = new sfModelGeneratorConfigurationField($field, array_merge($formConfig, isset($config['new'][$field]) ? $config['new'][$field] : array()));
      $this->configuration['edit']['fields'][$field]   = new sfModelGeneratorConfigurationField($field, array_merge($formConfig, isset($config['edit'][$field]) ? $config['edit'][$field] : array()));
      $this->configuration['show']['fields'][$field]   = new sfModelGeneratorConfigurationField($field, array_merge($formConfig, isset($config['show'][$field]) ? $config['show'][$field] : array()));
    }

    // "virtual" fields for list
    foreach ($this->getListDisplay() as $field)
    {
      list($field, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($field);

      $this->configuration['list']['fields'][$field] = new sfModelGeneratorConfigurationField($field, array_merge(
        array('type' => 'Text', 'label' => sfInflector::humanize(sfInflector::underscore($field))),
        isset($config['default'][$field]) ? $config['default'][$field] : array(),
        isset($config['list'][$field]) ? $config['list'][$field] : array(),
        array('flag' => $flag)
      ));
    }

    // form actions
    foreach (array('edit', 'new') as $context)
    {
      foreach ($this->configuration[$context]['actions'] as $action => $parameters)
      {
        $this->configuration[$context]['actions'][$action] = $this->fixActionParameters($action, $parameters);
      }
    }

    // list actions
    foreach ($this->configuration['list']['actions'] as $action => $parameters)
    {
      $this->configuration['list']['actions'][$action] = $this->fixActionParameters($action, $parameters);
    }

    // list batch actions
    $this->configuration['list']['batch_actions'] = array();
    foreach ($this->getListBatchActions() as $action => $parameters)
    {
      $parameters = $this->fixActionParameters($action, $parameters);

      $action = 'batch'.ucfirst(0 === strpos($action, '_') ? substr($action, 1) : $action);

      $this->configuration['list']['batch_actions'][$action] = $parameters;
    }

    // list object actions
    foreach ($this->configuration['list']['object_actions'] as $action => $parameters)
    {
      $this->configuration['list']['object_actions'][$action] = $this->fixActionParameters($action, $parameters);
    }

    // list field configuration
    $this->configuration['list']['display'] = array();
    foreach ($this->getListDisplay() as $name)
    {
      list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
      if (!isset($this->configuration['list']['fields'][$name]))
      {
        throw new InvalidArgumentException(sprintf('The field "%s" does not exist.', $name));
      }
      $field = $this->configuration['list']['fields'][$name];
      $field->setFlag($flag);
      $this->configuration['list']['display'][$name] = $field;
    }

    // parse the %%..%% variables, remove flags and add default fields where
    // necessary (fixes #7578)
    $this->parseVariables('list', 'params');
    $this->parseVariables('edit', 'title');
    $this->parseVariables('show', 'title');
    $this->parseVariables('list', 'title');
    $this->parseVariables('new', 'title');

    // action credentials
    $this->configuration['credentials'] = array(
      'list'   => array(),
      'new'    => array(),
      'create' => array(),
      'edit'   => array(),
      'show'   => array(),
      'update' => array(),
      'delete' => array(),
    );
    foreach ($this->getActionsDefault() as $action => $params)
    {
      if (0 === strpos($action, '_'))
      {
        $action = substr($action, 1);
      }

      $this->configuration['credentials'][$action] = isset($params['credentials']) ? $params['credentials'] : array();
      $this->configuration['credentials']['batch'.ucfirst($action)] = isset($params['credentials']) ? $params['credentials'] : array();
    }
    $this->configuration['credentials']['create'] = $this->configuration['credentials']['new'];
    $this->configuration['credentials']['update'] = $this->configuration['credentials']['edit'];


    $this->configuration['show'] = array( 'fields'         => array(),
                                          'title'          => $this->getShowTitle(),
                                          'actions'        => $this->getShowActions(),
                                          'display'        => $this->getShowDisplay(),
                                        ) ;

    foreach (array_keys($config['default']) as $field)
    {
      $formConfig = array_merge($config['default'][$field], $config['form'][$field]);
      $this->configuration['show']['fields'][$field]   = new sfModelGeneratorConfigurationField($field, array_merge(array('label' => sfInflector::humanize(sfInflector::underscore($field))), $config['default'][$field], $config['show'][$field]));
    }

    // virtual show fields
    foreach ($this->getShowDisplay() as $title => $fields)
    {
      foreach((array) $fields as $field)
      {
        list($field, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($field);

        $this->configuration['show']['fields'][$title][$field] = new sfModelGeneratorConfigurationField($field, array_merge(
            array('type' => 'Text', 'label' => sfInflector::humanize(sfInflector::underscore($field))),
            isset($config['default'][$field]) ? $config['default'][$field] : array(),
            isset($config['show'][$title][$field]) ? $config['show'][$title][$field] : array(),
            array('flag' => $flag)
        ));
      }
    }

    // show field configuration
    $this->configuration['show']['display'] = array();
    foreach ($this->getShowDisplay() as $title => $fields)
    {
      foreach((array) $fields as $name)
      {
        list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
        if (!isset($this->configuration['show']['fields'][$title][$name]))
        {
            throw new InvalidArgumentException(sprintf('The field "%s" does not exist.', $name));
        }
        $field = $this->configuration['show']['fields'][$title][$name];
        $field->setFlag($flag);
        $this->configuration['show']['display'][$title][$name] = $field;
      }
    }

    // show actions
    foreach (array('show') as $context)
    {
      foreach ($this->configuration[$context]['actions'] as $action => $parameters)
      {
        $this->configuration[$context]['actions'][$action] = $this->fixActionParameters($action, $parameters);
      }
    }

  }

  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array();
  }

  public function getListActions()
  {
    return array();
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%parter_name%% - %%os_build%% - %%imei%% - %%userid%% - %%username%% - %%display_name%% - %%registedtime%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Thống kê user đăng ký';
  }

  public function getEditTitle()
  {
    return 'Edit GvManagerUserRegister';
  }

  public function getNewTitle()
  {
    return 'New GvManagerUserRegister';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'registedtime',  1 => 'clientId',  2 => 'cp',  3 => 'ip',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'parter_name',  1 => 'os_build',  2 => 'imei',  3 => 'userid',  4 => 'username',  5 => 'display_name',  6 => 'registedtime',);
  }

  public function getFieldsDefault()
  {
    return array(
      'userid' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'username' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'password' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'displayname' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'identity' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'address' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'mobile' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'birthday' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'sex' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'registedtime' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'age' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'status' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'userid' => array(),
      'username' => array(),
      'password' => array(),
      'displayname' => array(),
      'identity' => array(),
      'address' => array(),
      'email' => array(),
      'mobile' => array(),
      'birthday' => array(),
      'sex' => array(),
      'registedtime' => array(),
      'age' => array(),
      'status' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'userid' => array(),
      'username' => array(),
      'password' => array(),
      'displayname' => array(),
      'identity' => array(),
      'address' => array(),
      'email' => array(),
      'mobile' => array(),
      'birthday' => array(),
      'sex' => array(),
      'registedtime' => array(),
      'age' => array(),
      'status' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'userid' => array(),
      'username' => array(),
      'password' => array(),
      'displayname' => array(),
      'identity' => array(),
      'address' => array(),
      'email' => array(),
      'mobile' => array(),
      'birthday' => array(),
      'sex' => array(),
      'registedtime' => array(),
      'age' => array(),
      'status' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'userid' => array(),
      'username' => array(),
      'password' => array(),
      'displayname' => array(),
      'identity' => array(),
      'address' => array(),
      'email' => array(),
      'mobile' => array(),
      'birthday' => array(),
      'sex' => array(),
      'registedtime' => array(),
      'age' => array(),
      'status' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'userid' => array(),
      'username' => array(),
      'password' => array(),
      'displayname' => array(),
      'identity' => array(),
      'address' => array(),
      'email' => array(),
      'mobile' => array(),
      'birthday' => array(),
      'sex' => array(),
      'registedtime' => array(),
      'age' => array(),
      'status' => array(),
    );
  }

  public function getFieldsShow()
  {
    return array(
      'userid' => array(),
      'username' => array(),
      'password' => array(),
      'displayname' => array(),
      'identity' => array(),
      'address' => array(),
      'email' => array(),
      'mobile' => array(),
      'birthday' => array(),
      'sex' => array(),
      'registedtime' => array(),
      'age' => array(),
      'status' => array(),
    );
  }


public function getGlobalSidebarStatus() {
    return false;
    }
public function getListSidebarStatus() {
    return $this->getGlobalSidebarStatus();
    }
public function getShowSidebarStatus() {
    return $this->getGlobalSidebarStatus();
    }
public function getEditSidebarStatus() {
    return $this->getGlobalSidebarStatus();
    }
public function getNewSidebarStatus() {
    return $this->getGlobalSidebarStatus();
    }
  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'UserForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'gvManageUserRegisterFormFiltersAdmin';
  }


  protected function getConfig()
  {
    $configuration = parent::getConfig();
    $configuration['show'] = $this->getFieldsShow();
    return $configuration;
  }

  public function getShowActions()
  {
    return array(  '_list' => NULL,  '_edit' => NULL,  '_delete' => NULL,);
      }


  public function getShowTitle()
  {
    return 'Show GvManagerUserRegister';
      }

  public function getShowDisplay()
  {
            return array('NONE' => array(  0 => 'userid',  1 => 'username',  2 => 'password',  3 => 'displayname',  4 => 'identity',  5 => 'address',  6 => 'email',  7 => 'mobile',  8 => 'birthday',  9 => 'sex',  10 => 'registedtime',  11 => 'age',  12 => 'status',));
          }



  public function getPager($model)
  {
    $class = $this->getPagerClass();

    return new $class($model, $this->getPagerMaxPerPage());
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return sfContext::getInstance()->getUser()->getAttribute('gvManagerUserRegister.max_per_page', 10, 'admin_module');
  }
  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }

  public function getContextConfiguration($context, $fields = null)
    {
        if (!isset($this->configuration[$context]))
        {
            throw new InvalidArgumentException(sprintf('The context "%s" does not exist.', $context));
        }

        if (null === $fields)
        {
            return $this->configuration[$context];
        }

        $f = array();
        $i18n_fields = array();
        foreach ($fields as $field)
        {
            if (in_array($field, $i18n_fields) && !array_key_exists($field, $this->configuration[$context]['fields']))
            {
                $f[$field] = new sfModelGeneratorConfigurationField($field, array('type' => 'Text', 'label' => $field));
            }
            else
            {
                $f[$field] = $this->configuration[$context]['fields'][$field];
            }
        }

        return $f;
    }

}
