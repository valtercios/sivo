<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{    
    /**
     * index
     * Função para listar as notificações do usuário
     *
     * @return void
     */
    public function index(){
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications'));
    }    
    /**
     * markAsRead
     * Função para marcar uma notificação como lida
     *
     * @param  mixed $id
     * @return void
     */
    public function markAsRead($id)
    {
        $markAsRead = Auth()->user()->notifications->where('id', $id)->first();
        if ($markAsRead) {
            if ($markAsRead->read_at == null) {
                $markAsRead->markAsRead();
            } else {
                $markAsRead->markAsUnread();
            }
        }
        
        return back()->with('success', 'Status da notificação alterado com sucesso!');
    }
    
    /**
     * markAllAsRead
     * Função para marcar todas as notificações como lidas
     *
     * @return void
     */
    public function markAllAsRead(){
        Auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Notificações lidas com sucesso!');
    }
    
    /**
     * countNotifications
     * Função para contar as notificações e mostrar as ultimas notificações do usuário
     *
     * @return void
     */
    public function countNotifications(){
        $count = auth()->user()->unreadNotifications->count();
        $notifications = auth()->user()->readNotifications;
        $unreadNotifications = auth()->user()->unreadNotifications;
        $allNotifications = $unreadNotifications->merge($notifications);
        return response()->json(
            [
                'count' => $count,
                'notifications' => $allNotifications
            ]
        );
    }
}
