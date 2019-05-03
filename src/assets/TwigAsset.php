<?php
namespace paw\twig\assets;

use yii\web\AssetBundle;

class TwigAsset extends AssetBundle
{
    public $depends = [
        \paw\assets\FontAwesomeAsset::class,
        \paw\bootstrap4\BootstrapAsset::class,
        \paw\webcomponent\WebComponentAsset::class,
    ];
}
