<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use App\Models\Book;
use App\Models\MediaFile;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use App\Utils\HooksResource;
class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $id = $this->record->id;
        if (isset($this->data['cover'])) {
            HooksResource::InsertPathFileToMediaFiles($this->data['cover'], $id, 'cover image');
        }

        if (isset($this->data['ebook'])) {
            HooksResource::InsertPathFileToMediaFiles($this->data['ebook'], $id, 'ebook file');
        }

    }

}
