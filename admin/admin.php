<?php

global $page, $user, $lang, $conf, $template, $errors;

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

check_status(ACCESS_ADMINISTRATOR);

if(!defined('REGFLUXBB_PATH'))
{
  define('REGFLUXBB_PATH' , PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');
}

include_once (PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');
include_once (PHPWG_ROOT_PATH.'/include/constants.php');

load_language('plugin.lang', REGFLUXBB_PATH);

$conf_Register_FluxBB = unserialize($conf['Register_FluxBB']);

// +-----------------------------------------------------------------------+
// |                      Getting plugin version                           |
// +-----------------------------------------------------------------------+
$plugin =  RegFluxBB_Infos(REGFLUXBB_PATH);
$version = $plugin['version'] ;

// +-----------------------------------------------------------------------+
// |                            Actions process                            |
// +-----------------------------------------------------------------------+
if (isset($_GET['action']) and ($_GET['action']=='link_dead'))
{
  $query = '
DELETE FROM '.Register_FluxBB_ID_TABLE.'
WHERE id_user_FluxBB NOT IN (
  SELECT id
  FROM '.FluxBB_USERS_TABLE.'
  )
OR id_user_pwg NOT IN (
  SELECT id
  FROM '.USERS_TABLE.'
  )
;';

  $result = pwg_query($query);
  
  Audit_PWG_FluxBB();
}
else if (isset($_GET['action']) and ($_GET['action']=='link_del') and isset($_GET['pwg_id']) and isset($_GET['bb_id']))
{
  $query = '
DELETE FROM '.Register_FluxBB_ID_TABLE.'
WHERE id_user_pwg = '.$_GET['pwg_id'].'
AND id_user_FluxBB = '.$_GET['bb_id'].'
;';

  $result = pwg_query($query);
  
  Audit_PWG_FluxBB();
}
else if (isset($_GET['action']) and ($_GET['action']=='new_link') and isset($_GET['pwg_id']) and isset($_GET['bb_id']))
{
  FluxBB_Linkuser($_GET['pwg_id'], $_GET['bb_id']);
  
  Audit_PWG_FluxBB();
}
else if (isset($_GET['action']) and ($_GET['action']=='sync_user') and isset($_GET['username']))
{
  $query = '
SELECT id AS id_pwg, username, password, mail_address 
FROM '.USERS_TABLE.'
WHERE BINARY username = BINARY "'.pwg_db_real_escape_string($_GET['username']).'"
AND username NOT IN ("18","16")
LIMIT 1
;';

  $data = pwg_db_fetch_assoc(pwg_query($query));
  
  if (!empty($data))
  {
    FluxBB_Updateuser($data['id_pwg'], stripslashes($data['username']), $data['password'], $data['mail_address']);
  }
  
  Audit_PWG_FluxBB();
}
else if (isset($_GET['action']) and ($_GET['action']=='add_user') and isset($_GET['username']))
{
  $query = '
SELECT id, username, password, mail_address 
FROM '.USERS_TABLE.'
WHERE BINARY username = BINARY "'.pwg_db_real_escape_string($_GET['username']).'"
AND username NOT IN ("18","16")
LIMIT 1
;';

  $data = pwg_db_fetch_assoc(pwg_query($query));
  
  if (!empty($data))
    FluxBB_Adduser($data['id'], stripslashes($data['username']), $data['password'], $data['mail_address']);  
  
    Audit_PWG_FluxBB();
}
else if (isset($_GET['action']) and ($_GET['action']=='del_user') and isset($_GET['id']))
{
  FluxBB_Deluser( $_GET['id'], true );
  
  Audit_PWG_FluxBB();
}


// +------------------------------------------------------------------+
// |                        Plugin settings                           |
// +------------------------------------------------------------------+
if (isset($_POST['submit']) and isset($_POST['FluxBB_prefix']) and isset($_POST['FluxBB_admin']) and isset($_POST['FluxBB_guest']) and isset($_POST['FluxBB_del_pt']) and isset($_POST['FluxBB_confirm']) and isset($_POST['FluxBB_details']))
{
  $_POST['FluxBB_admin'] = stripslashes($_POST['FluxBB_admin']);
  $_POST['FluxBB_guest'] = stripslashes($_POST['FluxBB_guest']);

/* Configuration controls */
// Piwigo's admin username control
  $query = '
SELECT username, id
FROM '.USERS_TABLE.'
WHERE id = '.$conf['webmaster_id'].'
;';

  $pwgadmin = pwg_db_fetch_assoc(pwg_query($query));

if (isset($_POST['FluxBB_prefix']) and $_POST['FluxBB_prefix'] <>'')
{
// FluxBB's admin username control
  $query = '
SELECT username, id
FROM '.$_POST['FluxBB_prefix'].'users'.'
WHERE id = 2
;';

  $fbbadmin = pwg_db_fetch_assoc(pwg_query($query));

// FluxBB's Guest username control
  $query = '
SELECT username, id
FROM '.$_POST['FluxBB_prefix'].'users'.'
WHERE id = 1
;';
}


  $fbbguest = pwg_db_fetch_assoc(pwg_query($query));

// Compute configuration errors
  if (stripslashes($pwgadmin['username']) != $_POST['FluxBB_admin'])
  {
    array_push($page['errors'], l10n('error_config_admin1'));
  }
  if (stripslashes($pwgadmin['username']) != stripslashes($fbbadmin['username']))
  {
    array_push($page['errors'], l10n('error_config_admin2'));
  }
  if (stripslashes($fbbguest['username']) != stripslashes($_POST['FluxBB_guest']))
  {
    array_push($page['errors'], l10n('error_config_guest'));
  }
  elseif (count($page['errors']) == 0)
  {
    if (!function_exists('FindAvailableConfirmMailID'))
    {
      $_POST['FluxBB_UAM'] = 'false';
      $_POST['FluxBB_group'] = '0';

      $newconf_RegFluxBB['REGFLUXBB_VERSION'] = $version;
      $newconf_RegFluxBB['FLUXBB_PREFIX'] = (isset($_POST['FluxBB_prefix']) ? $_POST['FluxBB_prefix'] : '');
      $newconf_RegFluxBB['FLUXBB_ADMIN'] = (isset($_POST['FluxBB_admin']) ? $_POST['FluxBB_admin'] : '');
      $newconf_RegFluxBB['FLUXBB_GUEST'] = (isset($_POST['FluxBB_guest']) ? $_POST['FluxBB_guest'] : '');
      $newconf_RegFluxBB['FLUXBB_DEL_PT'] = (isset($_POST['FluxBB_del_pt']) ? $_POST['FluxBB_del_pt'] : 'false');
      $newconf_RegFluxBB['FLUXBB_CONFIRM'] = (isset($_POST['FluxBB_confirm']) ? $_POST['FluxBB_confirm'] : 'false');
      $newconf_RegFluxBB['FLUXBB_DETAIL'] = (isset($_POST['FluxBB_details']) ? $_POST['FluxBB_details'] : 'false');
      $newconf_RegFluxBB['FLUXBB_UAM_LINK'] = (isset($_POST['FluxBB_UAM']) ? $_POST['FluxBB_UAM'] : 'false');
      $newconf_RegFluxBB['FLUXBB_GROUP'] = (isset($_POST['FluxBB_group']) ? $_POST['FluxBB_group'] : '');
    }
    elseif (function_exists('FindAvailableConfirmMailID'))
    {
      $conf_UAM = unserialize($conf['UserAdvManager']);
        
      if (isset($conf_UAM['CONFIRM_MAIL']) and ($conf_UAM['CONFIRM_MAIL'] == 'true' or $conf_UAM['CONFIRM_MAIL'] == 'local') and isset($conf_UAM['NO_CONFIRM_GROUP']) and $conf_UAM['NO_CONFIRM_GROUP'] != '-1')
      {
        $newconf_RegFluxBB['REGFLUXBB_VERSION'] = $version;
        $newconf_RegFluxBB['FLUXBB_PREFIX'] = (isset($_POST['FluxBB_prefix']) ? $_POST['FluxBB_prefix'] : '');
        $newconf_RegFluxBB['FLUXBB_ADMIN'] = (isset($_POST['FluxBB_admin']) ? $_POST['FluxBB_admin'] : '');
        $newconf_RegFluxBB['FLUXBB_GUEST'] = (isset($_POST['FluxBB_guest']) ? $_POST['FluxBB_guest'] : '');
        $newconf_RegFluxBB['FLUXBB_DEL_PT'] = (isset($_POST['FluxBB_del_pt']) ? $_POST['FluxBB_del_pt'] : 'false');
        $newconf_RegFluxBB['FLUXBB_CONFIRM'] = (isset($_POST['FluxBB_confirm']) ? $_POST['FluxBB_confirm'] : 'false');
        $newconf_RegFluxBB['FLUXBB_DETAIL'] = (isset($_POST['FluxBB_details']) ? $_POST['FluxBB_details'] : 'false');
        $newconf_RegFluxBB['FLUXBB_UAM_LINK'] = (isset($_POST['FluxBB_UAM']) ? $_POST['FluxBB_UAM'] : 'false');
        $newconf_RegFluxBB['FLUXBB_GROUP'] = (isset($_POST['FluxBB_group']) ? $_POST['FluxBB_group'] : '');
      }
      else
      {
        $_POST['FluxBB_UAM'] = 'false';
        $_POST['FluxBB_group'] = '0';

        $newconf_RegFluxBB['REGFLUXBB_VERSION'] = $version;
        $newconf_RegFluxBB['FLUXBB_PREFIX'] = (isset($_POST['FluxBB_prefix']) ? $_POST['FluxBB_prefix'] : '');
        $newconf_RegFluxBB['FLUXBB_ADMIN'] = (isset($_POST['FluxBB_admin']) ? $_POST['FluxBB_admin'] : '');
        $newconf_RegFluxBB['FLUXBB_GUEST'] = (isset($_POST['FluxBB_guest']) ? $_POST['FluxBB_guest'] : '');
        $newconf_RegFluxBB['FLUXBB_DEL_PT'] = (isset($_POST['FluxBB_del_pt']) ? $_POST['FluxBB_del_pt'] : 'false');
        $newconf_RegFluxBB['FLUXBB_CONFIRM'] = (isset($_POST['FluxBB_confirm']) ? $_POST['FluxBB_confirm'] : 'false');
        $newconf_RegFluxBB['FLUXBB_DETAIL'] = (isset($_POST['FluxBB_details']) ? $_POST['FluxBB_details'] : 'false');
        $newconf_RegFluxBB['FLUXBB_UAM_LINK'] = (isset($_POST['FluxBB_UAM']) ? $_POST['FluxBB_UAM'] : 'false');
        $newconf_RegFluxBB['FLUXBB_GROUP'] = (isset($_POST['FluxBB_group']) ? $_POST['FluxBB_group'] : '');
      }
    }

    $conf['Register_FluxBB'] = serialize($newconf_RegFluxBB);

    conf_update_param('Register_FluxBB', pwg_db_real_escape_string($conf['Register_FluxBB']));

    array_push($page['infos'], l10n('save_config'));
  }
}


// +------------------------------------------------------------+
// |                    Migration and Audit                     |
// +------------------------------------------------------------+
if (isset($_POST['Migration']))
{
  array_push($page['infos'], l10n('Mig_Start').'<br><br>');

  array_push($page['infos'], l10n('Mig_Del_Link').'<br><br>');

  $query = 'TRUNCATE '.Register_FluxBB_ID_TABLE.';';
  $result = pwg_query($query);

  $msg_Mig_Del_AllUsers = '';

  $query = '
SELECT username, id
FROM '.FluxBB_USERS_TABLE.'
;';

  $result = pwg_query($query);

  while ($row = pwg_db_fetch_assoc($result))
  {
    if((stripslashes($row['username']) != stripslashes($conf_Register_FluxBB['FLUXBB_GUEST'])) and (stripslashes($row['username']) != stripslashes($conf_Register_FluxBB['FLUXBB_ADMIN'])))
    {
      $msg_Mig_Del_AllUsers .= '<br> - '.l10n('Mig_Del_User').stripslashes($row['username']);

      FluxBB_Deluser($row['id'], false);
    }
  }

  array_push($page['infos'], l10n('Mig_Del_AllUsers').$msg_Mig_Del_AllUsers.'<br><br>');

  $query = '
SELECT id, username, password, mail_address
FROM '.USERS_TABLE.'
WHERE username NOT IN ("18","16")
;';

  $result = pwg_query($query);

  $registred = time();
  $registred_ip = $_SERVER['REMOTE_ADDR'];

  $msg_Mig_Add_AllUsers = '';

  while ($row = pwg_db_fetch_assoc($result))
  {
    if((stripslashes($row['username']) != 'guest') and (stripslashes($row['username']) != stripslashes($conf_Register_FluxBB['FLUXBB_ADMIN'])))
    {
      $msg_Mig_Add_AllUsers .= '<br> - '.l10n('Mig_Add_User').stripslashes($row['username']);

      FluxBB_Adduser($row['id'], stripslashes($row['username']), $row['password'], $row['mail_address']);
    }
  }

  array_push($page['infos'], l10n('Mig_Add_AllUsers').$msg_Mig_Add_AllUsers.'<br><br>');

  $query = '
SELECT id, username, password, mail_address
FROM '.USERS_TABLE.'
WHERE username = "'.$conf_Register_FluxBB['FLUXBB_ADMIN'].'"
AND username NOT IN ("18","16")
;';

  $row = pwg_db_fetch_assoc(pwg_query($query));

  if (!empty($row))
  {
    array_push($page['infos'], l10n('Sync_User').stripslashes($row['username']).'<br><br>');

    FluxBB_Updateuser($row['id'], stripslashes($row['username']), $row['password'], $row['mail_address']);
  }

  array_push($page['infos'], l10n('Mig_End'));
}
else if (isset($_POST['Audit']))
{
  Audit_PWG_FluxBB();
}


// +--------------------------------------------------------+
// |                    Synch and Audit                     |
// +--------------------------------------------------------+
if ( isset($_POST['Synchro']))
{
  $page_Register_FluxBB_admin = get_admin_plugin_menu_link(__FILE__);
  
  $msg_error_PWG_Dup = '';
  $msg_error_FluxBB_Dup = '';
  $msg_error_Link_Break = '';
  $msg_error_Link_Bad = '';
  $msg_error_Synchro = '';
  $msg_ok_Synchro = '';
  $msg_error_FluxBB2PWG = '';
  $msg_error_PWG2FluxBB = '';


  $query = '
SELECT COUNT(*) AS nbr_dup, id, username
FROM '.USERS_TABLE.'
WHERE username NOT IN ("18","16")
GROUP BY BINARY username
HAVING COUNT(*) > 1
;';

  $result = pwg_query($query);

  while($row = pwg_db_fetch_assoc($result))
    $msg_error_PWG_Dup .= '<br>'.l10n('Error_PWG_Dup').$row['nbr_dup'].' x '.stripslashes($row['username']);

    if ($msg_error_PWG_Dup <> '')
      $msg_error_PWG_Dup = l10n('Audit_PWG_Dup').$msg_error_PWG_Dup.'<br>'.l10n('Advise_PWG_Dup');

  $query = '
SELECT COUNT(*) AS nbr_dup, username
FROM '.FluxBB_USERS_TABLE.' 
GROUP BY BINARY username
HAVING COUNT(*) > 1
;';

  $result = pwg_query($query);

  while($row = pwg_db_fetch_assoc($result))
  {
    $msg_error_FluxBB_Dup .= '<br>'.l10n('Error_FluxBB_Dup').$row['nbr_dup'].' x '.stripslashes($row['username']);

    $subquery = '
SELECT id, username, email
FROM '.FluxBB_USERS_TABLE.' 
WHERE BINARY username = BINARY "'.$row['username'].'"
;';

    $subresult = pwg_query($subquery);

    while($subrow = pwg_db_fetch_assoc($subresult))
    {
      $msg_error_FluxBB_Dup .= '<br>id:'.$subrow['id'].'='.stripslashes($subrow['username']).' ('.$subrow['email'].')';

      $msg_error_FluxBB_Dup .= ' <a href="';

      $msg_error_FluxBB_Dup .= add_url_params($page_Register_FluxBB_admin, array(
        'action' => 'del_user',
        'id' => $subrow['id'],
      ));

      $msg_error_FluxBB_Dup .= '" title="'.l10n('Del_User').stripslashes($subrow['username']).'"';

      $msg_error_FluxBB_Dup .= $conf_Register_FluxBB['FLUXBB_CONFIRM']=='false' ?  ' onclick="return confirm(\''.l10n('Are you sure?').'\');" ' : ' ';

      $msg_error_FluxBB_Dup .= '><img src="'.REGFLUXBB_PATH.'/admin/template/icon/user_delete.png" alt="'.l10n('Del_User').stripslashes($subrow['username']).'" /></a>';
    }
  }

  if ($msg_error_FluxBB_Dup <> '')
    $msg_error_FluxBB_Dup = l10n('Sync_Check_Dup').$msg_error_FluxBB_Dup.'<br>'.l10n('Advise_FluxBB_Dup');

  if ($msg_error_FluxBB_Dup == '' and $msg_error_PWG_Dup == '')
  {
    $query = '
SELECT pwg.id as pwg_id, bb.id as bb_id, pwg.username as pwg_user, pwg.mail_address as pwg_mail
FROM '.FluxBB_USERS_TABLE.' AS bb, '.USERS_TABLE.' as pwg
WHERE bb.id NOT in (
  SELECT id_user_FluxBB
  FROM '.Register_FluxBB_ID_TABLE.'
  )
AND pwg.id NOT in (
  SELECT id_user_pwg
  FROM '.Register_FluxBB_ID_TABLE.'
  )
AND pwg.username = bb.username
AND pwg.username NOT IN ("18","16")
AND pwg.mail_address = bb.email
;';

    $result = pwg_query($query);

    while($row = pwg_db_fetch_assoc($result))
    {
      $msg_error_Link_Break .= '<br>'.l10n('New_Link').stripslashes($row['pwg_user']).' ('.$row['pwg_mail'].')';
      FluxBB_Linkuser($row['pwg_id'], $row['bb_id']);
    }

    if ($msg_error_Link_Break == '')
      array_push($page['infos'], l10n('Sync_Link_Break').'<br>'.l10n('Sync_OK'));
    else
      $msg_error_Link_Break = l10n('Sync_Link_Break').$msg_error_Link_Break;

    $query = '
SELECT pwg.username as pwg_user, pwg.id as pwg_id, pwg.mail_address as pwg_mail, bb.id as bb_id, bb.username as bb_user, bb.email as bb_mail
FROM '.FluxBB_USERS_TABLE.' AS bb 
INNER JOIN '.Register_FluxBB_ID_TABLE.' AS link ON link.id_user_FluxBB = bb.id
INNER JOIN '.USERS_TABLE.' as pwg ON link.id_user_pwg = pwg.id
WHERE BINARY pwg.username <> BINARY bb.username
AND pwg.username NOT IN ("18","16")
;';

    $result = pwg_query($query);

    while($row = pwg_db_fetch_assoc($result))
    {
      $msg_error_Link_Bad .= '<br>'.l10n('Link_Del').stripslashes($row['pwg_user']).' ('.$row['pwg_mail'].')'.' -- '.stripslashes($row['bb_user']).' ('.$row['bb_mail'].')';

      $subquery = '
DELETE FROM '.Register_FluxBB_ID_TABLE.'
WHERE id_user_pwg = '.$row['pwg_id'].'
AND id_user_FluxBB = '.$row['bb_id'].'
;';

      $subresult = pwg_query($subquery);
    }

    $query = '
SELECT COUNT(*) as nbr_dead
FROM '.Register_FluxBB_ID_TABLE.' AS Link
WHERE id_user_FluxBB NOT IN (
  SELECT id
  FROM '.FluxBB_USERS_TABLE.'
  )
OR id_user_pwg NOT IN (
  SELECT id
  FROM '.USERS_TABLE.'
  )
;';

    $Compteur = pwg_db_fetch_assoc(pwg_query($query));

    if (!empty($Compteur) and $Compteur['nbr_dead'] > 0)
    { 
      $msg_error_Link_Bad .= '<br>'.l10n('Link_Dead').$Compteur['nbr_dead'];

      $query = '
DELETE FROM '.Register_FluxBB_ID_TABLE.'
WHERE id_user_FluxBB NOT IN (
  SELECT id
  FROM '.FluxBB_USERS_TABLE.'
  )
OR id_user_pwg NOT IN (
  SELECT id
  FROM '.USERS_TABLE.'
  )
;';

      $result = pwg_query($query);
    }

    $query = '
SELECT COUNT(*) AS nbr_dup, pwg.id AS pwg_id, pwg.username AS pwg_user, bb.username AS bb_user, bb.id AS bb_id
FROM '.FluxBB_USERS_TABLE.' AS bb 
INNER JOIN '.Register_FluxBB_ID_TABLE.' AS link ON link.id_user_FluxBB = bb.id
INNER JOIN '.USERS_TABLE.' as pwg ON link.id_user_pwg = pwg.id
WHERE pwg.username NOT IN ("18","16")
GROUP BY link.id_user_pwg, link.id_user_FluxBB
HAVING COUNT(*) > 1
;';

    $result = pwg_query($query);
    
    while($row = pwg_db_fetch_assoc($result))
    {
      $msg_error_Link_Bad .= '<br>'.l10n('Link_Dup').$row['nbr_dup'].' = '.stripslashes($row['pwg_user']).' -- '.stripslashes($row['bb_user']).')';
  
      FluxBB_Linkuser($row['pwg_id'], $row['bb_id']);
    }

    if ($msg_error_Link_Bad == '')
      array_push($page['infos'], l10n('Sync_Link_Bad').'<br>'.l10n('Sync_OK'));
    else
      $msg_error_Link_Bad = l10n('Sync_Link_Bad').$msg_error_Link_Bad;

    $query = '
SELECT pwg.id as pwg_id, pwg.username as username, pwg.password as pwg_pwd, pwg.mail_address as pwg_eml, FluxBB.id as bb_id, FluxBB.password as bb_pwd, FluxBB.email as bb_eml
FROM '.FluxBB_USERS_TABLE.' AS FluxBB 
INNER JOIN '.Register_FluxBB_ID_TABLE.' AS link ON link.id_user_FluxBB = FluxBB.id
INNER JOIN '.USERS_TABLE.' as pwg ON link.id_user_pwg = pwg.id
AND BINARY pwg.username = BINARY FluxBB.username
ORDER BY LOWER(pwg.username)
;';

    $result = pwg_query($query);

    while($row = pwg_db_fetch_assoc($result))
    {
      if ( ($row['pwg_pwd'] != $row['bb_pwd']) or ($row['pwg_eml'] != $row['bb_eml']) )
      {
        $msg_error_Synchro .= '<br>'.l10n('Sync_User').stripslashes($row['username']);

        $query = '
SELECT id, username, password, mail_address 
FROM '.USERS_TABLE.'
WHERE BINARY id = "'.$row['pwg_id'].'"
AND "'.$row['username'].'" NOT IN ("18","16")
;';

        $data = pwg_db_fetch_assoc(pwg_query($query));

        if (!empty($data))
          FluxBB_Updateuser($data['id'], stripslashes($data['username']), $data['password'], $data['mail_address']);
      }
    }

    if ($msg_error_Synchro == '')
      array_push($page['infos'], l10n('Sync_DataUser').'<br>'.l10n('Sync_OK'));
    else
      $msg_error_Synchro = l10n('Sync_DataUser').$msg_error_Synchro;

    $query = '
SELECT username, mail_address FROM '.USERS_TABLE.'
WHERE BINARY username <> BINARY "guest"
AND username NOT IN ("18","16")
AND id not in (
  SELECT id_user_pwg FROM '.Register_FluxBB_ID_TABLE.'
  )
AND BINARY username not in (
  SELECT username FROM '.FluxBB_USERS_TABLE.'
  )
ORDER BY LOWER(username)
;';

    $result = pwg_query($query);

    while($row = pwg_db_fetch_assoc($result))
    {
      $msg_error_PWG2FluxBB .= '<br>'.l10n('Add_User').stripslashes($row['username']).' ('.$row['mail_address'].')';

      $query = '
SELECT id, username, password, mail_address 
FROM '.USERS_TABLE.'
WHERE BINARY username = BINARY "'.$row['username'].'"
AND username NOT IN ("18","16")
LIMIT 1
;';

      $data = pwg_db_fetch_assoc(pwg_query($query));

      if (!empty($data))
        FluxBB_Adduser($data['id'], stripslashes($data['username']), $data['password'], $data['mail_address']);  
    }

    if ($msg_error_PWG2FluxBB == '')
      array_push($page['infos'], l10n('Sync_PWG2FluxBB').'<br>'.l10n('Sync_OK'));
    else
      $msg_error_PWG2FluxBB = l10n('Sync_PWG2FluxBB').$msg_error_PWG2FluxBB;
  
    $query = '
SELECT id, username, email FROM '.FluxBB_USERS_TABLE.'
WHERE BINARY username <> BINARY "'.$conf_Register_FluxBB['FLUXBB_GUEST'].'"
AND id not in (
  SELECT id_user_FluxBB FROM '.Register_FluxBB_ID_TABLE.'
  )
AND BINARY username not in (
  SELECT username FROM '.USERS_TABLE.'
  )
ORDER BY LOWER(username)
;';

    $result = pwg_query($query);

    while($row = pwg_db_fetch_assoc($result))
    {
      $msg_error_FluxBB2PWG .= '<br>'.l10n('Error_FluxBB2PWG').stripslashes($row['username']).' ('.$row['email'].')';
      $msg_error_FluxBB2PWG .= ' <a href="';
      $msg_error_FluxBB2PWG .= add_url_params($page_Register_FluxBB_admin, array(
          'action' => 'del_user',
          'id' => $row['id'],
      ));

      $msg_error_FluxBB2PWG .= '" title="'.l10n('Del_User').stripslashes($row['username']).'"';

      $msg_error_FluxBB2PWG .= $conf_Register_FluxBB['FLUXBB_CONFIRM']=='false' ?  ' onclick="return confirm(\''.l10n('Are you sure?').'\');" ' : ' ';

      $msg_error_FluxBB2PWG .= '><img src="'.REGFLUXBB_PATH.'/admin/template/icon/user_delete.png" alt="'.l10n('Del_User').stripslashes($row['username']).'" /></a>';
    }

    if ($msg_error_FluxBB2PWG == '')
      array_push($page['infos'], l10n('Sync_FluxBB2PWG').'<br>'.l10n('Sync_OK'));
    else
      $msg_error_FluxBB2PWG = l10n('Sync_FluxBB2PWG').$msg_error_FluxBB2PWG;
  }
  else
    $errors[] = l10n('Advise_Check_Dup');

  if ($msg_error_PWG_Dup <> '')
    $errors[] = $msg_error_PWG_Dup . ( ($msg_error_FluxBB_Dup == '' and $msg_error_Link_Break == '' and $msg_error_Link_Bad == '' and $msg_error_Synchro == '' and $msg_error_PWG2FluxBB == '' and $msg_error_FluxBB2PWG == '') ? '' : '<br><br>' );

  if ($msg_error_FluxBB_Dup <> '')
    $errors[] = $msg_error_FluxBB_Dup . ( ($msg_error_Link_Break == '' and $msg_error_Link_Bad == '' and $msg_error_Synchro == '' and $msg_error_PWG2FluxBB == '' and $msg_error_FluxBB2PWG == '') ? '' : '<br><br>' );

  if ($msg_error_Link_Break <> '')
    $errors[] = $msg_error_Link_Break . ( ($msg_error_Link_Bad == '' and $msg_error_Synchro == '' and $msg_error_PWG2FluxBB == '' and $msg_error_FluxBB2PWG == '') ? '' : '<br><br>' );

  if ($msg_error_Link_Bad <> '')
    $errors[] = $msg_error_Link_Bad . ( ($msg_error_Synchro == '' and $msg_error_PWG2FluxBB == '' and $msg_error_FluxBB2PWG == '') ? '' : '<br><br>' );

  if ($msg_error_Synchro <> '')
    $errors[] = $msg_error_Synchro . ( ($msg_error_PWG2FluxBB == '' and $msg_error_FluxBB2PWG == '') ? '' : '<br><br>' );

  if ($msg_error_PWG2FluxBB <> '')
    $errors[] = $msg_error_PWG2FluxBB . ( ($msg_error_FluxBB2PWG == '') ? '' : '<br><br>' );

  if ($msg_error_FluxBB2PWG <> '')
    $errors[] = $msg_error_FluxBB2PWG;
}
else if ( isset($_POST['Audit']))
{
  Audit_PWG_FluxBB();
}


// +---------------------------------------------------------------+
// |                       Template init                           |
// +---------------------------------------------------------------+
$conf_Register_FluxBB = unserialize($conf['Register_FluxBB']);

// If UAM exists and if UAM ConfirmMail is set, we can set this feature
if (function_exists('FindAvailableConfirmMailID'))
{
  $conf_UAM = unserialize($conf['UserAdvManager']);

  if (isset($conf_UAM['CONFIRM_MAIL']) and ($conf_UAM['CONFIRM_MAIL'] == 'true' or $conf_UAM['CONFIRM_MAIL'] == 'local') and (isset($conf_UAM['NO_CONFIRM_GROUP']) and $conf_UAM['NO_CONFIRM_GROUP'] <> '-1'))
  {
    $UAM_bridge = true;
  }
  else $UAM_bridge = false;
}
else $UAM_bridge = false;

// Save last opened paragraph in configuration tab
// -----------------------------------------------
$nb_para=(isset($_POST["nb_para"])) ? $_POST["nb_para"]:"";
$nb_para2=(isset($_POST["nb_para2"])) ? $_POST["nb_para2"]:"";

$themeconf=$template->get_template_vars('themeconf');
$RFBB_theme=$themeconf['id'];

$template->assign(
  array
  (
    'nb_para'              => $nb_para,
    'nb_para2'             => $nb_para2,
    'REGFLUXBB_THEME'      => $RFBB_theme,
    'REGFLUXBB_PATH'       => REGFLUXBB_PATH,
    'REGFLUXBB_VERSION'    => $conf_Register_FluxBB['REGFLUXBB_VERSION'],
    'FluxBB_PREFIX'        => $conf_Register_FluxBB['FLUXBB_PREFIX'],
    'FluxBB_ADMIN'         => stripslashes($conf_Register_FluxBB['FLUXBB_ADMIN']),
    'FluxBB_GUEST'         => stripslashes($conf_Register_FluxBB['FLUXBB_GUEST']),
    'FluxBB_DEL_PT_TRUE'   => $conf_Register_FluxBB['FLUXBB_DEL_PT'] == 'true' ? 'checked="checked"' : '',
    'FluxBB_DEL_PT_FALSE'  => $conf_Register_FluxBB['FLUXBB_DEL_PT'] == 'false' ? 'checked="checked"' : '',
    'FluxBB_CONFIRM_TRUE'  => $conf_Register_FluxBB['FLUXBB_CONFIRM'] == 'true' ? 'checked="checked"' : '',
    'FluxBB_CONFIRM_FALSE' => $conf_Register_FluxBB['FLUXBB_CONFIRM'] == 'false' ? 'checked="checked"' : '',
    'FluxBB_DETAILS_TRUE'  => $conf_Register_FluxBB['FLUXBB_DETAIL'] == 'true' ? 'checked="checked"' : '',
    'FluxBB_DETAILS_FALSE' => $conf_Register_FluxBB['FLUXBB_DETAIL'] == 'false' ? 'checked="checked"' : '',
    'UAM_BRIDGE'           => $UAM_bridge,
    'FluxBB_UAM_LINK_TRUE' => $conf_Register_FluxBB['FLUXBB_UAM_LINK'] == 'true' ? 'checked="checked"' : '',
    'FluxBB_UAM_LINK_FALSE'=> $conf_Register_FluxBB['FLUXBB_UAM_LINK'] == 'false' ? 'checked="checked"' : '',
    'FluxBB_GROUP'         => $conf_Register_FluxBB['FLUXBB_GROUP'],
  )
);

$template->set_filename('plugin_admin_content', dirname(__FILE__) . '/template/admin.tpl');
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
?>