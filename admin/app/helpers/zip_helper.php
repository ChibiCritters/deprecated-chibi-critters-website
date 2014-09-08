<?php
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  require_once(LIB_ROOT . 'zip.lib.php');

  class ZipHelper {
    public static function createZipFromStrings($filenames = array(), $files = array(), $destination = '', $overwrite = false) {
      if (file_exists($destination) && !$overwrite) {
        return false;
      }

      $zip = new ZipArchive();
      if ($zip->open($destination, $overwrite ?
          ZIPARCHIVE::OVERWRITE :
          ZIPARCHIVE::CREATE) !== true) {
        return false;
      }

      // Add files
      foreach($files as $index => $file) {
        $zip->addFromString($filenames[$index], $file);
      }

     return $zip;
    
    }
    public static function createZipFromImageResources($filenames = array(), $files = array()) {

      $zip = new zipfile();

      // Add files
      foreach($files as $index => $file) {
        ob_start(); //Turn on output buffering
        imagepng($file); //Generate your image

        $output = ob_get_contents(); // get the image as a string in a variable

        ob_end_clean(); //Turn off output buffering and clean it

        $zip->addFile($output, $filenames[$index]);
      }

      return $zip;
    }
  }
?>