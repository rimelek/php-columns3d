<?php

/**
 * @author Takács Ákos
 * @copyright 2008
 */

class Graf 
{
	
	var $source;
	var $default_color;
	var $height = 0;
	var $width = 0;
	
	/*
	 *  Adott méretű kép létrehozása
	 */
	function Graf($width,$height)
	{
		header('Content-type: image/png');
		/*-----------------------------------*/
		$this->width = $width;
		$this->height = $height;

		$this->source = imagecreatetruecolor($width,$height);
		$this->default_color = imagecolorallocate($this->source,0,20,30);
		imagefill($this->source,0,0,$this->default_color);
	}

	/*
	 * Egy oszlop létrehozása
	 */
	function oszlop($R,$height,$start_x,$start_y,$nezet_szorzo = 1) {
		
		$color = imagecolorallocate($this->source,0,0,255);

		$szineltol = 255 / (2*$R);

		$red = 0;
		for($i=0-$R;$i<=$R;$i++) {
			$coord_x = $start_x + $i;
			$alfa = acos($i/$R);
			$y_color = $start_y + (sin($alfa) * $R)*$nezet_szorzo;
			$coord_y = $start_y + (-sin($alfa) * $R)*$nezet_szorzo;
			$coord_y2 = $coord_y + $height;
	
			$red += $szineltol;
			$color_line = imagecolorallocate($this->source,round($red),-$y_color ,255);
			imageline($this->source,$coord_x,$coord_y,$coord_x,$coord_y2,$color_line);
		}

	/*---------------------------------------------------*/
		$red = 0;
		for($i=0-$R;$i<=$R;$i++) {
			$coord_x = $start_x + $i;
			$alfa = acos($i/$R);
			$coord_y = $start_y + (sin($alfa) * $R)*$nezet_szorzo;
			$coord_y2 = $coord_y + $height;
	
			$red += $szineltol;
			$color_line = imagecolorallocate($this->source,round($red),$coord_y,255);
			imageline($this->source,$coord_x,$coord_y,$coord_x,$coord_y2,$color_line);
		}
	}

	/*
	 * Oszlopok kirajzolása körben. 
	 */
	function oszlopok($R,$start_x,$start_y,$nezet_szorzo = 1,$nezet_szorzo2=1)
	{
		for($alfa=210;$alfa<=360;$alfa += 20) {
			$coord_x = $start_x + (cos(deg2rad($alfa)) * $R);
			$coord_y = $start_y + (sin(deg2rad($alfa)) * $R) * $nezet_szorzo;
			$color = imagecolorallocate($this->source,0,0,255);
			imagesetpixel($this->source,$coord_x,$coord_y,$color);
			$this->oszlop(10,100,$coord_x,$coord_y,$nezet_szorzo2);
		}		

		for($alfa=0;$alfa<=160;$alfa += 20) {
			$coord_x = $start_x + (cos(deg2rad($alfa)) * $R);
			$coord_y = $start_y + (sin(deg2rad($alfa)) * $R) * $nezet_szorzo;
			$color = imagecolorallocate($this->source,0,0,255);
			imagesetpixel($this->source,$coord_x,$coord_y,$color);
			$this->oszlop(10,100,$coord_x,$coord_y,$nezet_szorzo2);
		}
	}

	/*
	 * Háttér megrajzolása
	 */
	function set_background()
	{
		$blue = 200;
		$red = 0;
		$green = 20;
		
		$offset = 255 / 2*$this->width;
		
		for($i=0;$i<=4*$this->height;$i++) {
			$x1 = 0;
			$y1 = (0-$this->height)+ $i;
			$x2 = $this->width;
			$y2 = $y1+$this->height;
						
			$color = imagecolorallocate($this->source,$red,$green,$blue);
			imageline($this->source,$x1,$y1,$x2,$y2,$color);
			$red = $red+$offset;
		}
	}

}
$graf = new Graf(400,400);
/**********************************************************/
$graf->set_background();
$graf->oszlop(130,300,200,300,2/8);
$graf->oszlopok(110,200,200,2/8,2/6);
$graf->oszlop(130,400,200,-200,2/8);
/*--------------------------------------------------------*/
imagepng($graf->source);
?>
