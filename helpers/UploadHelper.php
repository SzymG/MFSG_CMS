<?php
namespace app\helpers;

use Yii;

class UploadHelper {

	const UPLOAD_DIRECTORY = 'uploads';

	public static function getUploadPath() {
		$directory = dirname(\Yii::getAlias('@webroot')).DIRECTORY_SEPARATOR.self::UPLOAD_DIRECTORY;
		if(!file_exists($directory)) {
			@mkdir($directory);
		}
		
		return $directory;
	}
	
	public static function generatePath($extension) {
		$uploadPath = self::getUploadPath();
		
		do {
			$name = \Yii::$app->getSecurity()->generateRandomString(24) . '.' . $extension;
			$fullName = $uploadPath . DIRECTORY_SEPARATOR . $name;
		} while(file_exists($fullName));
		
		return ['name' => $name, 'fullName' => $fullName];
	}

    public static function saveTemporaryFile($uploadedFile) {
        $filePath = self::generatePath($uploadedFile->extension);
        $uploadedFile->saveAs($filePath['fullName']);

        return $filePath;
    }

    public static function copy($sourceFileHash) {
        $sourceFileAbsolutePath = self::getAbsolutePath($sourceFileHash);
        $sourceFileExtension = pathinfo($sourceFileAbsolutePath, PATHINFO_EXTENSION);

        $copyPath = self::generatePath($sourceFileExtension);
        copy($sourceFileAbsolutePath, $copyPath['fullName']);

        return $copyPath['name'];
    }

    public static function removeByUrl($fileUrl) {
        $fileName = self::getFileNameByUrl($fileUrl);

        $absolutePathToFile = rtrim(self::getUploadPath(), '/').'/'.$fileName;

        if(file_exists($absolutePathToFile)) {
            unlink($absolutePathToFile);
        }
    }

    public static function getFileNameByUrl($url) {
        $patternMatches = [];
        preg_match('|/index\?f=(.+)$|', $url, $patternMatches);

        return end($patternMatches);
    }

    public static function getAbsolutePath($fileHash) {
        return rtrim(self::getUploadPath(), '/').'/'.$fileHash;
    }
}
