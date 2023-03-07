<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\File as SymfonyConstraintsFile;

class File extends SymfonyConstraintsFile
{
    public $notFoundMessage = 'Файл не найден';
    public $notReadableMessage = 'Файл нечитаем';
    public $maxSizeMessage = 'Размер файла не должен превышать 10.24 Мб';
    public $mimeTypesMessage = 'Допустимые расширения: jpg/jpeg, png, tiff, gif, sig, pdf, doc/docx';
    public $disallowEmptyMessage = 'Пустой файл недопустим';

    public $uploadIniSizeErrorMessage = 'Файл слишком большой для выгрузки. Дозволенный размер файла: {{ limit }} {{ suffix }}';
    public $uploadFormSizeErrorMessage = 'Файл слишком большой';
    public $uploadPartialErrorMessage = 'Файл может быть выгружен только частично';
    public $uploadNoFileErrorMessage = 'Не один файл не был выгружен';
    public $uploadNoTmpDirErrorMessage = 'Времнный файл не был определен в конфигурации php.ini';
    public $uploadCantWriteErrorMessage = 'Не возможно записать временный файл на диск';
    public $uploadExtensionErrorMessage = 'Расширение PHP вызволо ошибку';
    public $uploadErrorMessage = 'Файл не может быть выгружен';

}
