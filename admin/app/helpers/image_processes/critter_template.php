<?php
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  require_once 'image_template.php';

  class CritterTemplate extends ImageTemplate {
    protected $backgroundImagePath = '';
    protected $foregroundImagePath = '';
    protected $name = '';
    protected $effect = '';
    protected $strength = '';
    protected $setPrefix = '';
    protected $languagePrefix = '';
    protected $cardNumber = '';
    protected $imagePath = '';

    public function __construct($backgroundImagePath, $foregroundImagePath, $name, $effect, $strength, $setPrefix, $languagePrefix, $cardNumber, $imagePath) {
      $this->backgroundImagePath = ASSET_ROOT . '/chibi_critters_images/' . $backgroundImagePath;
      $this->foregroundImagePath = ASSET_ROOT . '/chibi_critters_images/' . $foregroundImagePath;
      $this->name = $name;
      $this->effect = $effect;
      $this->strength = $strength;
      $this->setPrefix = $setPrefix;
      $this->languagePrefix = $languagePrefix;
      $this->cardNumber = $cardNumber;
      $this->imagePath = ASSET_ROOT . $imagePath;
    }

    public function generateImage() {
      // Grab the background image
      $bg = imagecreatefrompng($this->backgroundImagePath);
      $bgInfo = getimagesize($this->backgroundImagePath);

      // Grab the foreground image
      $fg = imagecreatefrompng($this->foregroundImagePath);
      $fgInfo = getimagesize($this->foregroundImagePath);

      // Grab the image
      $image = imagecreatefrompng($this->imagePath);
      $imageInfo = getimagesize($this->imagePath);

      // Make sure the image is the correct size
      $image = imagescale ($image , 
        self::$INNERIMAGE["width"],
        self::$INNERIMAGE["height"],
        IMG_BILINEAR_FIXED);

      // Place the image on the background image
      imagealphablending($bg, true);
      imagesavealpha($bg, true);
      imagecopy($bg, $image,
        self::$INNERIMAGE["offsetX"],
        self::$INNERIMAGE["offsetY"],
        self::$INNERIMAGE["x"],
        self::$INNERIMAGE["y"],
        self::$INNERIMAGE["width"],
        self::$INNERIMAGE["height"]);

      // Place the foreground image on the background image
      imagecopy($bg, $fg, 0, 0, 0, 0, $fgInfo[0], $fgInfo[1]);

      // Place the name
      imagefttext($bg,
        self::$NAMETEXT["fontsize"],
        self::$NAMETEXT["rotation"],
        self::$NAMETEXT["x"],
        self::$NAMETEXT["y"],
        imagecolorexact($bg, 0, 0, 0), self::FONTFILE, $this->name);

      // Place the effect
      // -- Break the effect up into manageable lines
      $this->imagettftextjustified($bg,
        self::$EFFECTTEXT["fontsize"],
        self::$EFFECTTEXT["rotation"],
        self::$EFFECTTEXT["x"],
        self::$EFFECTTEXT["y"],
        imagecolorexact($bg, 0, 0, 0),
        self::FONTFILE,
        $this->effect,
        self::$EFFECTTEXT["width"],
        self::$EFFECTTEXT["minspacing"],
        self::$EFFECTTEXT["linespacing"]);

      // Draw the strength
      $strength = strtoupper('Strength') . ' - ' . $this->strength;
      $dimensions = imagettfbbox(18, 0, self::FONTFILE, $strength);
      $textWidth = abs($dimensions[4] - $dimensions[0]);

      imagefttext($bg, 16, 0, 712 - $textWidth, 988, imagecolorexact($bg, 0, 0, 0), self::FONTFILE, $strength);


      $color = imagecolorexact($bg, 0, 0, 0);

      $this->generateCopywrite($bg, $color, false);
      $this->generateCardCode($bg, $color, false, $this->setPrefix, $this->languagePrefix, $this->cardNumber);

      // Return the created image
      return $bg;
    }
  }

?>
