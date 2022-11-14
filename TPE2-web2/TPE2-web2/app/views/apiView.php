<?php

class ApiView {
    
    /**
     * Convierte los datos de la respuesta a JSON y los imprime.
     */
    public function response($data, $status = 200){
        header("Content-Type: application/json");
        header("HTTP/1.1 {$status}" . $this->_requestStatus($status));
        //convierte los datos a un formato json
        echo json_encode($data);
    }

    //Devuelve el texto asociado a un codigo de respuesta HTTP
    private function _requestStatus($code){
        $status = array(
            200 => "OK",
            201 => "Created",
            400 => "Bad request",
            404 => "Not found",
            500 => "Internal Server Error"
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];

    }

}