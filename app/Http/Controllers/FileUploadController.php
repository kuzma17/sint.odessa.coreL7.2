<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;

class FileUploadController extends Controller
{
    public function uploader(Request $request, Factory $validator) {
        $v = $validator->make($request->all(), [
            'upload' => 'required|image',
        ]);

        $funcNum = $request->input('CKEditorFuncNum');

        if ($v->fails()) {
            return response(
                "<script>
                window.parent.CKEDITOR.tools.callFunction({$funcNum}, '', '{$v->errors()->first()}');
            </script>"
            );
        }

        $image = $request->file('upload');
        $image->store('public/uploads');
        $url = asset('storage/uploads/'.$image->hashName());

        return response(
            "<script>
            window.parent.CKEDITOR.tools.callFunction({$funcNum}, '{$url}', 'Изображение успешно загружено');
        </script>"
        );
    }
}