<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.edit_profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            // 'password' => 'min:8|max:255',
            // 'confirm_password' => 'min:8|max:255',
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        // $pwd = $request->get('password');
        // $pwd1 = $request->get('confirm_password');
        // if ($pwd !== $pwd1) {
        //     return redirect()->route('user.edit_password', $user->id)
        //     ->with('error', 'Password does not match');
        // }
        // else {
            // $user->password = Hash::make($pwd);
            // $user->save();

            // if ($request->file('image')) {
            //     if ($user->profile_path && file_exists(storage_path('app/public/'.$user->profile_path))) {
            //         Storage::delete('public/'.$user->profile_path);
            //     }
            //     $image_name = $request->file('image')->store('user_profiles', 'public');
            // } else {
            //     $image_name = $user->profile_path;
            // }

            if ($request->file('image')) {
            $image_name = $request->file('image');
            // $image_name = $request->file('image')->store('images', 'public');
            $storage = new StorageClient([
                'keyFilePath' => public_path('key.json')
            ]);

            $bucketName = env('GOOGLE_CLOUD_BUCKET');
            $bucket = $storage->bucket($bucketName);

            //get filename with extension
            $filenamewithextension = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            // $filenamewithextension = $request->file('image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            Storage::put('public/uploads/' . $filenametostore, fopen($request->file('image'), 'r+'));

            $filepath = storage_path('app/public/uploads/' . $filenametostore);

            $object = $bucket->upload(
                fopen($filepath, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            // delete file from local disk
            Storage::delete('public/uploads/' . $filenametostore);
        }
        // if ($request->file('foto')) {
        //     $image_name = $request->file('foto')->store('images', 'public');
        // }

            $user->profile_path = $filenametostore;
            // $user->profile_path = $image_name;
            $user->save();

            return redirect()->route('user.index')
            ->with('success', 'Data Updated Successfully');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function edit_password($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.edit_password', compact('user'));
    }
}