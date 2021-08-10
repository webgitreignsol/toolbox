<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;


class UserProfile extends Model
{

  use LogsActivity;
	
	  protected $table = 'user_profiles';			
   	protected $fillable = ['image', 'bio','location', 'longitude', 'latitude','user_id', 'status'];

    protected static $logAttributes = ['image', 'bio','location', 'longitude', 'latitude','user_id', 'status'];
    protected static $logName = 'UserProfile';
    protected static $logOnlyDirty = true;          

    public static  $rulesProfiles = [
    
                'location'      => 'required',
                'image'         => 'required|image',
                'bio'           => 'max:200'
    ];


   public function createprofiles(Request $request)
    {
       $validator = Validator::make($request->all() , Self::$rulesProfiles);
        
        if ($validator->fails()) {
    
          // return response()->json(['errors'=>$validator->errors()]);
        }

       $image = $request->file('image');
       
       $image_name = rand().'.'. $image->getClientOriginalExtension();
       $image->move('assets/img/userProfiles', $image_name);

       $arr =  array(
                'image' => $image_name,
                'location' => 1,           
                'bio'  => $request->bio, 
                'user_id' => Auth::user()->id
            );

       $this->fill($arr);
       $this->save();

       return $this;
    }    

   public function users(){

   		return $this->belongsTo('App\User', 'user_id');
   }

   public function services(){

      return $this->belongsTo('App\Service', 'user_id');
  }
}
