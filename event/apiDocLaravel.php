<?php 

$doc = file_get_contents('api-doc-8.x.json');
$json_doc = json_decode($doc, true);
$base_url = "https://laravel.com/api/8.x/";

$result_doc = [];
$count = 0;

// Verificar si escribe una palabra clave
if ($inqdata != ""){
    foreach ($json_doc as $doc) {
        if (strpos($doc['doc'], $inqdata) !== false) {
            $result_doc[] =     [
                "type" => "article",
                "id" => ++$count,
                "title" => "{$doc['type']}: {$doc['name']}",
                "url" => $base_url.$doc['link'],
                "hide_url" => true,
                "description" => $doc['doc'],
                "input_message_content" => [
                "parse_mode" => "HTML",
                "message_text" => "Type: {$doc['type']}\n<strong>{$doc['name']}</strong>\n{$doc['doc']}\n<a href=\"$base_url{$doc['link']}\">Go to web</a>"
                ],
                "thumb_url" => "https://avatars1.githubusercontent.com/u/22078968?s=200&v=4"
                ];
                # 50 es el límite de resultados de la API
                if (count($result_doc) >= 50) {
                break;
            }
        } 
    }
} else {
    // En caso de no escribir nada en el inline
    $result_doc[] = [
        "type" => "article",
        "id" => ++$count,
        "title" => "Laravel Doc Buscador",
        "url" => $base_url,
        "hide_url" => true,
        "description" => "Escribe lo que deseas encontrar",
        "input_message_content" => [
        "parse_mode" => "HTML",
        "message_text" => "Documentación Laravel\nDebes indicarme lo que deseas leer, por ejemplo Artisan, migrate, etc."
        ],
        "thumb_url" => "https://avatars1.githubusercontent.com/u/22078968?s=200&v=4"
        ];
}

// Ejecutarse solo con inline
if (isset($inquery)) {
    $data = $result_doc;
    $result = array_map(null, $data);
    
    _answerInlineQuery($inqid, $result);
}
