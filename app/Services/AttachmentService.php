<?php

namespace App\Services;

use App\DTOs\Result;
use App\Models\Attachment;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile as HttpFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class AttachmentService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'name',
        'mime_type',
        'path'
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'name',
        'mime_type',
        'path',
    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['name'];

    /**
     *
     */
    protected array $with = [];


    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Attachment::query();
    }

    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }

    /**
     *
     * @throws Exception
     */
    public function create(array $attributes): Result
    {
        $upload = $attributes["attachment"];
        $attributes['mime_type'] = $upload->getMimeType();
        $dir = 'attachment';

        try {
            $attributes['path'] = $upload->store($dir);
            $name = explode('/', $attributes['path']);
            $attributes['name'] = last($name);
        } catch (Throwable $th) {
            throw new Exception('files:upload:errors:failed:' . $th->getMessage());
        }
        return $this->ok($this->store($attributes), 'files:upload:succeeded');
    }
    public function save($id, array $attributes): Result
    {
        $upload = $attributes["attachment"];
        $attributes['mime_type'] = $upload->getMimeType();
        $dir = 'attachment';

        try {
            $attributes['path'] = $upload->store($dir);
            $name = explode('/', $attributes['path']);
            $attributes['name'] = last($name);
        } catch (Throwable $th) {
            throw new Exception('files:upload:errors:failed:' . $th->getMessage());
        }
        return parent::save($id, $attributes);
    }


    /**
     *
     * @throws Exception
     */
    public function upload(HttpFile $upload): Result
    {
        return $this->ok($this->store((array)$upload), 'files:upload:succeeded');
    }


    /**
     * @throws Exception
     */
    public function download(string $name): StreamedResponse
    {
        $file = Attachment::query()->where('name', $name)->first();
        if ($file instanceof Attachment) {
            return Storage::download($file->path);
        } else {
            $name = "rbFOtu4Wmx3ieQ9cEU0WHYO2JZMwbQdV0TmRsE5n.jpg";
            $file = Attachment::query()->where('name', $name)->first();
            if ($file instanceof Attachment) {
                return Storage::download($file->path);
            }
        }
        throw new Exception('files:download:errors:not_found');
    }
}
