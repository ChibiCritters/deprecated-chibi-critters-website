<?php
    class FileNameHelper {
      private static function toAscii($str) {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

        return $clean;
      }

      public static function generateSlug($card, $set) {
        $name = FileNameHelper::toAscii($card->name);

        if (isset($set)) {
          $prefix = FileNameHelper::toAscii($set->name);
          $name = $prefix . '-' . $name;
        }

        return $name;
      }

    }
?>