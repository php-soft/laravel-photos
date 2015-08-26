<?php

namespace PhpSoft\Photos\Controllers;

use Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use PhpSoft\Photos\Facades\Photo;

class PhotosController extends Controller
{
    public function upload()
    {
        $file = Input::file('image');

        $validator = $this->validator([ 'image' => $file ]);

        if ($validator->fails()) {
            return response()->json(arrayView('errors/validation', [
                'errors' => $validator->errors()
            ]), 400);
        }

        $photo = Photo::upload($file->getPathName());

        return response()->json(arrayView('photo/read', [
            'photo' => $photo
        ]), 201);
    }

    /**
     * Get a validator
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('mimetype', function($attribute, $value, $parameters) {
            return Photo::validateMimeType($value->getMimeType());
        });

        Validator::extend('filesize', function($attribute, $value, $parameters) {
            return Photo::validateFileSize($value->getSize());
        });

        Validator::replacer('mimetype', function($message, $attribute, $rule, $parameters) {
            return 'Not allow upload this file type.';
        });

        Validator::replacer('filesize', function($message, $attribute, $rule, $parameters) {
            return 'File size too large.';
        });

        return Validator::make($data, [
            'image' => 'required|mimetype|filesize',
        ]);
    }
}
