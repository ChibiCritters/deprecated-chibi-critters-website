<?php
/**
 * Less Compiler
 */
require_once('application.php'); 
require_once(ROOT . 'lib/lessc.inc.php');

function autoCompileLess($inputFile, $cacheFile, $outputFile) {
  
  if (file_exists($cacheFile)) {
    $cache = unserialize(file_get_contents($cacheFile));
  } else {
    $cache = $inputFile;
  }

  $less = new lessc;
  $newCache =  $less->cachedCompile($cache);
  if (!is_array($cache) ||
    $newCache['updated'] > $cache['updated']) {
    file_put_contents($cacheFile, serialize($newCache));
    file_put_contents($outputFile, $newCache['compiled']);
  }
}

$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);


for ($i = 0; $i < sizeof($scriptName) && $i < sizeof($requestURI); $i++) {
  if ($requestURI[$i] == $scriptName[$i]) {
    unset($requestURI[$i]);
  } 
}

$command = array_values($requestURI);

$filename = $command[sizeof($command) - 1];

$lessFileName = ASSET_ROOT . '/less/' . str_replace('.less.css', '.less', $filename);
$outputFileName = ASSET_ROOT . '/less/cache/' . $filename;
$cacheFile = ASSET_ROOT . '/less/cache/' . $filename . '.cache';

autoCompileLess($lessFileName, $cacheFile, $outputFileName);

header('Content-Type: text/css');
echo file_get_contents($outputFileName);

?>