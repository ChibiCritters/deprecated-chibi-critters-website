<?php
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  require_once 'image_template.php';

  class SabotageTemplate extends ImageTemplate {
    protected $backgroundImagePath = '';
    protected $foregroundImagePath = '';
    protected $name = '';
    protected $effect = '';
    protected $setPrefix = '';
    protected $languagePrefix = '';
    protected $cardNumber = '';
    protected $imagePath = '';
  
    public function __construct($backgroundImagePath, $foregroundImagePath, $name, $effect, $setPrefix, $languagePrefix, $cardNumber, $imagePath) {
      $this->backgroundImagePath = ASSET_ROOT . '/chibi_critters_images/' . $backgroundImagePath;
      $this->foregroundImagePath = ASSET_ROOT . '/chibi_critters_images/' . $foregroundImagePath;
      $this->name = $name;
      $this->effect = $effect;
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
      
      // Make sure the image is the correct size
      // Place the image on the background image
      imagealphablending($bg, false);
      imagesavealpha($bg, true);
      imagecopyresampled ($bg, $image,
        self::$INNERIMAGE["offsetX"],
        self::$INNERIMAGE["offsetY"],
        self::$INNERIMAGE["x"],
        self::$INNERIMAGE["y"],
        self::$INNERIMAGE["width"],
        self::$INNERIMAGE["height"],
        $imageInfo[0],
        $imageInfo[1]);
      imagealphablending($bg, true);
      
      // Place the foreground image on the background image
      imagecopy($bg, $fg, 0, 0, 0, 0, $fgInfo[0], $fgInfo[1]);
      
      // Place the name
      imagefttext($bg, 
        self::$NAMETEXT["fontsize"], 
        self::$NAMETEXT["rotation"], 
        self::$NAMETEXT["x"], 
        self::$NAMETEXT["y"], 
        imagecolorexact($bg, 0xFF, 0xFF, 0xFF), self::FONTFILE, $this->name);
      
      // Place the effect
      // -- Break the effect up into manageable lines
      $this->imagettftextjustified($bg, 
        self::$EFFECTTEXT["fontsize"], 
        self::$EFFECTTEXT["rotation"], 
        self::$EFFECTTEXT["x"], 
        self::$EFFECTTEXT["y"], 
        imagecolorexact($bg, 0xFF, 0xFF, 0xFF), 
        self::FONTFILE, 
        $this->effect, 
        self::$EFFECTTEXT["width"], 
        self::$EFFECTTEXT["minspacing"], 
        self::$EFFECTTEXT["linespacing"]);
      
      $color = imagecolorexact($bg, 0xFF, 0xFF, 0xFF);
      
      $this->generateCopywrite($bg, $color, false);
      $this->generateCardCode($bg, $color, false, $this->setPrefix, $this->languagePrefix, $this->cardNumber);
      
      // Return the created image
      return $bg;
    }
  }

?>