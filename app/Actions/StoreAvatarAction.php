<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Http\UploadedFile;

/**
 * @class App\Actions\StoreAvatarAction
 */
final class StoreAvatarAction
{
    /**
     * Сохранение аватара пользователя.
     *
     * Метод сохраняет файл и возвращает его путь.
     *
     * @param  UploadedFile  $file Изображение, которое нужно сохранить.
     * @param  string  $path Путь сохранения.
     * @param  string  $disk Диск, куда нужно сохранить.
     * @return string Строка с путем до файла.
     */
    public function __invoke(UploadedFile $file, string $path, string $disk = 'public'): string
    {
        return $file->store($path, $disk);
    }
}
