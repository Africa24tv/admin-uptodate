<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Tache;
use App\Models\Article;

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
