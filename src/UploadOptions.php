<?php

namespace Padosoft\Uploadable;

use Padosoft\Io\DirHelper;

class UploadOptions
{
    /**
     * upload Create Dir Mode file Mask (default '0755')
     * @var string
     */
    public $uploadCreateDirModeMask = '0755';

    /**
     * If set to true, a $model->uploadFileNameSuffixSeparator.$model->id suffx are added to upload file name.
     * Ex.:
     * original uploaded file name: pippo.jpg
     * final name: 'pippo'.$model->uploadFileNameSuffixSeparator.$model->id.'jpg'
     * @var bool
     */
    public $appendModelIdSuffixInUploadedFileName = true;

    /**
     * Suffix separator to generate new file name
     * @var string
     */
    public $uploadFileNameSuffixSeparator = '_';

    /**
     * Array of upload attributes
     * Ex.:
     * public $uploads = ['image', 'image_mobile'];
     * @var array
     */
    public $uploads = [];

    /**
     * Array of Mime type string.
     * Ex. (default):
     * public $uploadsMimeType = [
     * 'image/gif',
     * 'image/jpeg',
     * 'image/png',
     * ];
     * A full listing of MIME types and their corresponding extensions may be found
     * at the following location: http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
     * @var array
     */
    public $uploadsMimeType = [
        'image/gif',
        'image/jpeg',
        'image/png',
    ];

    /**
     * upload base path.
     * default: public/model->table
     * @var string
     */
    public $uploadBasePath;

    /**
     * An associative array of 'attribute_name' => 'uploadBasePath'
     * set an attribute name here to override its default upload base path
     * The path is relative to public_folder() folder.
     * Ex.:
     * public $uploadPaths = ['image' => 'product', 'image_thumb' => 'product/thumb'];
     * @var array
     */
    public $uploadPaths = [];


    /**
     * @return UploadOptions
     */
    public static function create(): UploadOptions
    {
        return new static();
    }

    /**
     * upload Create Dir Mode file Mask (Ex.: '0755')
     * @param string $mask
     * @return UploadOptions
     */
    public function setCreateDirModeMask(string $mask): UploadOptions
    {
        $this->uploadCreateDirModeMask = $mask;

        return $this;
    }

    /**
     * $model->uploadFileNameSuffixSeparator.$model->id suffx are added to upload file name.
     * Ex.:
     * original uploaded file name: pippo.jpg
     * final name: 'pippo'.$model->uploadFileNameSuffixSeparator.$model->id.'jpg'
     */
    public function appendModelIdSuffixInFileName(): UploadOptions
    {
        $this->appendModelIdSuffixInUploadedFileName = true;

        return $this;
    }

    /**
     */
    public function dontAppendModelIdSuffixInFileName(): UploadOptions
    {
        $this->appendModelIdSuffixInUploadedFileName = false;

        return $this;
    }

    /**
     * Suffix separator to generate new file name
     * @param string $suffix
     * @return UploadOptions
     */
    public function setFileNameSuffixSeparator(string $suffix): UploadOptions
    {
        $this->uploadFileNameSuffixSeparator = $suffix;

        return $this;
    }

    /**
     * Array of upload attributes
     * Ex.: ['image', 'image_mobile'];
     * @param array $attributes
     * @return UploadOptions
     */
    public function setUploadsAttributes(array $attributes): UploadOptions
    {
        $this->uploads = $attributes;

        return $this;
    }

    /**
     * Array of Mime type string.
     * Ex.:
     * [
     * 'image/gif',
     * 'image/jpeg',
     * 'image/png',
     * ];
     * A full listing of MIME types and their corresponding extensions may be found
     * at the following location: http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
     * @param array $mime
     * @return UploadOptions
     */
    public function setMimeType(array $mime): UploadOptions
    {
        $this->uploadsMimeType = $mime;

        return $this;
    }

    /**
     * upload base path.
     * Ex.: public/upload/news
     * @param string $path
     * @return UploadOptions
     */
    public function setUploadBasePath(string $path): UploadOptions
    {
        $this->uploadBasePath = DirHelper::canonicalize($path);

        return $this;
    }

    /**
     * An associative array of 'attribute_name' => 'uploadBasePath'
     * set an attribute name here to override its default upload base path
     * The path is absolute or relative to public_folder() folder.
     * Ex.:
     * public $uploadPaths = ['image' => 'product', 'image_thumb' => 'product/thumb'];
     * @param array $attributesPaths
     * @return UploadOptions
     */
    public function setUploadPaths(array $attributesPaths): UploadOptions
    {
        array_map(function ($v) {
            return $v == '' ? $v : DirHelper::canonicalize($v);
        }, $attributesPaths);

        $this->uploadPaths = $attributesPaths;

        return $this;
    }

    /**
     * Get the options for generating the upload.
     */
    public function getUploadOptionsDefault(): UploadOptions
    {
        return UploadOptions::create()
            ->setCreateDirModeMask('0755')
            ->appendModelIdSuffixInFileName()
            ->setFileNameSuffixSeparator('_')
            ->setUploadsAttributes(['image', 'image_mobile'])
            ->setMimeType([
                'image/gif',
                'image/jpeg',
                'image/png',
            ])
            ->setUploadBasePath(public_path('upload/'))
            ->setUploadPaths([]);
    }
}
