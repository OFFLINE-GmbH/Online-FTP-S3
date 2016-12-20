<?php

namespace App\Http\Requests;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->request->get('driver') === 'ftp') {
            $rules = [
                'host'     => 'required',
                'username' => 'required',
                'port'     => 'required|numeric',
            ];
        } else {
            $rules = [
                'secret' => 'required',
                'key'    => 'required',
                'bucket' => 'required',
                'region' => 'required',
            ];
        }

        return array_merge($rules, [
            'driver' => 'required|in:ftp,s3',
        ]);
    }
}
