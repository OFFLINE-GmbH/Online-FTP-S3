<?php

use GrahamCampbell\Flysystem\Facades\Flysystem;

class DirectoryControllerTest extends TestCase
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

    public function testCreateDirectory()
    {
        $response = $this->call('POST', '/dir', [
            'name'    => 'unittest/test'
        ]);
        $this->assertNoErrors($response);
        $this->assertResponseOk();
        $this->assertTrue(is_dir(storage_path('temp/unittest/test')));
    }

    public function testReadDirectory()
    {
        $this->createTestDirectoryWithContents();

        $response = $this->call('GET', '/dir/' . rawurlencode('unittest/test'));
        $this->assertResponseOk();
        $this->assertCount(2, $response->original['content']);
    }

    public function testDeleteDirectory()
    {
        $this->createTestDirectoryWithContents();

        $response = $this->call('DELETE', '/dir/' . rawurlencode('unittest/test'));
        $this->assertNoErrors($response);
        $this->assertResponseOk();

        $response = $this->call('GET', '/dir/' . rawurlencode('unittest/test'));
        $this->assertResponseOk();
        $this->assertTrue(is_array($response->original['content']));
        $this->assertCount(0, $response->original['content']);
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

    private function createTestDirectory()
    {
        mkdir(storage_path('temp/unittest'));
        mkdir(storage_path('temp/unittest/test'));
    }

    private function createTestDirectoryWithContents()
    {
        $this->createTestDirectory();
        file_put_contents(storage_path('temp/unittest/test/test.php'), 'contents');
        file_put_contents(storage_path('temp/unittest/test/test2.php'), 'contents2');
    }

}
