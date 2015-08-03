<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PhpSoft\Illuminate\Photos\Facades\Photo;

class PhotosController extends TestCase
{
    use WithoutMiddleware;

    public function testValidateRequireImage()
    {
        $res = $this->call('POST', '/photos');
        $this->assertEquals(400, $res->getStatusCode());
        $results = json_decode($res->getContent());
        $this->assertEquals('The image field is required.', $results->errors->image[0]);
    }

    public function testValidateFileLarge()
    {
        $uploadedFile = new UploadedFile(__DIR__ . '/../../../resources/file_large.jpg', 'file_large.jpg');

        $res = $this->call('POST', '/photos', [], [], [ 'image' => $uploadedFile ]);
        $this->assertEquals(400, $res->getStatusCode());
        $results = json_decode($res->getContent());
        $this->assertEquals('File size too large.', $results->errors->image[0]);
    }

    public function testValidateMineType()
    {
        $uploadedFile = new UploadedFile(__DIR__ . '/../../../resources/text.txt', 'text.txt');

        $res = $this->call('POST', '/photos', [], [], [ 'image' => $uploadedFile ]);
        $this->assertEquals(400, $res->getStatusCode());
        $results = json_decode($res->getContent());
        $this->assertEquals('Not allow upload this file type.', $results->errors->image[0]);
    }

    public function testUpload()
    {
        Photo::shouldReceive('validateMineType')->once()->andReturn(true);
        Photo::shouldReceive('validateFileSize')->once()->andReturn(true);
        Photo::shouldReceive('upload')->once()->andReturn([
            'type' => 'cloudinary',
            'url' => 'http://res.cloudinary.com/huytbt-test/image/upload/v1438591244/pfpkrfwadonc7hvvt6a6.jpg',
            'extra' => [
                'public_id' => 'pfpkrfwadonc7hvvt6a6',
                'version' => 1438591244,
                'signature' => 'e2082315dd0f5ba4660aa40f8ee2f51abe17e53b',
                'width' => 241,
                'height' => 209,
                'format' => 'jpg',
                'resource_type' => 'image',
                'created_at' => '2015-08-03T08:40:44Z',
                'tags' => [],
                'bytes' => 9427,
                'type' => 'upload',
                'etag' => '4c8abc0ae31ef40f95a50e2c39ddba7d',
                'url' => 'http://res.cloudinary.com/huytbt-test/image/upload/v1438591244/pfpkrfwadonc7hvvt6a6.jpg',
                'secure_url' => 'https://res.cloudinary.com/huytbt-test/image/upload/v1438591244/pfpkrfwadonc7hvvt6a6.jpg',
                'original_filename' => 'image',
            ]
        ]);

        $uploadedFile = new UploadedFile(__DIR__ . '/../../../resources/image.jpg', 'image.jpg');

        $res = $this->call('POST', '/photos', [], [], [ 'image' => $uploadedFile ]);
        $this->assertEquals(201, $res->getStatusCode());
        $results = json_decode($res->getContent());
        $this->assertEquals('cloudinary', $results->entities[0]->type);
        $this->assertEquals('http://res.cloudinary.com/huytbt-test/image/upload/v1438591244/pfpkrfwadonc7hvvt6a6.jpg', $results->entities[0]->url);
    }
}
