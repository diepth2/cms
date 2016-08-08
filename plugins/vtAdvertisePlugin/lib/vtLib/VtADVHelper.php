<?php
/**
 * Description of VtHelper
 * @author pmdv_hoannv13
 */
class VtADVHelper
{
	/**
	 * Ham tra ve duong dan theo ngay thang nam
	 * @param string $path
	 */
  public static function generatePath($path = '', $byDate = true)
  {
    if ($byDate)
    {
      if ($path)
        $folder = '/medias/' . $path . '/' . date('Y') . '/' . date('m') . '/' . date('d') . "/";
      else
        $folder = '/medias/' . date('Y') . '/' . date('m') . '/' . date('d') . "/";
    } else
    {
      $folder = '/medias/'. $path. '/';
    }


    $fullDir = sfConfig::get('sf_web_dir') . $folder;
    if (!is_dir($fullDir)) {
      @mkdir($fullDir, 0777, true);
    }

    return $folder;
  }

  /**
   * Lay link anh thumbnail<br />
   * Vi du su dung:<br />
   * <img src="<?php VtHelper::getThumbUrl('/medias/huypv/2011/06/15/abc.jpg', 90, 60); ?>" />
   *
   * Sua bo sung them domain media de tach server media rieng
   * @modified by NamDT5
   * @modified on 10/01/2013
   * @param string $source /medias/huypv/2011/06/15/abc.jpg (nam trong thu muc web!)
   * @author huypv
   * @param int $width
   * @param int $height
   * @return string /medias/huypv/2011/06/15/thumbs/abc_90_60.jpg
   */
  public static function getThumbUrl($source, $width = null, $height = null, $type = '')
  {

    switch ($type)
    {
      case 'app':
        $defaultImage = sfConfig::get('app_app_image_default');
        break;
      default:
        $defaultImage = sfConfig::get('app_image_default');
    }

    if ($width == null && $height == null)
      return (file_exists(sfConfig::get('sf_web_dir') . $source)) ? sfConfig::get('app_medias_domain', ''). $source : sfConfig::get('app_medias_domain', ''). $defaultImage;
    if (empty($source)) {
      return sfConfig::get('app_medias_domain', ''). $defaultImage;
    }

    $mediasDir = sfConfig::get('sf_web_dir');

    $fullPath = $mediasDir . $source;
    $pos = strrpos($source, '/');
    if ($pos !== false) {
      $filename = substr($source, $pos + 1);
      $dir = '/cache' .'/'. substr($source, 1, $pos);

    } else {
      return sfConfig::get('app_medias_domain', ''). $defaultImage;
      #return false;
    }

    $pos = strrpos($filename, '.');
    if ($pos !== false) {
      $basename = substr($filename, 0, $pos);
      $extension = substr($filename, $pos + 1);
    } else {
      return sfConfig::get('app_medias_domain', ''). $defaultImage;
      #return false;
    }

    if ($width == null) {
      $thumbName = $basename . '_auto_' . $height . '.' . $extension;
    } else if ($height == null) {
      $thumbName = $basename . '_' . $width . '_auto.' . $extension;
    } else {
      $thumbName = $basename . '_' . $width . '_' . $height . '.' . $extension;
    }

    $fullThumbPath = $mediasDir . $dir . $thumbName;

    # Neu thumbnail da ton tai roi thi khong can generate
    if (file_exists($fullThumbPath)) {
      return sfConfig::get('app_medias_domain', ''). $dir . $thumbName;
    }

    # Neu thumbnail chua ton tai thi su dung plugin de tao ra
    $scale = ($width != null && $height != null) ? false : true;
    $thumbnail = new sfThumbnail($width, $height, $scale, true, 100);
    if (!is_file($fullPath)) {
      return sfConfig::get('app_medias_domain', ''). $defaultImage;
    }
    $thumbnail->loadFile($fullPath);

    if (!is_dir($mediasDir . $dir)) mkdir($mediasDir . $dir, 0777, true);
    $thumbnail->save($fullThumbPath, 'image/jpeg');
    return (file_exists(sfConfig::get('sf_web_dir') . $dir . $thumbName)) ? sfConfig::get('app_medias_domain', ''). $dir . $thumbName : sfConfig::get('app_medias_domain', ''). $defaultImage;

  }
}