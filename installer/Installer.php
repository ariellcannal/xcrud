<?php

namespace CANNALxcrud;

use Composer\Script\Event;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;

class Installer
{
    public static function postInstall(?Event $event = null): void
    {
        // Caminho correto da raiz do projeto principal (subir 4 níveis)
        $projectRoot = dirname(__DIR__, 4);
        $xcrudRoot = dirname(__DIR__, 1);
        
        echo "Raiz do projeto: $projectRoot\n";
        echo "Raiz do XCRUD: $xcrudRoot\n";
        
        $map = [
            'app/Config'      => 'app/Config',
            'app/Controller'  => 'app/Controller',
            'app/Libraries'   => 'app/Libraries',
            'app/Models'      => 'app/Models',
            'app/Views'       => 'app/Views',
            'public/css'      => 'public/css',
            'public/js'       => 'public/js'
        ];
        
        foreach ($map as $src => $dest) {
            $srcPath = realpath($xcrudRoot . '/' . $src);
            $destPath = $projectRoot . '/' . $dest;
            
            echo "🔍 Verificando: $srcPath → $destPath\n";
            
            if (!$srcPath || !is_dir($srcPath)) {
                echo "⚠️ Pasta não encontrada: $srcPath\n";
                continue;
            }
            
            self::recursiveCopy($srcPath, $destPath);
            echo "✅ Finalizado: $src → $dest\n";
        }
        
        echo "✅ Instalação da XCRUD concluída.\n";
    }
    
    private static function recursiveCopy(string $source, string $destination): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
            );
        
        foreach ($iterator as $item) {
            $targetPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            $sourcePath = $item->getPathname();
            
            echo "📁 Copiando: $sourcePath → $targetPath\n";
            
            if ($item->isDir()) {
                if (!is_dir($targetPath) && !mkdir($targetPath, 0755, true)) {
                    echo "❌ Erro ao criar diretório: $targetPath\n";
                }
            } else {
                if (!is_dir(dirname($targetPath))) {
                    mkdir(dirname($targetPath), 0755, true);
                }
                
                if (!copy($sourcePath, $targetPath)) {
                    echo "❌ Erro ao copiar: $sourcePath → $targetPath\n";
                } else {
                    echo "📄 Copiado: $targetPath\n";
                }
            }
        }
    }
}
