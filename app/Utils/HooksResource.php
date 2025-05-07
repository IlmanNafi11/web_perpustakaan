<?php
namespace App\Utils;

use App\Models\MediaFile;
use \Exception;
class HooksResource
{
    /**
     * Menyimpan path file media(cover atau pdf) buku fisik atau ebook kedalam table media_files
     *
     * @param array $data path file
     * @param string $foreignId id buku terkait
     * @param string $mediaType tipe media (cover image atau ebook file)
     * @return void
     */
    public static function InsertPathFileToMediaFiles(array $data, string $foreignId, string $mediaType = 'cover image')
    {
        $path = reset($data);
        $mediaFiles = MediaFile::create([
            'book_id' => $foreignId,
            'media_type' => $mediaType,
            'file_path' => $path,
        ]);
        $mediaFiles->save();
    }

    /**
     * Memperbarui path file media (cover atau pdf) buku atau ebook terkait di table media_files
     *
     * @param array $data path file
     * @param array $condition kondisi untuk membangun query. bersifat wajib, jika tidak dapat menyebabkan memperbarui seluruh data!
     * @param array $value data tambahan yang ingin disimpan ke database (opsional)
     * @throws \Exception exception ketika @var condition bernilai null/kosong
     * @return int
     */
    public static function UpdatePathFileInMediaFiles(array $data, array $condition, array $value = [])
    {
        $path = reset($data);
        $updateValues = array_merge($value, ['file_path' => $path]);

        $query = MediaFile::query();

        if (!empty($condition)) {
            foreach ($condition as $column => $value) {
                $query->where($column, $value);
            }
        } else {
            throw new Exception('The condition value cannot be empty');
        }

        return $query->update($updateValues);
    }
}
