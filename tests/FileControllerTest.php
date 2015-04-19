<?php

class FileControllerTest extends TestCase {

    /**
     * Create a file
     *
     * @return void
     */
    public function testFileCreate()
    {
        $response = $this->call('POST', '/file', [
            'filename' => 'test.php',
            'contents' => 'Contents'
        ]);
        dd($response);
        $this->assertResponseOk();
    }
    /**
     * Get a files contents
     *
     * @return void
     */
    public function testFileGet()
    {
        $response = $this->call('GET', '/file/test.php');
        dd($response);
        $this->assertResponseOk();
    }

}
