<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait SearchTrait
{
    protected $records_per_page =100;
    /**
     * @param $res
     * @param $searches
     * @param $request
     * @return mixed* @param \Illuminate\Database\Eloquent\Builder $res The query builder instance to apply the filters to.
     * @param array $searches An associative array containing the search criteria:
     *      - "int": An array of field names to filter by integer values.
     *      - "str": An array of field names to filter by string values.
     *      - "date": An array of field names to filter by date values, with `from` or `to` suffixes for date range queries.
     *      - "relations": An array of relationship fields to filter by, with dot notation to specify nested fields.
     * @param Request $request The HTTP request instance containing the search input data.
     *
     * @return Builder The modified query builder instance with the applied filters.
     *
     */
    function searching($res , $searches , $request){
        $data = $request->all();

        if (count($data) > 0) {

            if(isset($searches["int"])) {
                foreach ($searches["int"] as $f) {
                    if (isset($data[$f]) && strlen($data[$f]) > 0 && $data[$f] >= 0) {
                        $res->where($f, $data[$f]);
                    }
                }
            }
            if(isset($searches["str"])) {
                foreach ($searches["str"] as $f) {
                    if (isset($data[$f]) && strlen($data[$f]) > 0) {
                        $res->where($f, 'like', '%' . $data[$f] . '%');
                    }
                }
            }
            if(isset($searches["date"])) {
                foreach ($searches["date"] as $f) {
                    if (isset($data[$f]) && strlen($data[$f]) > 0) {
                        $x = explode("__", $f);
                        $op = $x[1] == "from" ? ">=" : "<=";
                        $res->where($x[0], $op, $data[$f]);
                    }
                }
            }
            if(isset($searches["relations"])){
                foreach ($searches["relations"] as $f) {
                    $x = explode(".", $f);
                    if (isset($data[$x[0]][$x[1]]) && strlen($data[$x[0]][$x[1]]) > 0) {
                        $res->whereHas($x[0], function ($query) use ($data,$x) {
                            $query->where($x[1],  $data[$x[0]][$x[1]]);
                        });
                    }
                }
            }
        }
        return $res;
    }
    //convert "null" ---> null
    function nulls($arr){
        $res = [];
        foreach($arr as $k=>$v){
            if (is_null($v) || $v === "null") {
                $v = null;
            } elseif($v === "true"){
                $v = 1;
            } elseif($v === "false"){
                $v = 0;
            }

            $res[$k] = $v;

        }

        return $res;
    }

}
