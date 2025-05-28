<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Student;
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
        Validator::make($input, [ // block dangerous characters (<, >, ", etc.)
            // only letters, spaces, . ' -
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z .\'-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            // only allows numbers (0-9)
            'matric_no' => ['required', 'string', 'max:20', 'unique:students,matric_no', 'regex:/^[0-9]+$/']
        ])->validate();

         // Create the user record.
        $user = User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id'  => 6, // default student role
        ]);

        // Create the associated student record with proper linkage.
        Student::create([
            'matric_no'   => $input['matric_no'],
            'st_name'     => $input['name'],
            'st_email'    => $input['email'],
            'st_password' => Hash::make($input['password']),
            'user_id'     => $user->id,
        ]);

        return $user;
    }
}
