<?php

namespace App\Filament\Resources\BookResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\BookResource;
use Filament\Resources\Pages\EditRecord;
use App\Utils\HooksResource;

class EditBook extends EditRecord
{
    protected static string $resource = BookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        HooksResource::UpdatePathFileInMediaFiles($this->data['cover'], ['book_id' => $this->record->id, 'media_type' => 'cover image']);

        if (isset($this->data['ebook']) && !empty($this->data['ebook'])) {
            HooksResource::UpdatePathFileInMediaFiles($this->data['ebook'], ['book_id' => $this->record->id, 'media_type' => 'ebook file']);
        }
    }
}
