<?php namespace App\Http\Controllers;


class FileController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id)
    {
        return view('user.profile', ['user' => File::findOrFail($id)]);
    }

}