<?php

namespace App\Traits;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleUpload
{
    public function uploadGoogle($file)
    {
        $user = Auth::user();
        //get the credentials in the json file
        $googleConfigFile = file_get_contents(config_path('oloscrow.json'));
        //create a StorageClient object
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);

        //get the bucket name from the env file
        $storageBucketName = config('googlecloud.storage_bucket');
        //pass in the bucket name
        $bucket = $storage->bucket($storageBucketName);
        $image_path = $file->getRealPath();
        //rename the file
        $fileName = $user->name.'-'.time().'.'.$file->extension();

        //open the file using fopen
        $fileSource = fopen($image_path, 'r');
        //specify the path to the folder and sub-folder where needed
        $googleCloudStoragePath = 'profile-uploads/' . $fileName;

        //upload the new file to google cloud storage
        $request = $bucket->upload($fileSource, [
            'predefinedAcl' => 'publicRead',
            'name' => $googleCloudStoragePath
        ]);

        if ($request){

            return [
                'done'=>true,
                'link'=>'https://storage.googleapis.com/oloscrow-uploads/profile-uploads/'.$fileName
            ];
        }else{
            Log::info($request->json());
            return [
                'done'=>false,
            ];
        }
    }

    public function deleteUpload($link)
    {
        //get the credentials in the json file
        $googleConfigFile = file_get_contents(config_path('oloscrow.json'));
        //create a StorageClient object
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);

        //get the bucket name from the env file
        $storageBucketName = config('googlecloud.storage_bucket');
        //pass in the bucket name
        $bucket = $storage->bucket($storageBucketName);

        $url =$link;
        // Parse the URL
        $urlParts = parse_url($url);
        $path = $urlParts['path'];
        $filename = pathinfo($path, PATHINFO_BASENAME);//file name
        try {
            $object = $bucket->object('profile-uploads/'.$filename );
            $object->delete();
        }catch (\Exception $exception){
            Log::info($exception->getMessage());
        }
    }
}
