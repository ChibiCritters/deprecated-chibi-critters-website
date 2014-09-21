<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
/**
 * Abstract Class
 * Inherit Image Templates from here, including LoveTemplate, CritterTemplate, etc.
 * This class gaurantees constans and a generateImage functions. It also provides extended
 * GD library functions.
 *
 * TODO provide a function for text scrunching.
 */
define("FONT_PATH", ASSET_ROOT . '/fonts/times.ttf');
abstract class ImageTemplate {
  /** 
   * Constants
   */

  const FONTFILE = FONT_PATH;

  public static $OUTERIMAGE = [
    "width" => 825,
    "height" => 1125
  ];

  public static $INNERIMAGE = [
    "offsetX" => 123,
    "offsetY" => 195,
    "x" => 0,
    "y" => 0,
    "width" => 585,
    "height" => 544
  ];
  
  public static $NAMETEXT = [
    "fontsize" => 30,
    "rotation" => 0,
    "x" => 128,
    "y" => 165
  ];
  
  public static $EFFECTTEXT = [
    "fontsize" => 22,
    "rotation" => 0,
    "x" => 128,
    "y" => 750,
    "width" => 570,
    "minspacing" => 10,
    "linespacing" => 1.1
  ];

  /**
   * Ensure that all tempates generate an image
   */
  abstract public function generateImage();
  
  /**
   * Stamp the copywrite on the bottom of the card
   */
  protected function generateCopywrite(&$bg, $color, $rotated = false) {
    // TODO: supported rotated (90*) cards.
    imagefttext($bg, 18, 0, 128, 1038, $color, self::FONTFILE, 'Chibi Critters © Daniela Howe');
  }

  /**
   * Stamp the card code on the bottom of the card
   */
  protected function generateCardCode(&$bg, $color, $rotated, $setPrefix, $languagePrefix, $cardNumber) { 
    // TODO: supported rotated (90*) cards.
    // Add the card number (align right)
    $cardNumberText = strtoupper($this->setPrefix) . '-' . strtoupper($languagePrefix) . $cardNumber;
    $dimensions = imagettfbbox(18, 0, self::FONTFILE, $cardNumberText);
    $textWidth = abs($dimensions[4] - $dimensions[0]);
    
    imagefttext($bg, 18, 0, 698 - $textWidth, 1038, $color, self::FONTFILE, $cardNumberText);
  }
  
  /**
   * Provides imagettftext extension that allows justified text within a width.
   */
  protected function imagettftextjustified(
    &$image, 
    $size, 
    $angle, 
    $left, 
    $top, 
    $color,
    $font, 
    $text, 
    $max_width, 
    $minspacing=3,
    $linespacing=1, 
    $rotated = false) 
  {
    $wordwidth = array();
    $linewidth = array();
    $linewordcount = array();
    $largest_line_height = 0;
    $lineno = 0;
    $words = explode(" ",$text);
    $wln = 0;
    $linewidth[$lineno] = 0;
    $linewordcount[$lineno] = 0;
    foreach ($words as $word) {
      $dimensions = imagettfbbox($size, $angle, $font, $word);
      $line_width = $dimensions[2] - $dimensions[0];
      $line_height = $dimensions[1] - $dimensions[7];
      
      if ($line_height > $largest_line_height) 
        $largest_line_height = $line_height;
      
      if (($linewidth[$lineno] + $line_width + $minspacing) > $max_width) {
        $lineno++;
        $linewidth[$lineno]=0;
        $linewordcount[$lineno]=0;
        $wln=0;
      }
      $linewidth[$lineno]+=$line_width+$minspacing;
      $wordwidth[$lineno][$wln]=$line_width;
      $wordtext[$lineno][$wln]=$word;
      $linewordcount[$lineno]++;
      $wln++;
    }
    for ($ln=0;$ln<=$lineno;$ln++) {
      $slack = $max_width-$linewidth[$ln];
      // If not the last line, determine
      if (($linewordcount[$ln] > 1) && ($ln != $lineno)) 
        $spacing = ($slack/($linewordcount[$ln]-1));
      else 
        $spacing = 0;//$minspacing;
      $x=0;
      for ($w=0;$w<$linewordcount[$ln];$w++) {
        imagettftext($image, $size, $angle, $left + intval($x), $top + $largest_line_height + ($largest_line_height * $ln * $linespacing), $color, $font, $wordtext[$ln][$w]);
        $x+=$wordwidth[$ln][$w]+$spacing+$minspacing;
      }
    }
    return true;
  }
}


?>