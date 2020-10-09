<?php
use Illuminate\Support\Arr;

require ROOT . 'Models/NBA.php';

/**
 * We can add here more actions for CRUD operations
 */
class ExportController extends BaseController
{
    const SEARCHARGS = ['player', 'playerId', 'team', 'position', 'country'];
    private $model;

    public function __construct()
    {
        $this->model = new NBA();
    }

    public function index($params)
    {
        if (Arr::exists($params, 'type')) {
            $type = Arr::get($params, 'type');
            $format = Arr::get($params, 'format', 'html');
            $collections = collect($params);

            switch ($type) {
                case 'playerstats':
                    $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
                    $search = $collections->filter(function ($value, $key) use ($searchArgs) {
                        return in_array($key, $searchArgs);
                    });
                    $sql = $this->getPlayerStatsQuery($search);
                    $data = $this->model->runQuery($sql);
                    $data = $this->evaluateStats($data);

                    break;
                case 'players':
                    $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];
                    $search = $collections->filter(function ($value, $key) use ($searchArgs) {
                        return in_array($key, $searchArgs);
                    });
                    $sql = $this->getPlayersQuery($search);
                    $data = collect($this->model->runQuery($sql))
                        ->map(function ($item, $key) {
                            unset($item['id']);
                            return $item;
                        });

                    break;
            }
            if (!$data) {
                $d['errorMsg'] = 'Error: No data found!';
                $this->set($d);
                $this->render("error");
            }

            return $this->format($data, $format);
        } else {
            $d['errorMsg'] = 'Please specify a type';
            $this->set($d);
            $this->render("error");
        }
    }
}
