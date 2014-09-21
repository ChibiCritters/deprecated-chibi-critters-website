<?php
require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
require_once 'image_template.php';

class QuestTemplate extends ImageTemplate {
  protected $backgroundImagePath = '';
  protected $foregroundImagePath = '';
  protected $name = '';
  protected $condition = '';
  protected $effect = '';
  protected $turnCount = '';
  protected $prize = '';
  protected $penalty = '';
  protected $questPoints = '';
  protected $setPrefix = '';
  protected $languagePrefix = '';
  protected $cardNumber = '';
  protected $imagePath = '';

  public static $QUEST_INNERIMAGE = [
    "offsetX" => 316,
    "offsetY" => 132,
    "x" => 0,
    "y" => 0,
    "width" => 320,
    "height" => 868
  ];
  public static $QUEST_NAMETEXT = [
    "fontsize" => 30,
    "rotation" => -90,
    "x" => 658,
    "y" => 130
  ];

  public static $QUEST_EFFECTTEXT = [
    "fontsize" => 14,
    "rotation" => 0,
    "x" => 220,
    "y" => 130,
    "width" => 420,
    "minspacing" => 2,
    "linespacing" => 1.0
  ];

  public static $QUEST_TURNCOUNT = [
    "fontsize" => 38,
    "rotation" => -90,
    "x" => 655,
    "y" => 560
  ];

  public static $QUEST_QUESTPOINTS = [
    "fontsize" => 30,
    "rotation" => -90,
    "x" => 655,
    "y" => 1000
  ];

  public static $QUEST_LEFTTEXT = [
  ];

  public static $QUEST_RESTEXT = [
  ];

  public function __construct(
    $backgroundImagePath, 
    $foregroundImagePath, 
    $name, 
    $condition,
    $effect,
    $turnCount, 
    $prize,
    $penalty,
    $questPoints,
    $setPrefix, 
    $languagePrefix, 
    $cardNumber, 
    $imagePath) 
  {
    $this->backgroundImagePath = ASSET_ROOT . '/chibi_critters_images/' . $backgroundImagePath;
    $this->foregroundImagePath = ASSET_ROOT . '/chibi_critters_images/' . $foregroundImagePath;
    $this->name = $name;
    $this->condition = $condition;
    $this->effect = $effect;
    $this->turnCount = $turnCount;
    $this->prize = $prize;
    $this->penalty = $penalty;
    $this->questPoints = $questPoints;
    $this->setPrefix = $setPrefix;
    $this->languagePrefix = $languagePrefix;
    $this->cardNumber = $cardNumber;
    $this->imagePath = ASSET_ROOT . $imagePath;
  }

  public function generateImage() {
    $bg = imagecreatetruecolor ( 
      self::$OUTERIMAGE["width"],
      self::$OUTERIMAGE["height"]);

    // Grab the background image
    $bgFile = imagecreatefrompng($this->backgroundImagePath);
    $bgInfo = getimagesize($this->backgroundImagePath);

    imagecopy($bg, $bgFile, 0, 0, 0, 0, $bgInfo[0], $bgInfo[1]);

    // Grab the foreground image
    $fg = imagecreatefrompng($this->foregroundImagePath);
    $fgInfo = getimagesize($this->foregroundImagePath);

    // Grab the image
    $image = imagecreatefrompng($this->imagePath);
    $imageInfo = getimagesize($this->imagePath);

    // Rotate the image
    $image = imagerotate($image, -90, imagecolorexact($bg, 0, 0, 0));

    // Make sure the image is the correct size
    // Place the image on the background image
    imagealphablending($bg, false);
    imagesavealpha($bg, true);
    imagecopyresampled ($bg, $image,
      self::$QUEST_INNERIMAGE["offsetX"],
      self::$QUEST_INNERIMAGE["offsetY"],
      self::$QUEST_INNERIMAGE["x"],
      self::$QUEST_INNERIMAGE["y"],
      self::$QUEST_INNERIMAGE["width"],
      self::$QUEST_INNERIMAGE["height"],
      $imageInfo[1], // Flipped because we rotated the image
      $imageInfo[0]);// Flipped because we rotated the image
    imagealphablending($bg, true);

    // Place the foreground image on the background image
    imagecopy($bg, $fg, 0, 0, 0, 0, $fgInfo[0], $fgInfo[1]);

    // Place the name
    imagefttext($bg,
      self::$QUEST_NAMETEXT["fontsize"],
      self::$QUEST_NAMETEXT["rotation"],
      self::$QUEST_NAMETEXT["x"],
      self::$QUEST_NAMETEXT["y"],
      imagecolorexact($bg, 0, 0, 0), self::FONTFILE, $this->name);

    // Place the Turn Count
    imagefttext($bg,
      self::$QUEST_TURNCOUNT["fontsize"],
      self::$QUEST_TURNCOUNT["rotation"],
      self::$QUEST_TURNCOUNT["x"],
      self::$QUEST_TURNCOUNT["y"],
      imagecolorexact($bg, 0xFF, 0xFF, 0xFF), self::FONTFILE, $this->turnCount);

    //  Place the Quest Points
    $questPointText = $this->questPoints . ' QP';
    $dimensions = imagettfbbox(
      self::$QUEST_QUESTPOINTS["fontsize"],
      0, 
      self::FONTFILE, 
      $questPointText);
    $textWidth = abs($dimensions[2]); // Really, the text "height"

    imagefttext($bg,
      self::$QUEST_QUESTPOINTS["fontsize"],
      self::$QUEST_QUESTPOINTS["rotation"],
      self::$QUEST_QUESTPOINTS["x"],
      self::$QUEST_QUESTPOINTS["y"] - $textWidth,
      imagecolorexact($bg, 0, 0, 0), self::FONTFILE, 
      $questPointText);

    // TODO Place the effect
    // -- Break the effect up into manageable lines
    $temp = imagecreatetruecolor ( 
      self::$OUTERIMAGE["width"],
      self::$OUTERIMAGE["height"]);
    imagesavealpha($temp, true);

    $trans = imagecolorallocatealpha($temp, 0xFF, 0xFF, 0xFF, 127);
    imagefill($temp, 0, 0, $trans);

    $this->imagettftextjustified($temp,
      self::$QUEST_EFFECTTEXT["fontsize"],
      self::$QUEST_EFFECTTEXT["rotation"],
      self::$QUEST_EFFECTTEXT["x"],
      self::$QUEST_EFFECTTEXT["y"],
      imagecolorexact($temp, 0, 0, 0),
      self::FONTFILE,
      $this->condition . " \n \n " . $this->effect,
      self::$QUEST_EFFECTTEXT["width"],
      self::$QUEST_EFFECTTEXT["minspacing"],
      self::$QUEST_EFFECTTEXT["linespacing"],
      true);
    $temp = imagerotate($temp, -90, imagecolorexact($bg, 0, 0, 0));

    imagecopy($bg, $temp, -700, -90, 0, 0, self::$OUTERIMAGE["height"],self::$OUTERIMAGE["width"]
      );

    // TODO Place the Prize and Penalty

    // Place the Codes
    $color = imagecolorexact($bg, 0, 0, 0);
    $this->generateCopywrite($bg, $color, true);
    $this->generateCardCode($bg, $color, true, $this->setPrefix, $this->languagePrefix, $this->cardNumber);

    // Return the created image
    return $bg;
  }
}

?>
