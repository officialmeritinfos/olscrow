<?php

namespace App\Traits;

use App\Models\Coin;
use App\Models\Country;
use App\Models\Fiat;
use App\Models\Login;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserBalance;
use App\Models\UserSetting;
use App\Notifications\CustomNotificationMail;
use App\Notifications\SendDepartmentNotification;
use Carbon\Carbon;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

trait Regular
{
    //check where to redirect user to
    public function userDashboard($user): string
    {
        //check the route to redirect user to
        if ($user->setPassword!=1){
            return route('complete-profile-social');
        }
        if (empty($user->accountType)){
            return route('setup-profile-new');
        }
        //based-off on the account type, lets redirect to the proper dashboard
        switch ($user->accountType){
            case 1:
                $url = route('wallet.index');
                break;
            case 2:
                $url = route('business.index');
                break;
            default:
                $url = route('console.index');
                break;
        }
        return $url;
    }
    //generate unique alpha-numeric Id
    public function generateUniqueReference($table,$column,$length=10): string
    {
        $reference = $this::generateRef($length);
        return DB::table($table)->where($column,$reference)->first()?$this->generateUniqueReference($table,$column,$length):$reference;
    }
    //generate unique numeric ID
    public function generateUniqueId($table,$column,$length=10): string
    {
        $id = $this::generateId($length);
        return DB::table($table)->where($column,$id)->first()?$this->generateUniqueId($table,$column,$length):$id;
    }
    //generate 6-code token
    public function generateToken($table,$column): int
    {
        $reference = $this::createCode();
        return DB::table($table)->where($column,$reference)->first() ?
            $this->generateToken($table,$column):$reference;
    }
    //generate numeric ID
    private function generateId($length=10): string
    {
        $id = mt_rand();
        return Str::padLeft($id,$length,'0');
    }
    //generate alpha-numeric id
    private function generateRef($length=10): string
    {
        return Str::random($length);
    }
    //generate unique six code for verification purposes
    private static function createCode(): int
    {
        return rand(100000,999999);
    }
    //get the current time in Date-time string
    public function getCurrentDateTimeString(): string
    {
        return Carbon::now()->toDateTimeString();
    }
    //notify user on logins
    public function notifyLogin(Request $request,$user)
    {
        $agent = new Agent();
        Login::create([
            'user'=>$user->id,
            'agent'=>
                'Platform: '.$agent->platform().'-'.$agent->version($agent->platform()).'; '.
                'browser: '.$agent->browser().'-'.$agent->version($agent->browser()),
            'device'=>$agent->device(),
            'Ip'=>$request->ip()
        ]);
        UserActivity::create([
            'user'=>$user->id,
            'title'=>'Account Access',
            'content'=>'Your account was accessed on '.date('d-m-Y h:i:s a').' from
            Ip '.$request->ip().' on device '.$agent->device()
        ]);
        //send mail to user
        $message = "Your ".env('APP_NAME').' account has been accessed from
                    an IP <b>'.$request->ip().'</b> through a <b>'.$agent->device().'</b> on '.date('d-m-Y h:i a');
        $user->notify(new CustomNotificationMail($user->name,'New Account login',$message));
    }

    //initialize user settings
    public function initializeUserSettings($user)
    {
        //check if user settings has been initialized
        $settings = UserSetting::where('user',$user->id)->first();
        if (empty($settings)){
            UserSetting::create([
                'user'=>$user->id
            ]);
        }
    }
    //record user activity and send notification
    public function userNotification($user,$title,$content,$ip)
    {
        $user = User::where('id',$user->id)->first();

        $settings = UserSetting::where('user',$user->id)->first();

        UserActivity::create([
            'user'=>$user->id,
            'title'=>$title,
            'content'=>$content
        ]);
        if ($settings->emailNotification==1){
            //compose the mail to send to user
            $mail = "
                This is to notify you that an activity just took place on your account. If this activity was not
                authorized by you, please change your account password and contact support right away. <br/>
                <p><b>Activity: </b>".$content."</p><br/>
                <p><b>IP: </b>".$ip."</p><br/>
            ";
            //send the mail
            $user->notify(new CustomNotificationMail($user->name,$title,$mail));
        }

    }
    //generate secured uuid
    public function generateUUID(): string
    {
        $str= (string) Str::uuid();

        return  time().'-'.$str;
    }
    //generate unique ulid
    public function generateUniqueUlid($table,$column): string
    {
        $reference = $this::generateUlid();
        return DB::table($table)->where($column,$reference)->first()?$this->generateUniqueReference($table,$column):$reference;
    }
    //generate numeric ID
    private function generateUlid(): string
    {
        return Str::ulid();
    }
    public function getBanksPaystack($country,$currency)
    {
        $paystack = new Paystack();
        $result= $paystack->getBanks($country,$currency)->json();
        return $result['data'];
    }
    //verify bank from bank code
    public function verifyBankFromBankCode($userBank,$country,$currency)
    {
        $paystack = new Paystack();
        $result= $paystack->getBanks($country,$currency)->json();
        $banks = $result['data'];
        foreach ($banks as $bank) {
            if ($bank['code']==$userBank){
                $bankNeed = $bank['name'];
            }
        }

        return $bankNeed;
    }
    //fetch usdt rate to NGN
    public function convertUsdtToNgn(): float|int
    {
        try {
            $fiat = Fiat::where('code', 'NGN')->first();

            $binance = new Binance();

            $rate = $binance->fetchUsdtNgnRate('USDTNGN');

            $rateReturned = $rate;
            //since we are converting usdt to NGN, we need to put a fee
            //this will help us make profit
            $percentageDebit = ($fiat->toConversionCharge/100)*$rateReturned;

            return $rateReturned+$percentageDebit;

        }catch (\Exception $exception){
            Log::info($exception->getMessage());

            return 0;
        }
    }
    //convert NGN to usdt
    public function convertNgnToUsdt(): float|int
    {
        try {
            $fiat = Fiat::where('code', 'NGN')->first();

            $binance = new Binance();

            $rate = $binance->fetchUsdtNgnRate('USDTNGN');

            $rateReturned = $rate;
            //since we are converting ngn to usdt, we need to put a fee
            //this will help us make profit
            $percentageDebit = ($fiat->fromConversionCharge/100)*$rateReturned;

            return $rateReturned+$percentageDebit;

        }catch (\Exception $exception){
            Log::info($exception->getMessage());

            return 0;
        }
    }
    //fetch crypto rate to fiat
    public function fetchCryptoRate($crypto,$fiat)
    {
        $tatum = new Tatum();
        return $tatum->fetchCryptoRate($crypto,$fiat);
    }
    //send mail to admin
    public function sendMailToAdmin($title,$content)
    {
        $admin = User::where('isAdmin',1)->first();
        if (!empty($admin)){
            $admin->notify(new CustomNotificationMail($admin->name,$title,$content));
        }
    }
    //decrypt word
    public function decryptWord($string)
    {
        return Crypt::decryptString($string);
    }
    //get greeting
    public function greeting()
    {

        $dt = Carbon::parse(date('Y-m-d H:i:s'));
        $hour = $dt->hour;
        if ($hour < 12) {
            $greeting= 'Good morning';
        }elseif ($hour < 16) {
            $greeting= 'Good afternoon';
        }else{
            $greeting='Good evening';
        }

        return $greeting;
    }
    public function shortenNumberToLetter($number): string
    {
        return $this->number_format_short($number);
    }

     function number_format_short($n, $precision = 1) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } elseif ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n * 0.001, $precision);
            $suffix = 'K';
        } elseif ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n * 0.000001, $precision);
            $suffix = 'M';
        } elseif ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n * 0.000000001, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n * 0.000000000001, $precision);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }
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
        $fileName = $user->username.'-'.time().'.'.$file->extension();

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
