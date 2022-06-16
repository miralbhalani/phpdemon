<?php 

namespace Web;

$eq = function($value) {
    $a = " = '" . $value . "'";
    return $a;
};

$gt = function($value) {
    return " > '{$value}'";
};

$lt = function($value) {
    return " < '{$value}'";
};

$compareMaps = [
    "eq" => $eq,
    "gt" => $gt,
    "lt" => $lt
];

$dateFilter = function($comparatorValue) {
    $queryString = "";

    foreach ($comparatorValue as $key => $value) {
        if(!array_key_exists($key, $GLOBALS['compareMaps']))
        {
            echo "WRONG SEARCH PARAMS";
            exit;
        }

        $extQuery = $GLOBALS['compareMaps'][$key]($value);
        $queryString = $queryString . " and registration_date {$extQuery}";
    }

    return trim(
        trimExtras(
        trim($queryString)
        )
    );
};

$nameFilter = function($comparatorValue) {
    $queryString = "";

    foreach ($comparatorValue as $key => $value) {
        if(!array_key_exists($key, $GLOBALS['compareMaps']))
        {
            echo "WRONG SEARCH PARAMS";
            exit;
        }

        $extQuery = $GLOBALS['compareMaps'][$key]($value);
        $queryString = $queryString . " and name {$extQuery}";
    }

    return trim(
        trimExtras(
        trim($queryString)
        )
    );
};

$fieldMaps = [
    "registration_date" => $dateFilter,
    "name" => $nameFilter
];

function searchableQueryBuilder($urlQueryParams, $tableName) {
    $query = 'select * from ' . $tableName . ' where ';


    foreach ($urlQueryParams as $key => $value) {
        if(!array_key_exists($key, $GLOBALS['fieldMaps']))
        {
            echo "WRONG SEARCH PARAMS";
            exit;
        }

        $query = $query . $GLOBALS['fieldMaps'][$key]($value) . " and ";
    }

    return trim(trimExtras(trim(
        trimExtras(
        trim($query),
        )
    )));
}

function trimExtras($stringt) {
    return preg_replace('/^(and|where)|(and|where)$/', '', $stringt);
}


?>