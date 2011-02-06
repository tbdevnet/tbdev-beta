<?php
/**
 * Creates an array by using one array for keys and another for its values
 *
 * @author Daniel Luft (erozion at t-online.de)
 * @param array $keys
 * @param array $values
 * @return array
 */
/*
if (!function_exists('array_combine')) {
 function array_combine($keys, $values)
 {
  if (!is_array($keys)) {
   user_error(
    'array_combine() expects parameter 1 to be array, ' . gettype($keys) . ' given',
    E_USER_WARNING
   );
   return;
  }
  if (!is_array($values)) {
   user_error(
    'array_combine() expects parameter 2 to be array, ' . gettype($values) . ' given',
    E_USER_WARNING
   );
   return;
  }
  $keysCount = count($keys);
  $valuesCount = count($values);
  if ($keysCount !== $valuesCount) {
   user_error(
    'array_combine() Both parameters should have equal number of elements',
    E_USER_WARNING
   );
   return false;
  }
  if ($keysCount === 0 || $valuesCount === 0) {
   user_error(
    'array_combine() Both parameters should have number of elements at least 0',
    E_USER_WARNING
   );
   return false;
  }
  $combined = array();
  foreach ($keys as $index => $key) {
   $combined[$key] = $values[$index];
  }
  return $combined;
 }
}
 */
/**
 * Gets the statistics from bf2web.gamespy.com as associative array
 *
 * @author Daniel Luft (erozion at t-online.de)
 * @param string $rawData
 * @return array
 */
function parseData($rawData)
{
 if (! preg_match_all('!^O\n(.*?)\n?\$\t(\d+)\t\$\n$!s', $rawData, $matches) )
  return false;
 
 $lines = preg_split('!\n!', $matches[1][0], -1, PREG_SPLIT_NO_EMPTY);
 
 $result = array();
 foreach ($lines as $line) {
  $data = explode("\t", $line);
  $flag = array_shift($data);
  
  if (strtoupper($flag) == 'H') {
   $header = $data;
   continue;
  }
  
  $result[] = array_combine($header, $data);
 }
 
 return $result;
}

$pid = '98242781'; 
$filename =   "http://bf2web.gamespy.com/ASP/getplayerinfo.aspx?pid=$pid&info=per*,cmb*,twsc,cpcp,cacp,dfcp,kila,heal,rviv,rsup,rpar,tgte,dkas,dsab,cdsc,rank,cmsc,kick,kill,deth,suic,ospm,klpm,klpr,dtpr,bksk,wdsk,bbrs,tcdr,ban,dtpm,lbtl,osaa,vrk,tsql,tsqm,tlwf,mvks,vmks,mvn*,vmr*,fkit,fmap,fveh,fwea,wtm-,wkl-,wdt-,wac-,wkd-,vtm-,vkl-,vdt-,vkd-,vkr-,atm-,awn-,alo-,abr-,ktm-,kkl-,kdt-,kkd-";
ini_set("user_agent","GameSpyHTTP/1.0");
$fp = fopen ($filename, "r");
$data = '';
while (!feof ($fp)) {
$data .= fgets( $fp, 4096 );
}
fclose($fp) or die("error");

echo '<pre>';
print_r(parseData($data));
echo '</pre>';
?>