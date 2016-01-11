<?
$require_login = false;
require '../../knoopvszombies.ini.php';

require '../../www/module/includes.php';

require '../../www/module/general.php';
  
$sql = 'SELECT uid from game_xref where gid = 26 and status = "deceased"';
$deceased = $GLOBALS['Db']->GetRecords($sql);
$GLOBALS['User']->ClearAllUserCache();
foreach ($deceased as $user)
{
$GLOBALS['Game']->RemoveFromGame(26, $user['uid']);
}

?>

All done.
