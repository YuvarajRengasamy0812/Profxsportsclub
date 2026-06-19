<?php
namespace App\Services;

class CertificateService
{
public function generateCertificate($name, $regdate)
{
    $rootPath = dirname(base_path());

    $imagePath = $rootPath . '/assets/certificates/certificate_of_registration.png';
    $font = $rootPath . '/assets/certificates/font/Lora-Regular.ttf';

    if (!file_exists($imagePath) || !file_exists($font)) {
        throw new \Exception("Certificate template or font not found.");
    }

    $image = imagecreatefrompng($imagePath);
    imagealphablending($image, true);
    imagesavealpha($image, true);

    // Colors
    $nameColor = imagecolorallocate($image, 0, 0, 0);
    $shadowColor = imagecolorallocate($image, 50, 50, 100);
    $dateColor = imagecolorallocate($image, 50, 50, 100);

    $fontSizeName = 50;
    $fontSizeDate = 40;
    $shadowOffset = 3;

    $imageWidth = imagesx($image);

    $name = strtoupper($name);
    $date = '10-09-2025';
    $date_sec = "08-10-2025";

    // Centered name
    $bbox = imagettfbbox($fontSizeName, 0, $font, $name);
    $textWidth = abs($bbox[2] - $bbox[0]);
    $x = ($imageWidth - $textWidth) / 2;
    $y = 700;

    // Date coordinates
    $xDate = 830;
    $yDate = 790;

     // Date coordinates
    $xDate2= 1430;
    $yDate2 = 800;

    // Draw name
    imagettftext($image, $fontSizeName, 0, $x + $shadowOffset, $y + $shadowOffset, $shadowColor, $font, $name);
    imagettftext($image, $fontSizeName, 0, $x, $y, $nameColor, $font, $name);

    // Draw date
    imagettftext($image, $fontSizeDate, 0, $xDate, $yDate, $dateColor, $font, $regdate);
    imagettftext($image, $fontSizeDate, 0, $xDate2, $yDate2, $dateColor, $font, $date_sec);

    // Save
    $dir = $rootPath . '/assets/certificates/download_certificate';
    if (!file_exists($dir)) mkdir($dir, 0777, true);

    $fileName = "certificate_" . time() . ".png";
    $filePath = "$dir/$fileName";
    imagepng($image, $filePath);
    imagedestroy($image);

    return 'assets/certificates/download_certificate/' . $fileName;
}




}
