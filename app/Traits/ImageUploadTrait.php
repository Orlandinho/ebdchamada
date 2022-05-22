<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    public function avatarUpload(Request $request, $model = null): ?string
    {
        if ($model ==! null && Storage::exists($model->avatar)) {
            if (isset($request->avatar)) {
                Storage::delete($model->avatar);
                return $request->file('avatar')->store('avatars');
            } else {
                return $model->avatar;
            }
        } else {
            return $request->file('avatar')?->store('avatars');
        }
    }
}
