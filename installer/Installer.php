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
        // Caminho da raiz do projeto principal (vendor/ariellcannal/xcrud/installer → volta 3 níveis)
        $projectRoot = dirname(__DIR__, 3);
        
        // Caminho da raiz da lib XCRUD
        $xcrudRoot = dirname(__DIR__, 1);
        
        // Mapear diretórios da lib XCRUD para as pastas do projeto principal
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
            
            echo "🔄 Copiando de $srcPath para $destPath...\n";
            self::recursiveCopy($srcPath, $destPath);
            echo "✅ Finalizado: $src → $dest\n";
        }
        
        echo "✔️ Instalação XCRUD finalizada.\n";
    }
    
    /**
     * Copia arquivos e diretórios recursivamente com feedback de erros.
     */
    private static function recursiveCopy(string $source, string $destination): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
            );
        
        foreach ($iterator as $item) {
            $targetPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            $sourcePath = $item->getPathname();
            
            if ($item->isDir()) {
                if (!is_dir($targetPath)) {
                    if (!mkdir($targetPath, 0755, true)) {
                        echo "❌ Erro ao criar diretório: $targetPath\n";
                    }
                }
            } else {
                if (!is_dir(dirname($targetPath))) {
                    mkdir
                    