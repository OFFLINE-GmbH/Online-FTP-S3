<?php

use GrahamCampbell\Flysystem\Facades\Flysystem;

class FileControllerTest extends TestCase
{

    private function assertNoErrors($response)
    {
        $this->assertCount(0, $response->original['errors']);
    }

    public function setUp()
    {
        parent::setUp();
        $this->cleanUp();
    }

//    public function testRename()
//    {
//        $this->createTestFile();
//        $response = $this->call('PUT', '/file/unittest/test.php', [
//            'newname'    => 'unittest/test.new',
//        ]);
//        $this->assertResponseOk();
//        $this->assertNoErrors($response);
//
//        $this->assertFalse(file_exists(storage_path('temp/unittest/test.php')));
//        $this->assertTrue(file_exists(storage_path('temp/unittest/test.new')));
//    }

    public function testCreateFile()
    {
        $response = $this->call('POST', '/api/file', [
            'name'    => 'unittest/test.php',
            'content' => 'Content'
        ]);
        $this->assertNoErrors($response);
        $this->assertResponseOk();
    }

    public function testReadFile()
    {
        $this->createTestFile();

        $response = $this->call('GET', '/api/file/unittest/test.php');
        $this->assertResponseOk();
        $this->assertEquals('Content', $response->original['content']);
    }

    public function testDeleteFile()
    {
        $this->createTestFile();

        $response = $this->call('DELETE', '/api/file/unittest/test.php');
        $this->assertNoErrors($response);
        $this->assertResponseOk();

        $response = $this->call('GET', '/api/file/unittest/test.php');
        // FileNotFoundException = 1000
        $this->assertCount(1, $response->original['errors']);
        $this->assertArrayHasKey(1000, $response->original['errors']);
    }

    public function testFileSizeLimit()
    {
        $response = $this->call('POST', '/api/file', [
            'name'    => 'unittest/test.php',
            'content' => 'Content that is too large'
        ]);
        // PostTooLargeException = 413
        $this->assertCount(1, $response->original['errors']);
        $this->assertArrayHasKey(413, $response->original['errors']);
        $this->assertResponseStatus(413);
    }


    public function tearDown()
    {
        parent::tearDown();
        $this->cleanUp();
    }

    private function cleanUp()
    {
        Flysystem::deleteDir('/unittest');
    }

    private function createTestFile()
    {
        @mkdir(storage_path('temp'));
        @mkdir(storage_path('temp/unittest'));
        file_put_contents(storage_path('temp/unittest/test.php'), 'Content');
    }

}
