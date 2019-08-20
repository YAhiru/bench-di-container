<?php
declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

apcu_clear_cache();
(function (string $dir, array $ignoreFiles) {

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(
            $dir,
            FilesystemIterator::SKIP_DOTS|FilesystemIterator::CURRENT_AS_FILEINFO
        ),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach($iterator as $file){
        /** @var SplFileInfo $file */
        if ($file->isFile() && !in_array($file->getFilename(), $ignoreFiles, true)) {
            unlink($file->getRealPath());
        }
    }
})(__DIR__.'/tmp', ['.gitignore', '.', '..']);
