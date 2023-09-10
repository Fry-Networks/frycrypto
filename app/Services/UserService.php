<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function getMongoUser($address = null, $email = null)
    {
        if ($email && $address) {
            $user = User::where('email', $email)->where('address', $address)->first();
            if ($user) {
                return $user;
            }

            $user = User::where('email', $email)->first();
            if ($user) {
                $user->address = $address;
                $user->save();
                return $user;
            }

            $user = User::where('address', $address)->first();
            if ($user) {
                $user->email = $email;
                $user->save();
                return $user;
            }

            return User::create(['email' => $email, 'address' => $address]);
        } elseif ($email) {
            $user = User::where('email', $email)->first();
            return $user ?? User::create(['email' => $email]);
        } elseif ($address) {
            $user = User::where('address', $address)->first();
            return $user ?? User::create(['address' => $address]);
        }

        throw new ModelNotFoundException("Both email and address are missing");
    }

    public function updateByod($byod, $address)
    {
        $user = $this->getMongoUser(['address' => $address]);
        if ($user) {
            $newLicenses = array_diff($byod['licenses'], $user->byod['licenses']);
            $newPayments = array_diff($byod['payments'], $user->byod['payments']);

            // Update the user model
            $user->byod['licenses'] = array_merge($user->byod['licenses'], $newLicenses);
            $user->byod['payments'] = array_merge($user->byod['payments'], $newPayments);
            $user->save();
        }
    }
}
