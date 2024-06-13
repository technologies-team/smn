<?php
namespace Tests\Feature;
use App\Services\AttachmentService;
use Exception;
use Illuminate\Http\UploadedFile as HttpFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tests\TestCase;

class AttachmentServiceTest extends TestCase
{
    protected AttachmentService $attachmentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->attachmentService = new AttachmentService();
    }

    /**
     * @throws Exception
     */
    public function testCreate()
    {
        $file = Mockery::mock(HttpFile::class);
        $file->shouldReceive('getMimeType')->andReturn('image/jpeg');
        $file->shouldReceive('store')->andReturn('attachment/test.jpg');

        $attributes = ['attachment' => $file];

        $result = $this->attachmentService->create($attributes);

        $this->assertTrue((bool)$result->success());
        $this->assertEquals('files:upload:succeeded', $result->getMessage());
    }

    /**
     * @throws Exception
     */

    public function testDownload()
    {
        $response = Mockery::mock(StreamedResponse::class);
        Storage::shouldReceive('download')->andReturn($response);

        $result = $this->attachmentService->download('test.jpg');

        $this->assertInstanceOf(StreamedResponse::class, $result);
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
