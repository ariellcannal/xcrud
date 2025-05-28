<?php

namespace CANNALxcrud;

use Composer\Script\Event;

class Installer
{
    /**
     * Executado após o install ou update do Composer no projeto principal.
     * Copia arquivos da lib XCRUD para dentro da estrutura do projeto.
     */
    public static function postInstall(?Event $event = null): void
    {
        // Caminho do projeto que está usando a biblioteca
        $projectRoot = dirname(__DIR__, 4);
        
        // Caminho da raiz da biblioteca XCRUD
        $xcrudRoot = dirname(__DIR__, 2);
        
        // Mapeamento dos diretórios que serão copiados
        $map = [
            'app/Config'      => 'app/Config',
            'app/Controller'  => 'app/Controller',
            'app/Libraries'   => 'app/Libraries',
            'app/Models'      => 'app/Models',
            'app/Views'       => 'app/Views',
            'public/css'      => 'public/css',
            'public/js'       => 'public/js',
        ];
        
        foreach ($map as $src => $dest) {
            $srcPath = realpath($xcrudRoot . '/' . $src);
            $destPath = $projectRoot . '/' . $dest;
            
            if (!$srcPath || !is_dir($srcPath)) {
                echo "⚠️ Pasta não encontrada: $srcPath\n";
                continue;
            }
            
            self::recursiveCopy($srcPath, $destPath);
            echo "✔ Copiado: $src → $dest\n";
        }
    }
    
    /**
     * Copia arquivos e pastas recursivamente.
     */
    private static function recursiveCopy(string $source, string $destination): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
            );
        
        foreach ($iterator as $item) {
            $targetPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            
            if ($item->isDir()) {
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }
            } else {
                if (!is_dir(dirname($targetPath))) {
                    mkdir(dirname($targetPath), 0755, true);
                }
                copy($item->getPathname(), $targetPath);
            }
        }
    }
}
