<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserController
 */
final class UserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get(route('users.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserController::class,
            'store',
            \App\Http\Requests\UserStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $firstname = fake()->firstName();
        $lastname = fake()->lastName();
        $username = fake()->userName();
        $name = fake()->name();
        $email = fake()->safeEmail();
        $password = fake()->password();
        $verified = fake()->boolean();
        $last_activity = Carbon::parse(fake()->dateTime());
        $status = fake()->numberBetween(1, 2);

        $response = $this->post(route('users.store'), [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'verified' => $verified,
            'last_activity' => $last_activity->toDateTimeString(),
            'status' => $status,
        ]);

        $users = User::query()
            ->where('firstname', $firstname)
            ->where('lastname', $lastname)
            ->where('username', $username)
            ->where('name', $name)
            ->where('email', $email)
            ->where('verified', $verified)
            ->where('last_activity', $last_activity)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserController::class,
            'update',
            \App\Http\Requests\UserUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $user = User::factory()->create();
        $firstname = fake()->firstName();
        $lastname = fake()->lastName();
        $username = fake()->userName();
        $name = fake()->name();
        $email = fake()->safeEmail();
        $password = Hash::make('password');
        $verified = fake()->boolean();
        $last_activity = Carbon::parse(fake()->dateTime());
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('users.update', $user), [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'verified' => $verified,
            'last_activity' => $last_activity->toDateTimeString(),
            'status' => $status,
        ]);

        $user->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($firstname, $user->firstname);
        $this->assertEquals($lastname, $user->lastname);
        $this->assertEquals($username, $user->username);
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($verified, $user->verified);
        $this->assertEquals($last_activity, $user->last_activity);
        $this->assertEquals($status, $user->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertNoContent();

        $this->assertModelMissing($user);
    }
}
