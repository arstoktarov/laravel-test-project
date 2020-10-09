<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const STATUS_CODE_SUCCESS = 200;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function errorJsonResponse($statusCode, $message = null, $headers = []) {
        return response()->json([
            'message' => $message ?? self::getDefaultMessageByStatusCode($statusCode)
        ], $statusCode, $headers);
    }

    public static function successJsonResponse($data, $headers = []) {
        return response()->json($data, self::STATUS_CODE_SUCCESS, $headers);
    }

    protected static function getDefaultMessageByStatusCode(int $statusCode) {
        return trans("httpmessages.$statusCode");
    }

    /**
     * Трансформирует collection внутри пагинации в заданный resource
     *
     * @param $paginated
     * @param $resource
     * @return mixed
     */
    public function paginatedToResourceCollection($paginated, $resource) {
        $collection = $paginated->getCollection();
        $collection = $resource::collection($collection)->collection;
        $paginated->setCollection($collection);
        return $paginated;
    }
}
