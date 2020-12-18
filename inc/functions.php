
<?php
/*
When i was trying to learn about 
how to aporach this task i stumbled across some functions around the web
that "scan the image" so i have wrote my own function. it is a combination of diffrent functinos
following the same logic of looping through the x axis and than the y axis
solutions i found on the web
*/

/**
 * This function compiles a message that tells you how great coffee is
 *
 * @param string  $image image name
 * @param integer $pixel_to_skip how many pixels to skip
 * @return array  $colors_arr arry of all the colors in the image and the amount of pixels in that color
 */


function get_colors($image, $pixel_skip = 1)
{
   $colors_arr = [];

   //    took this method for php.net
   $size = getimagesize($image);
   $width = $size[0];
   $height = $size[1];

   // took this code from php.net i wanted to know how to support all the files
   $image = imagecreatefromstring(file_get_contents($image));
   $total_pixels = $width * $height;

   for ($x = 0; $x < $size[0]; $x += $pixel_skip) {

      for ($y = 0; $y < $size[1]; $y += $pixel_skip) {

         //   learned this two methods from php.net
         $pixel_color = imagecolorat($image, $x, $y);
         $rgb_arr = imagecolorsforindex($image, $pixel_color);

         //  this code is from stackoverflow i wasn't familier with how to convert the RGB to Hexa
         $red = round(round(($rgb_arr['red'] / 0x33)) * 0x33);
         $green = round(round(($rgb_arr['green'] / 0x33)) * 0x33);
         $blue = round(round(($rgb_arr['blue'] / 0x33)) * 0x33);
         $color_value_hexa = sprintf('%02X%02X%02X', $red, $green, $blue);

         // i'm checking that the hex color is in the the arr since we defined it as a key we use the array_key_exists
         if (array_key_exists($color_value_hexa, $colors_arr)) {
            $colors_arr[$color_value_hexa]++;
         } else {
            // i put every color as an index
            $colors_arr[$color_value_hexa] = 1;
         }
      }
   }
   arsort($colors_arr);
   return $colors_arr;
}

