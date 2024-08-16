<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $fillable = ['from_id', 'to_id', 'created_at', 'content'];
    public $timestamps = false;

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public static function createMessage($fromUserId, $toUserId, $message)
    {
        try {
            return self::create([
                'from_id' => $fromUserId,
                'to_id' => $toUserId,
                'content' => $message,
                'created_at' => Carbon::now(),
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public static function getMessageFor($fromUserId, $toUserId): Builder
    {
        try {
            return self::query()
                ->where(function ($query) use ($fromUserId, $toUserId) {
                    $query->where('from_id', $fromUserId)
                        ->where('to_id', $toUserId);
                })
                ->orWhere(function ($query) use ($fromUserId, $toUserId) {
                    $query->where('from_id', $toUserId)
                        ->where('to_id', $fromUserId);
                })
                ->orderBy('created_at', 'desc')
                ->with('from');
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    use HasFactory;
}
