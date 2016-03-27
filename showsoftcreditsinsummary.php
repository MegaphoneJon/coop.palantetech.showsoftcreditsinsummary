<?php

require_once 'showsoftcreditsinsummary.civix.php';

function showsoftcreditsinsummary_civicrm_searchColumns( $objectName, &$headers,  &$values, &$selector ) {
  if($objectName == 'contribution') {
    foreach($headers as $k=>$header) {
      if ($header['name'] == 'Premium') {
        $headers[$k]['name'] = 'Soft Credit';
        unset($headers[$k]['sort']);
      }
    }

    // Get the contact id of the contact we're viewing.
    $contact_id = $values[0]['contact_id'];
    // Select a list of contributions that have soft credits from this contact,
    // plus the name of the creditees.  This is better than doing a separate SQL
    // query for each contribution.
    $sql = "SELECT cc.id, creditee.display_name FROM civicrm_contribution cc JOIN civicrm_contribution_soft ccs ON cc.id = ccs.contribution_id JOIN civicrm_contact creditee ON ccs.contact_id = creditee.id WHERE cc.contact_id = %1";
    $dao = CRM_Core_DAO::executeQuery( $sql, array( 1 => array( $contact_id, 'Integer' ) ) );
    //FIXME: This will only store one soft creditee per contribution.
    while ($dao->fetch()) {
      $credits[$dao->id] = $dao->display_name;
    }

    // Insert the soft creditee name as "product_name" so we don't have to
    // change the templates.
    foreach($values as $k=>$value) {
      if( array_key_exists($value['contribution_id'], $credits)) {
        $values[$k]['product_name'] = $credits[$value['contribution_id']];
      }
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function showsoftcreditsinsummary_civicrm_config(&$config) {
  _showsoftcreditsinsummary_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function showsoftcreditsinsummary_civicrm_xmlMenu(&$files) {
  _showsoftcreditsinsummary_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function showsoftcreditsinsummary_civicrm_install() {
  _showsoftcreditsinsummary_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function showsoftcreditsinsummary_civicrm_uninstall() {
  _showsoftcreditsinsummary_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function showsoftcreditsinsummary_civicrm_enable() {
  _showsoftcreditsinsummary_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function showsoftcreditsinsummary_civicrm_disable() {
  _showsoftcreditsinsummary_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function showsoftcreditsinsummary_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _showsoftcreditsinsummary_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function showsoftcreditsinsummary_civicrm_managed(&$entities) {
  _showsoftcreditsinsummary_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function showsoftcreditsinsummary_civicrm_caseTypes(&$caseTypes) {
  _showsoftcreditsinsummary_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function showsoftcreditsinsummary_civicrm_angularModules(&$angularModules) {
_showsoftcreditsinsummary_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function showsoftcreditsinsummary_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _showsoftcreditsinsummary_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function showsoftcreditsinsummary_civicrm_preProcess($formName, &$form) {

}

*/
