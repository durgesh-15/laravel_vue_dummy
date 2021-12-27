<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;


class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $users = User::latest()->paginate(10);

        return response()->json([
            'status'  => true,
            'data'    => $users,
            'message' => 'Users List'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        print_r($request->all());die;
        $insertPostData = [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'type'          => $request->type,
            'profile_image' => $request->file,
        ];

        // if($request->hasFile('profile_image')) {
        //     $storagepath               = $request->file('profile_image')->store('public/TestS3Functionality');
        //     $fileName                  = basename($storagepath);
        //     $insertPostData['profile_image'] = $fileName;
        //     // $folderPath                  = 'uploads/vendor/';
        //     // $file                        = $request->file('image');
        //     // $AwsData                     = AwsS3Helper::awsFileUpload($file,$folderPath);
        //     // $insertVendorData['image']   = $AwsData['orignal_name'];
        // }

        // print_r($insertPostData) ; die;

        $user = User::create($insertPostData);

        return response()->json([
            'success' => true,
            'data'    => $user,
            'message' => 'User Created Successfully',
        ]);
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }


        $user->update($request->all());

        return response()->json([
            'success' => true,
            'data'    => $user,
            'message' => 'User Information has been updated',
        ]);

        // return $this->sendResponse($user, 'User Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = User::findOrFail($id);
        // delete the user

        $user->delete();

        return response()->json([
            'status'  => true,
            'data'    => $user,
            'message' => 'User has been Deleted'
        ]);
        // return $this->sendResponse([$user], 'User has been Deleted');
    }
}
