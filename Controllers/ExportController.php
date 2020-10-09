<?php
use Illuminate\Support\Arr;
require ROOT . 'Models/NBA.php';

class ExportController extends BaseController
{
	const SEARCHARGS = ['player', 'playerId', 'team', 'position', 'country'];
	private $model;

	public function __construct() {
		$this->model = new NBA();
    }

    public function index($params)
    {
    	if (Arr::exists($params, 'type')) {
			$type = Arr::get($params, 'type');
			$collections = collect($params);

    		switch ($type) {
	            case 'playerstats':
	                $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
	                $search = $collections->filter(function($value, $key) use ($searchArgs) {
	                    return in_array($key, $searchArgs);
	                });
	                $sql = $this->getPlayerStatsQuery($search);
	                $data = $this->model->runQuery($sql);
	                break;
	            case 'players':
	                $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
	                $search = $collections->filter(function($value, $key) use ($searchArgs) {
	                    return in_array($key, $searchArgs);
	                });
	                $sql = $this->getPlayersQuery($search);
	                $data = $this->model->runQuery($sql);
	                break;
	        }
	        dd($data);
	        if (!$data) {
	            exit("Error: No data found!");
	        }
    	} else {
    		exit('Please specify a type');
    	}
    }
}
