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
				Session::put('user.sem', Semester::findOrFail($sem['value'])->toArray());

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

	public static function setSession($data)
	{
		// change campus
		if (isset($data['campus_id_g'])) {
			if (!$campus = Campus::whereNull('status')->findOrFail($data['campus_id_g']))	throw new Exception('Campus not found.');

			Session::put('user.campus', $campus->toArray());
		}

		// change semester
		if (isset($data['sy_g']) AND isset($data['sem_g'])) {
			if (!$sem = Semester::where('sy', '=', $data['sy_g'])
							->where('sem', '=', $data['sem_g'])
							->where('campus_id', '=', Session::get('user.campus.id'))
							->whereNull('status')
							->first()
				)
				Session::put('user.sem', NULL);
			else
				Session::put('user.sem', $sem->toArray());
		}

		return true;
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
				'ctrl' => 'VoterCtrl',
				'temp' => "/ang/{$min}/admin/voters.html",
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
						'icon' => 'fa-building-o',
						'access' => ['superadmin']
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
						'title' => 'Party',
						'url' => '/admin/manage/party',
						'ctrl' => 'PartyCtrl',
						'temp' => "/ang/{$min}/admin/manage.party.html",
						'icon' => 'fa-list-alt'
					],
					[
						'title' => 'Admin Users',
						'url' => '/admin/manage/users',
						'ctrl' => 'UserCtrl',
						'temp' => "/ang/{$min}/admin/manage.users.html",
						'icon' => 'fa-user'
					]
				]
			],
			'results' => [
				'url' => '/admin/results',
				'baseurl' => '/admin/results',
				'ctrl' => 'ResultCtrl',
				'temp' => "/ang/{$min}/admin/results.html",
				'icon' => 'fa-bar-chart-o'
			],
			'election' => [
				'url' => '/admin/election',
				'baseurl' => '/admin/election',
				'icon' => 'fa-flag-checkered',
				'ctrl' => 'ElectionCtrl',
				'temp' => "/ang/{$min}/admin/elections.html"
			]
		];

		return $menu;
	}
}