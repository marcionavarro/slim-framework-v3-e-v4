<?php


namespace app\controllers;

use app\models\Users;
use app\src\Image;
use app\src\Validate;

class PerfilPhotoController extends Controller
{
    public function store()
    {
        $validate = new Validate;
        $validate->validate([
            'file' => 'image'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $user = new Users;
        $selectUser = $user->select()->where('id', 1)->first();

        $image = new Image('file');
        $image->delete($selectUser->photo);
        $image->size('post')->upload();


        $user->find('id', 1)->update([
            'photo' => "assets/imgs/photos/{$image->getName()}"
        ]);

        flash('message', success('Upload realizado com sucesso'));
        back();
    }
}