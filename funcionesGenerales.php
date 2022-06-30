<?php
const URL =  "http://appps.site/";

function cortarUrl($url){
    $array =  explode('/',$url);
    return $array[count($array)-1];
}
function response($names,$alert){
    for ($i=0; $i < count($names); $i++) {
        if(isset($_SESSION[$names[$i]])){
            $actual =  $names[$i];
            echo $alert->simple($actual,$_SESSION[$actual]);
            unset($_SESSION[$actual]);
        } 
    }
}
function peso($value){
    return str_replace(",",".",number_format($value));
}
function response2($names,$color,$alert){
    for ($i=0; $i < count($names); $i++) {
        if(isset($_SESSION[$names[$i]])){
            $actual =  $names[$i];
            echo $alert->simple($color[$i],$_SESSION[$actual]);
            unset($_SESSION[$actual]);
        } 
    }
}

function ArreglarInforme($sqlPeople, $sqlDevoluciones, $order, $Iva){
    $sqlPeople = UnirDatos($sqlPeople, $Iva);
    $sqlDevoluciones = UnirDatos($sqlDevoluciones, $Iva);
    $result = [];
    $i = 0;
    foreach($sqlPeople as $p){
        array_push($result, $p);
        foreach($sqlDevoluciones as $d){
            if($d['NoDocumento'] == $p['NoDocumento']){
                $result[$i]['Cantidad']-= $d['Cantidad'];
                $result[$i]['Precio']-= $d['Precio'];
                break;
            }
        }
        $i++;
    }
    $actual = 0;
    $siguiente = 1;
    while($actual < count($result) && $siguiente <= count($result)){
        if($result[$actual]["$order"] < $result[$siguiente]["$order"]){
            $temp = $result[$siguiente];
            $result[$siguiente] = $result[$actual];
            $result[$actual] = $temp;
        }
        $siguiente++;
        if($siguiente == count($result)){
            $actual++;
            $siguiente = $actual+1;
        }
    }
    return $result;
}

function UnirDatos($Personas, $IVA){
    $PersonasA = [];
    $NoDocumentoActual = -1;
    $CantidadTotal = 0;
    $PrecioTotal = 0;
    $Mes = 0;
    foreach($Personas as $p){
        $Cantidad = $p['Cantidad'];
        $Precio = $p['Precio'];
        if($NoDocumentoActual == -1){
            $NoDocumentoActual = $p['NoDocumento'];
            $Mes = $p['Mes'];
        }
        foreach($IVA as $iva){
            if($iva['Detalle'] == $p['DetalleFactura']){
                $Precio+= $Precio * $iva['Iva']/100;
                break;
            }
        }
        $CantidadTotal += $Cantidad;
        $PrecioTotal += $Precio;
        if($NoDocumentoActual != $p['NoDocumento']){
            $array = [
                "NoDocumento" => $NoDocumentoActual,
                "Cantidad" => $CantidadTotal,
                "Precio" => $PrecioTotal,
                "Mes" => $p['Mes']
            ];
            array_push($PersonasA, $array);
            $CantidadTotal = 0;
            $PrecioTotal = 0;
            $NoDocumentoActual = $p['NoDocumento'];
        }
    }
    if($NoDocumentoActual != -1){
        $array = [
            "NoDocumento" => $NoDocumentoActual,
            "Cantidad" => $CantidadTotal,
            "Precio" => $PrecioTotal,
            "Mes" => $Mes
        ];
        array_push($PersonasA, $array);
    }
    return $PersonasA;
}

function getMes($n){
    $mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    return $mes[$n-1];
}
function getMesindice($i){
    $i = 0;
    $mes = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
    foreach($mes as $m){
        if($i == $m){
            return $i;
        }
        $i++;
    }
}