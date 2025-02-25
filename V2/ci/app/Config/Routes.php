<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//route index
$routes->get('/', 'Accueil::afficher');

//route vers les jeux scenario
use App\Controllers\Scenario;
$routes->get('scenario/afficher', [Scenario::class, 'afficher']);
//route vers un scenario avec sa difficulte choisie
$routes->get('scenario/jouer/(:segment)/(:segment)', [Scenario::class, 'jouer']);
$routes->get('scenario/jouer/(:segment)', [Scenario::class, 'jouer']);
$routes->get('scenario/jouer/', [Scenario::class, 'jouer']);

$routes->get('scenario/franchir_etape/(:segment)/(:segment)', [Scenario::class, 'franchir_etape']);
$routes->get('scenario/franchir_etape/(:segment)', [Scenario::class, 'franchir_etape']);
$routes->get('scenario/franchir_etape/', [Scenario::class, 'franchir_etape']);
$routes->post('scenario/franchir_etape/', [Scenario::class, 'franchir_etape']);

$routes->get('scenario/finir_scenario/(:segment)/(:segment)', [Scenario::class, 'finir_scenario']);
$routes->get('scenario/finir_scenario/(:segment)', [Scenario::class, 'finir_scenario']);
$routes->get('scenario/finir_scenario/', [Scenario::class, 'finir_scenario']);
$routes->post('scenario/finir_scenario', [Scenario::class, 'finir_scenario']);

//route vers la partie creation d'un compte
use App\Controllers\Compte;
$routes->get('compte/creer_compte', [Compte::class, 'creer_compte']);
$routes->post('compte/creer_compte', [Compte::class, 'creer_compte']);

$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);

$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);

$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);

$routes->get('compte/modification_profil', [Compte::class, 'modification_profil']);
$routes->post('compte/modification_profil', [Compte::class, 'modification_profil']);

$routes->get('compte/affichage_comptes', [Compte::class, 'affichage_comptes']);

$routes->get('compte/affichage_jeux', [Compte::class, 'affichage_jeux']);

//visualiser le scenario en param le numero du scenario
$routes->get('compte/visualiser_scenario/(:num)', 'Compte::visualiser_scenario/$1');
$routes->get('compte/visualiser_scenario/', 'Compte::visualiser_scenario');
$routes->get('compte/creer_jeux', [Compte::class, 'creer_jeux']);
$routes->post('compte/creer_jeux', [Compte::class, 'creer_jeux']);

$routes->get('compte/supprimer_scenario/(:num)', [Compte::class,'supprimer_scenario/$1']);
