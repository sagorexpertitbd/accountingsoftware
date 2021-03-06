<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Alert;
use App\Http\Requests;
use Artisan;
use Log;
use Storage;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        //var_dump($backups);
        return view("backup.backups")->with(compact('backups'));
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run --only-db');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            Alert::success('New backup created');

            // if unsuccessful, then redirect back to the login with the form data
            $flashdata = ['class'=>'success', 'message'=>"Backup Create Successfull "];

            return redirect()->back()->with($flashdata);

        } catch (Exception $e) {
            // Flash::error($e->getMessage());
            // return redirect()->back();

            // if unsuccessful, then redirect back to the login with the form data
            $flashdata = ['class'=>'danger', 'message'=>"Backup Create Unuccessfull"];

            return redirect()->back()->with($flashdata);
        }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
 
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            //abort(404, "The backup file doesn't exist.");

            // if unsuccessful, then redirect back to the login with the form data
            $flashdata = ['class'=>'danger', 'message'=>"The backup file doesn't exist. "];

            return redirect()->back()->with($flashdata);
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $disk->delete(config('backup.backup.name') . '/' . $file_name);

            // if unsuccessful, then redirect back to the login with the form data
            $flashdata = ['class'=>'success', 'message'=>"The backup file Successfully Deleted. "];

            return redirect()->back()->with($flashdata);

    }

}