<?php 

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class FileHelper 
{
    public static function uploadFile(string $dir, string $folder, $file = null)
    {
        if ($file != null) 
        {
            $extension = $file->getClientOriginalExtension();
            $fileName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $extension;
            $file->move($dir.'/'.$folder, $fileName);
         } else {
            $fileName = NULL;
         }

         return $fileName;
    }

    public static function updateFile(string $dir, string $folder, string $old = null, $file = null)
    {
           if ($file != null) {
                $destination = $dir.'/'.$folder.'/'.$old;
                if (File::exists($destination)) 
                {
                    File::delete($destination);
                }
           }
            $fileName = self::uploadFile($dir, $folder, $file);
            return $fileName;
    }

    public static function deleteFile(string $dir,string $folder, $old)
    {
        $destination = $dir.'/'.$folder.'/'.$old;
         if (File::exists($destination)) 
         {
             File::delete($destination);
         }

         return;
    }

    public static function getFileSize(string $dir, string $folder, $file)
    {
        $size = filesize(public_path($dir . '/' . $folder, $file));
        return $size;
    }

    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    
}