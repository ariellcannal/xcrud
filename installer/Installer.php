<?php
namespace CANNALxcrud;

use Composer\Script\Event;

class Installer
{

    public static function postInstall(Event $event)
    {
        $vendorDir = dirname(dirname(__DIR__)); // raiz do projeto principal
        $sourceDir = __DIR__ . '/../'; // raiz da lib

        $map = [
            'app/Config' => 'app/Config',
            'app/Controller' => 'app/Controller',
            'app/Libraries' => 'app/Libraries',
            'app/Models' => 'app/Models',
            'app/Views' => 'app/Views',
            'public/css' => 'public/css',
            'public/js' => 'public/js'
        ];

        foreach ($map as $src => $dst) {
            $fullSrc = realpath($sourceDir . $src);
            $fullDst = $vendorDir . '/' . $dst;

            if (! is_dir($fullSrc)) {
                continue;
            }

            self::recursiveCopy($fullSrc, $fullDst);
            echo "✔ Copiado: $src → $dst\n";
        }
    }

    private static function recursiveCopy($source, $dest)
    {
        $dir = new \RecursiveDirectoryIterator($source, \FilesystemIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($dir, \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($it as $file) {
            $targetPath = $dest . DIRECTORY_SEPARATOR . $it->getSubPathName();
            if ($file->isDir()) {
                if (! is_dir($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }
            } else {
                copy($file, $targetPath);
            }
        }
    }
}
