<?php

namespace App\Providers;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
	{
		$this->app->instance(LoginResponse::class, new class implements LoginResponse {
			public function toResponse($request)
			{
				return $request->user()->toJSON();
			}
		});
	}
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
		Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
		Fortify::authenticateUsing(function (Request $request) {
			$user = User::where('email', $request->email)->first();
			if ($user &&
				Hash::check($request->password, $user->password)) {

				return $user;
			}
		});

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        /* RateLimiter::for('two-factor', function (Request $request) { */
            /* return Limit::perMinute(5)->by($request->session()->get('login.id')); */
        /* }); */
    }
}
