<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $city
 * @property string $postal_code
 * @property numeric $latitude
 * @property numeric $longitude
 * @property string $description
 * @property string|null $image
 * @property string|null $logo
 * @property string|null $mail
 * @property string|null $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BarFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bar whereUpdatedAt($value)
 */
	class Bar extends \Eloquent {}
}

namespace App\Models{
/**
 * @property \App\Models\Bar|null $id
 * @property string $name
 * @property numeric|null $price
 * @property bool $is_drink
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ConsumableFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable whereIsDrink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consumable whereUpdatedAt($value)
 */
	class Consumable extends \Eloquent {}
}

namespace App\Models{
/**
 * @property \App\Models\Consumable|null $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ConsumableTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsumableType whereUpdatedAt($value)
 */
	class ConsumableType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property \App\Models\Bar|null $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RecommendationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recommendation whereUpdatedAt($value)
 */
	class Recommendation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property \App\Models\Bar|null $id
 * @property int $rate
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUpdatedAt($value)
 */
	class Review extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $email
 * @property string $password
 * @property bool $verified
 * @property \Illuminate\Support\Carbon $last_activity
 * @property int $status
 * @property string|null $photo_profile
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $remember_token
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhotoProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereVerified($value)
 */
	class User extends \Eloquent {}
}

