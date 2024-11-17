<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageHandler {
    // PUT disk into _construct
    protected $disk;

    function __construct(array $args = [])
    {
        parent::__construct($args);
        $this->disk = Storage::disk(env('FILESYSTEM_DISK'));
    }

    function getFile($filePath) {
        if(!isset($filePath)){
            return '';
        }
        if($this->disk->exists($filePath)){
            return $this->disk->url($filePath);
        }
        return '';
    }

    function setFile($file,$path = 'images') {
        $path = trim($path,'/');
        if($file){
            if(is_string($file)){
                $extension = pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION);
                try{
                    $content = file_get_contents($file);
                }catch (\Exception $e){
                    return '';
                }
                $fileName = uniqid().'-'. now()->format('Ymd-His') .'.'.$extension;
                $this->disk->put("$path/".$fileName,$content);
                return "$path/$fileName";
            }else{
                return $this->disk->put($path,$file);
            }
        }
    }
}