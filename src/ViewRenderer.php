<?php
namespace paw\twig;

use Yii;

class ViewRenderer extends \yii\twig\ViewRenderer
{
    protected function addFallbackPaths($loader, $theme)
    {
        foreach ($this->twigFallbackPaths as $namespace => $paths) {
            $paths = is_array($paths) ? $paths : [$paths];
            foreach ($paths as $path) {
                $path = Yii::getAlias($path);
                if (!is_dir($path)) {
                    continue;
                }

                if (is_string($namespace)) {
                    $loader->addPath($path, $namespace);
                } else {
                    $loader->addPath($path);
                }
            }
        }

        if ($theme instanceof \yii\base\Theme && is_array($theme->pathMap)) {
            $pathMap = $theme->pathMap;

            if (isset($pathMap['@app/views'])) {
                foreach ((array) $pathMap['@app/views'] as $path) {
                    $path = Yii::getAlias($path);
                    if (is_dir($path)) {
                        $loader->addPath($path, $this->twigViewsNamespace);
                    }
                }
            }

            if (isset($pathMap['@app/modules'])) {
                foreach ((array) $pathMap['@app/modules'] as $path) {
                    $path = Yii::getAlias($path);
                    if (is_dir($path)) {
                        $loader->addPath($path, $this->twigModulesNamespace);
                    }
                }
            }

            if (isset($pathMap['@app/widgets'])) {
                foreach ((array) $pathMap['@app/widgets'] as $path) {
                    $path = Yii::getAlias($path);
                    if (is_dir($path)) {
                        $loader->addPath($path, $this->twigWidgetsNamespace);
                    }
                }
            }
        }

        $defaultViewsPath = Yii::getAlias('@app/views');
        if (is_dir($defaultViewsPath)) {
            $loader->addPath($defaultViewsPath, $this->twigViewsNamespace);
        }

        $defaultModulesPath = Yii::getAlias('@app/modules');
        if (is_dir($defaultModulesPath)) {
            $loader->addPath($defaultModulesPath, $this->twigModulesNamespace);
        }

        $defaultWidgetsPath = Yii::getAlias('@app/widgets');
        if (is_dir($defaultWidgetsPath)) {
            $loader->addPath($defaultWidgetsPath, $this->twigWidgetsNamespace);
        }
    }
}
