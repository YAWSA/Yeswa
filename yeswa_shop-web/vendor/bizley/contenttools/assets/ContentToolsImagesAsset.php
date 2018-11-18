<?php
namespace bizley\contenttools\assets;

use yii\web\AssetBundle;

/**
 *
 * @author Paweł Bizley Brzozowski
 * @version 1.0
 * @license Apache 2.0
 *          https://github.com/bizley-code/yii2-content-tools
 *          http://www.yiiframework.com/extension/yii2-content-tools
 *         
 *          ContentTools was created by Anthony Blackshaw
 *          http://getcontenttools.com/
 *          https://github.com/GetmeUK/ContentTools
 *         
 *          Default js for the images engine.
 */
class ContentToolsImagesAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/bizley/contenttools/js';

    /**
     * @inheritdoc
     */
    public $js = [
        'content-tools-images.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'bizley\contenttools\assets\ContentToolsAsset'
    ];
}