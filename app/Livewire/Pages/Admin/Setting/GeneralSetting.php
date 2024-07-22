<?php

namespace App\Livewire\Pages\Admin\Setting;

use App\Models\Qrcode;
use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Rule;

class GeneralSetting extends Component
{
    use WithFileUploads;
    public $old_image;
    public $title_name;
    public $app_name;
    public $image;
    public $totalSize;
    public $sqlFile;
    public $images;
    public $qr_id;
    public $qr_code;
    public $flashMessages=[];
    public function props()
    {
        // Retrieve any existing flash messages from the session
        $this->flashMessages = Session::get('livewire_flash', []);
    }
    public function importDatabase()
    {
        // Validate the uploaded file (e.g., check if it's an SQL file and within size limits)
        $this->validate([
            'sqlFile' => 'required|file|max:102400', // Adjust as needed
        ]);

        // Process the uploaded SQL file (e.g., read its content and execute queries)
        $sqlContent = file_get_contents($this->sqlFile->getRealPath());

        // Execute your SQL queries here (e.g., using DB::unprepared())
        try {
            DB::unprepared($sqlContent);
            unlink($this->sqlFile->getRealPath());
            $this->reset('sqlFile');
            $this->flashMessages[] = ['type' => 'success', 'message' => 'Database imported successfully!'];

        // Save the flash messages to the session
        Session::flash('livewire_flash', $this->flashMessages);




            // Optionally, you can log successful import or perform other actions
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., invalid SQL syntax, connection issues)
            session()->flash('error', 'Error importing database: ' . $e->getMessage());
        }


    }





    public function export()
    {
        // Define your database credentials (replace with your actual values)
        $dbHost = env('DB_HOST');
        $dbPort = env('DB_PORT');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $dbName = env('DB_DATABASE');

        // Define the backup path (ensure the directory exists and has write permissions)
        $backupPath = 'B:/backup_' . date('Y-m-d_H-i-s') . '.sql';

        // Escape special characters in database name (if needed)
        $dbNameEscaped = escapeshellarg($dbName);

        // Construct the mysqldump command
        $command = "\"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump\" --host=$dbHost --port=$dbPort --user=$dbUser --password=$dbPass $dbNameEscaped > $backupPath 2>&1";

        // Execute the mysqldump command and capture output and return code
        exec($command, $output, $returnCode);

        // Check if the command executed successfully
        if ($returnCode !== 0) {
            // Log or display an error message indicating the failure
            error_log("Backup failed with error: " . implode("\n", $output));
            session()->flash('error', 'Error exporting database: ' . implode("\n", array_slice($output, 0, 3))); // Flash only first 3 lines of error output
            return;
        }

        // Read the file
        $lines = file($backupPath, FILE_IGNORE_NEW_LINES);

        // Remove the line with the warning
        foreach ($lines as $key => $line) {
            if (strpos($line, 'mysqldump: [Warning] Using a password on the command line interface can be insecure.') !== false) {
                unset($lines[$key]);
            }
        }

        // Write the file back out
        file_put_contents($backupPath, implode("\n", $lines));

        // Flash a success message if export is successful
        session()->flash('message', 'Database exported successfully!');
    }









    public function mount()
    {
        $setting = Setting::first();

        if ($setting) {
            $this->title_name = $setting->title_name;
            $this->app_name = $setting->app_name;
        }
    }



    public function updateSetting()
    {
        $setting = Setting::first();
        if ($setting) {
            $validatedData = $this->validate([
                'title_name' => 'required',
                'app_name' => 'required',
                // 1MB Max
            ]);

            // Check if there's a new image uploaded
            if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
                // Delete the old image if it exists
                if ($setting->image) {
                    Storage::disk('public')->delete($setting->image);
                }

                // Store the new image
                $validatedData['image'] = $this->image->store('images', 'public');
            }

            $setting->update($validatedData);
        } else {
            $this->storeSetting();
        }
        Cache::forget('setting');
        session()->flash('message', 'Setting updated successfully');
    }





    // Calculate and delete temp file
    public function calculateTotalSize()
    {
        $tmpFolder = 'livewire-tmp';
        $files = Storage::files($tmpFolder);

        $totalSize = 0;
        foreach ($files as $file) {
            $totalSize += Storage::size($file);
        }

        // Convert to human-readable format (e.g., KB, MB, GB)
        $this->totalSize = $this->formatBytes($totalSize);
    }

    private function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = 0;

        while ($bytes >= 1024 && $index < count($units) - 1) {
            $bytes /= 1024;
            $index++;
        }

        return round($bytes, 2) . ' ' . $units[$index];
    }
    //Delete TempFile
    public function deleteLivewireTmpFiles()
    {
        $tmpFolder = 'livewire-tmp';
        $files = Storage::files($tmpFolder);

        foreach ($files as $file) {
            Storage::delete($file);
        }
    }



    public function storeSetting()
    {
        $validatedData = $this->validate([
            'title_name' => 'required',
            'app_name' => 'required',
            'image' => 'sometimes|image|max:10000', // 1MB Max
        ]);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('images', 'public');
        }

        Setting::create($validatedData);

        Cache::forget('setting');

        session()->flash('message', 'Setting stored successfully');
    }


    //Image CRUD
    public function storeQrImage(){
        $validate = $this->validate([
            'images'=>'required',
        ]);
        if($this->images){
            //Store the image and geet the stored path
            $imagePath = $this->images->store('qr_image','public');
            $validate['images']=$imagePath;
            //Get the full path of the temporary file
            $tempPath = $this->images->getRealPath();
            if(file_exists($tempPath)){
                unlink($tempPath);
            }
        }
        Qrcode::create($validate);
        $this->reset('images');
        $this->dispatch('close-modal');
    }

    public function editProduct(int $qr_id){
        $this->qr_code = Qrcode::find($qr_id);
        $this->old_image = $this->qr_code->images;
    }

    //update product

    public function updateQr(){
        $validate  = $this->validate(['images' => 'required']);
        if($this->images){
            if($this->qr_code->images){
                Storage::disk('public')->delete($this->qr_code->images);
            }
            //Store the new image and geet its store path
        $imagePath = $this->images->store('qr_image','public');


        //Add the new image path to the validated data
        $validate['images'] =$imagePath;
        }
        else{
            $validate['images'] = $this->qr_code->images;
        }
        //update
        $this->qr_code->update($validate);

        $this->reset('images');
        $this->dispatch('close-modal');



    }

    public function deleteQr($qr_id)
    {
        $this->qr_id = $qr_id;
    }

    public function destroyQr(){
        $qr_code = Qrcode::find($this->qr_id);
        if(!$qr_code){
            session()->flash('error','Qrcode not found');
            return redirect()->back();
        }
        if($qr_code->images){
            Storage::disk('public')->delete($qr_code->images);
        }
        $qr_code->delete();
        session()->flash('delete','Qr Delete Successfully');
        $this->dispatch('close-modal');
    }





    public function render()
    {
        $qrcode = Qrcode::all();
        return view('livewire.pages.admin.setting.general-setting',['qrcode'=>$qrcode]);
    }
}
