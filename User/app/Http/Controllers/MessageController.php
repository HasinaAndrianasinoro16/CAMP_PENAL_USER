<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    //controller pour afficher tout les messages
    public function Message()
    {
        try {
            $users = DB::table('v_user')->get()->where('id','<>',Auth::id());
            return view('message')->with('users',$users);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher une conversation
    public function Conversation(User $user)
    {
        try {
            $id = Auth::id();
            $users = DB::table('v_user')->get()->where('id','<>',$id);
            $messages = Messages::getMessageFor($id, $user->id)->get()->reverse();
//            dd($messages);
//            dd($id,$user->id);
            return view('conversation')->with('users',$users)->with('messages',$messages)->with('user',$user);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //fonction pour enregistrer un nouveau message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'contents' => 'required|max:255',
            'user' => 'required|integer'
        ],[
            'content.required' => 'Le champ message est obligatoire.',
            'content.max' => 'Le champ message est trop long et ne doit pas dépasser 255 caractères.',
        ]);

        try {
            Messages::createMessage(Auth::id(), $request->user, $request->contents);
            return redirect()->back()->with('success', 'Message envoyé avec succès!');
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'envoi du message.']);
        }
    }



}
