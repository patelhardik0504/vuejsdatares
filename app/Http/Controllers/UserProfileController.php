<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index()
    {
        return UserProfile::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'profiles' => 'required|array',
            'profiles.*.name' => 'required|string',
            'profiles.*.number' => 'required|string',
            'profiles.*.email' => 'required|email',
            'profiles.*.profile_image' => 'nullable|image',
        ]);

        foreach ($request->profiles as $key => $profile) {
            if (isset($profile['profile_image']) && is_file($profile['profile_image'])) {
                $profileImagePath = $profile['profile_image']->store('profile_images', 'public');
                $request->profiles[$key]['profile_image'] = $profileImagePath;
            }
        }

        $userProfile = UserProfile::create(['profiles' => $request->profiles]);

        return response()->json($userProfile, 201);
    }

    public function show(UserProfile $userProfile)
    {
        return $userProfile;
    }

    public function update(Request $request, UserProfile $userProfile)
    {
        $request->validate([
            'profiles' => 'required|array',
            'profiles.*.name' => 'required|string',
            'profiles.*.number' => 'required|string',
            'profiles.*.email' => 'required|email',
            'profiles.*.profile_image' => 'nullable|image',
        ]);

        $existingProfiles = $userProfile->profiles ?? [];

        foreach ($request->profiles as $key => $profile) {
            if (isset($profile['profile_image']) && is_file($profile['profile_image'])) {
                $profileImagePath = $profile['profile_image']->store('profile_images', 'public');
                $request->profiles[$key]['profile_image'] = $profileImagePath;
            }
            $existingProfiles[] = $profile;
        }

        $userProfile->update(['profiles' => $existingProfiles]);

        return response()->json($userProfile, 200);
    }

    public function destroy(UserProfile $userProfile)
    {
        foreach ($userProfile->profiles as $profile) {
            if (isset($profile['profile_image'])) {
                Storage::disk('public')->delete($profile['profile_image']);
            }
        }
        $userProfile->delete();
        return response()->json(null, 204);
    }
}
