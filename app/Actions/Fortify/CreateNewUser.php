<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required'],
            'region' => ['required'],
            'age' => ['required'],
            'gendar' => ['required'],
            'role' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        if (request()->hasFile('photo')){
             $photo = request()->file('photo');
            $unique_name =time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('/images/profile'),$unique_name);
            $input['photo']=$unique_name;
              
        }else{
             $input['photo'] ='77.jpg';  
            
        }
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone'=>$input['phone'],
            'region'=>$input['region'],
            'age'=>$input['age'],
            'gendar'=>$input['gendar'],
            'role'=>$input['role'],
            'photo'=>$input['photo']
        ]);
    }
}
