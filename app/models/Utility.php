<?php

/**
* Utility classes
*/
class Utility extends BaseModel {

	public static function getSession()
	{
		if (!Session::has('user')) {
			Session::put('user', Confide::user()->toArray());
			Session::put('user.roles', Confide::user()->roles->toArray());

			if ($sem = Configuration::get('current_semester', Session::get('user.campus_id')))
				Session::put('user.sem', $sem->toArray());

			if (Session::get('user.campus_id') == NULL) {
				Session::put('user.campuses', (new Campus)->getList());
				Session::put('user.campus', Campus::first()->toArray());
			} else {
				Session::put('user.campus', Campus::findOrFail(Session::get('user.campus_id'))->toArray());
			}

			Session::put('user.menu', static::getMenu());
		}

		return Session::get('user');
	}

	public static function getMenu()
	{
		$min = App::environment('dev') ? 'partials' : 'partials-min';

		$menu = [
			'candidates' => [
				'url' => '/admin/candidates',
				'baseurl' => '/admin/candidates',
				'ctrl' => 'CandidateCtrl',
				'temp' => "/ang/{$min}/admin/candidates.html",
				'icon' => 'fa-sitemap'
			],
			'voters' => [
				'url' => '/admin/voters',
				'baseurl' => '/admin/voters',
				'icon' => 'fa-users'
			],
			'manage' => [
				'url' => '/admin/manage/semesters',
				'baseurl' => '/admin/manage',
				'icon' => 'fa-briefcase',
				'sub' => [
					[
						'title' => 'Campuses',
						'url' => '/admin/manage/campuses',
						'ctrl' => 'CampusCtrl',
						'temp' => "/ang/{$min}/admin/manage.campuses.html",
						'icon' => 'fa-building-o'
					],
					[
						'title' => 'Semesters',
						'url' => '/admin/manage/semesters',
						'ctrl' => 'SemesterCtrl',
						'temp' => "/ang/{$min}/admin/manage.semesters.html",
						'icon' => 'fa-wrench'
					],
					[
						'title' => 'Colleges',
						'url' => '/admin/manage/colleges',
						'ctrl' => 'CollegeCtrl',
						'temp' => "/ang/{$min}/admin/manage.colleges.html",
						'icon' => 'fa-shield'
					],
					[
						'title' => 'Positions',
						'url' => '/admin/manage/positions',
						'ctrl' => 'PositionCtrl',
						'temp' => "/ang/{$min}/admin/manage.positions.html",
						'icon' => 'fa-wheelchair'
					],
					[
						'title' => 'Party Lists',
						'url' => '/admin/manage/party-lists',
						'ctrl' => 'PartyListCtrl',
						'temp' => "/ang/{$min}/admin/manage.partylists.html",
						'icon' => 'fa-list-alt'
					]
				]
			],
			'results' => [
				'url' => '/admin/results',
				'baseurl' => '/admin/results',
				'icon' => 'fa-bar-chart-o'
			],
			'settings' => [
				'url' => '/admin/settings',
				'baseurl' => '/admin/settings',
				'icon' => 'fa-cog'
			]
		];

		return $menu;
	}
}