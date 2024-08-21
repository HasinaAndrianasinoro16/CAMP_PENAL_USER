<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Messages extends Model
{
    protected $table = 'messages';
    protected $fillable = ['from_id', 'to_id', 'created_at', 'content','read_at'];
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

    //compte le nombre de message non lus
    public static function CountMessage()
    {
        try {
            $count = DB::table('messages')
                ->where('to_id', Auth::id())
                ->whereNull('read_at')
                ->count();
            return $count;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //compte le nombre de message non lus par conversation
    public static function coutMessageReceive($fromUserId)
    {
        try {
            $unreadMessages = DB::table('messages')
                ->select('from_id', DB::raw('COUNT(*) as unread'))
                ->where('to_id', '=', Auth::id())
                ->where('from_id', '=',$fromUserId)
                ->whereNull('read_at')
                ->groupBy('from_id')
                ->get();
            return $unreadMessages;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }


    //ajoute une date a la colone read_at pour montrer qu'un message est non lus
    public static function Read_at($fromUserId)
    {
        try {
            $update = DB::table('messages')
                ->where('to_id', '=',Auth::id())
                ->where('from_id', '=',$fromUserId)
                ->whereNull('read_at')
                ->update(['read_at' => Carbon::now()]);
            return $update;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    use HasFactory;
}
