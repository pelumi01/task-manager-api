<?php

namespace Tests\Unit\Task;

use App\Services\PdfService;
use Tests\TestCase;

class DownloadTaskPdfTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_download_pdf(): void
    {
        $taskService = new PdfService();

        // Call the download method
        $response = $taskService->download();

        // Assertions
        $this->assertEquals(200, $response['code']);
        $this->assertEquals("Task downloaded successfully", $response['message']);
        $this->assertEmpty($response['data']); // No data is returned

    }
}
