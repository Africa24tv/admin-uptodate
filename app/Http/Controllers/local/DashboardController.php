<?php

namespace App\Http\Controllers\local;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\Tache;

class DashboardController extends Controller
{
    public function index()
    {
        $nbre_users = User::count();

        $prod_totale = User::prod();

        $nbre_taches = Tache::count();

        $nbre_articles = Article::count();

        $nbre_events = Event::count();

        return view('welcome',
            compact('nbre_users', 'prod_totale', 'nbre_taches', 'nbre_articles', 'nbre_events'));
    }
}
