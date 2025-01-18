<?php

class Response
{
    static $respMsgObjName = 'Registro';
    static $respMsgObjFem  = false;

    private static function getCodeMsg(string $respCode)
    {
        $respMsgObjName = ucfirst(self::$respMsgObjName);

        $gender1 = self::$respMsgObjFem
            ? 'a'
            : 'o';

        $gender2 = self::$respMsgObjFem
            ? 'la'
            : 'el';

        $code = null;
        $msg  = null;

        switch ($respCode) {

            case 'OK':
                $code = 200;
                $msg  = "Se ha realizado la operación correctamente!";
                break;
            case 'GET_OK':
                $code = 200;
                $msg  = "Se ha listado el registro con éxito!";
                break;
            case 'GETALL_OK':
                $code = 200;
                $msg  = "Se han listado los registros con éxito!";
                break;
            case 'INSERT_OK':
                $code = 201;
                $msg  = "{$respMsgObjName} agregad{$gender1} correctamente!";
                break;
            case 'UPDATE_OK':
                $code = 200;
                $msg  = "{$respMsgObjName} actualizad{$gender1} correctamente!";
                break;
            case 'DELETE_OK':
                $code = 200;
                $msg  = "{$respMsgObjName} eliminad{$gender1} correctamente!";
                break;
            case 'STATUS_OK':
                $code = 200;
                $msg  = "El estado fue cambiado correctamente!";
                break;
            case 'ERROR':
                $code = 400;
                $msg  = "Se ha producido un error al realizar la operación!";
                break;
            case 'GET_EMPTY':
                $code = 204;
                $msg  = "No hay datos para mostrar...";
                break;
            case 'GET_ERROR':
                $code = 400;
                $msg  = "No se pudo encontrar el registro solicitado!";
                break;
            case 'GETALL_ERROR':
                $code = 400;
                $msg  = "No se pudo listar los registros!";
                break;
            case 'INSERT_ERROR':
                $code = 400;
                $msg  = "No se pudo agregar {$gender2} {$respMsgObjName}!";
                break;
            case 'INSERT_DUPLI':
                $code = 400;
                $msg  = "Registro duplicado!";
                break;
            case 'UPDATE_ERROR':
                $code = 400;
                $msg  = "No se pudo actualizar {$gender2} {$respMsgObjName}!";
                break;
            case 'UPDATE_NO':
            case 'STATUS_NO':
                $code = 200;
                $msg  = "Ningún cambio realizado!";
                break;
            case 'DELETE_ERROR':
                $code = 400;
                $msg  = "No se pudo eliminar {$gender2} {$respMsgObjName}!";
                break;
            case 'DELETE_NO':
                $code = 204;
                $msg  = "{$respMsgObjName} no encontrad{$gender1}!";
                break;
            case 'STATUS_ERROR':
                $code = 400;
                $msg  = "No se pudo cambiar el estado del Registro!";
                break;
            case 'DATA_ERROR':
                $code = 400;
                $msg  = "Error en el procesamiento de datos!";
                break;
        }

        return [
            'code' => $code,
            'msg'  => $msg,
        ];
    }

    public static function getResponse(string $respCode, $data = null)
    {
        $respCode = self::getCodeMsg($respCode);

        if (!empty($data)) {
            $respCode += (is_object($data)) ? (array) $data : $data;
        } else {
            $respCode += ['data' => null];
        }

        return $respCode;
    }

    public static function customResponse(int $code, string $msg, $data = null)
    {
        $respCode = [
            'code' => $code,
            'msg'  => $msg,
        ];

        if (!empty($data)) {
            $respCode += (is_object($data)) ? (array) $data : $data;
        }

        return $respCode;
    }

    public static function json_output($json, $exit = true)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json;charset=utf-8');

        if (is_array($json)) {
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        }

        echo $json;

        if ($exit) {
            exit;
        }

        return true;
    }

    public static function json_build($status = 200, $msg = '', $data = null)
    {

        if (empty($msg) || $msg == '') {

            switch ($status) {
                case 200:
                    $msg = 'OK';
                    break;
                case 201:
                    $msg = 'Created';
                    break;
                case 204:
                    $msg = 'No content';
                    break;
                case 400:
                    $msg = 'Invalid Request';
                    break;
                case 403:
                    $msg = 'Access denied';
                    break;
                case 404:
                    $msg = 'Not found';
                    break;
                case 500:
                    $msg = 'Internal Server Error';
                    break;
                case 550:
                    $msg = 'Permission denied';
                    break;

                default:
                    break;
            }
        }

        http_response_code($status);

        $json = [
            'data'   => $data,
            'error'  => false,
            'msg'    => $msg,
            'status' => $status,
        ];

        $error_codes = [400, 403, 404, 405, 500];

        if (in_array($status, $error_codes)) {
            $json['error'] = true;
        }

        return $json;
    }

    public static function jsonResponse($status = 200, $msg = '', $data = null)
    {
        self::json_output(self::json_build($status, $msg, $data));
    }
}
