<?php

namespace App\Traits;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Throwable;

/**
 * Description of ResponseTraits
 *
 * @author eyad_elfarra
 */
trait ResponseTrait {

    //put your code here
    private $code;
    private $status;
    private $message;
    private $data;
    private $total;

    public function setResponse($message = "", $code = 200, $status = true, $data = null) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
        $this->total=-1;

        return $this->getResponse();
    }

    public function customResponse($message = "", $code = 200, $status = true, $data = null) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
        $this->total=-1;

        return $this->getResponse();
    }

    public function customResponseData($data = [], $message = "", $code = 200, $status = true) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
        $this->total=-1;

        return $this->getResponse();
    }

    public function customResponseDataPage($data = [], $message = "", $code = 200, $status = true) {
        $data = $data->toArray();
        $this->code = $code;
        $this->message = $message;
        $this->data = $data["data"];
        $this->status = $status;
        $this->total= $data["total"];
        return $this->getResponse();
    }
    public function customResponseDataPageWithResource($datax = [],$resourceClass, $message = "", $code = 200, $status = true) {
        $data = $datax->toArray();
        $this->code = $code;
        $this->message = $message;
        $this->data = $resourceClass::collection($datax);
        $this->status = $status;
        $this->total= $data["total"];
        return $this->getResponse();
    }

    public function getResponse() {
        $arr = [
            "code" => $this->code,
            "status" => $this->status,
            "message" => $this->message,
            "total" => $this->getCount(),
            "data" => $this->data,
        ];
        return response()->json($arr, $this->code);
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getCount() {
        if($this->total != -1){
            return $this->total;
        }
        try {
            if ($this->data != null && is_countable($this->data)) {
                return count($this->data);
            } else {
                return 0;
            }
        } catch (Throwable $ex) {
            return 0;
        }
    }

}
