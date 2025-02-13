<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use App\Models\Book;
use App\Models\MediaFile;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $cover = $this->data['cover'];
        $pathCover = reset($cover);
        DB::table('media_files')->insert([
            'book_id' => $this->record->id,
            'media_type' => 'cover image',
            'file_path' => $pathCover,
        ]);
    }

}
